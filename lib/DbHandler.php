<?php

class DbHandler {
    # 23.11.2014

    private $connection;
    private $mysqli;

    public function __construct() {
        $this->env = Environment::get_env();
        $this->mysqli = $this->get_mysqli_connection();

        if ($this->env->CONFIG['DB_CREATE']) {
            $this->_create_db();
        }
        mysql_set_charset('utf8');
        $this->_manage_upgrades();
    }

    public function query_get_obj_onerow(
        $columns_list, $table, $where = false, $order_by = '', $desc = false
    ) {
        $result = $this->_query_get_result($columns_list, $table, $where, $order_by, $desc, 1);
        return $this->fetch_one_from_result($result, 'object');
    }

    public function query($sql) {
        return  $this->mysqli->query($sql);
    }

    public function get_array_of_rows_from_table(
        $table_name, $columns = null, $where = null, $format = 'object'
    ) {
        $result = $this->_query_get_result($columns, $table_name, $where);
        return $this->fetch_multiple_from_result($result, $format);
    }

    public function process_sql($sql) {
        $queries = explode(';', $sql);
        foreach ($queries as $query) {
            $this->query($query.';');
        }
    }

    public function process_sql_file($path) {
        $sql = file_get_contents($path);
        $this->process_sql($sql);
    }
    
    public function fetch_one_from_sql($sql, $format = 'object') {
        $result = $this->query($sql);
        return call_user_func(array($this, "_fetch_".$format), $result);
    }

    public function fetch_one_from_result($result, $format = 'object') {
        $function_name = "mysql_fetch_$format";
        return $function_name($result);
    }

    public function fetch_multiple_from_result($result, $format = 'object') {
        $function_name = "mysql_fetch_$format";
        while ($row = $function_name($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    
    public function run_db_call($package, $db_call_name) {
        include_php_file_once("db_calls/$package.php");
        $package_class = $this->_get_valid_db_call_class_name($package);
        $package = new $package_class($this);
        $arg_list = func_get_args();
        array_shift($arg_list);
        array_shift($arg_list);
        return call_user_func_array(array($package, $db_call_name), $arg_list);
    }

    function _get_valid_db_call_class_name($package) {
        $parts = explode('/', $package);
        return array_pop($parts) . "_db_calls";
    }
    
    function _fetch_array($result) {
        return mysql_fetch_array($result);
    }
    
    function _fetch_object($result) {
        return @mysql_fetch_object($result);
    }

    private function _create_db() {
        $this->process_sql_file($this->env->basedir.'sql/base.sql');
    }

    private function _manage_upgrades() {
        $last_processed_upgrade_id = $this->run_db_call('DbHandler', 'get_last_processed_upgrade_id');
        $upgrade_files = $this->_get_upgrade_files();
        if(!$upgrade_files) return;
        sort($upgrade_files, SORT_NUMERIC);
        $last_file = @end($upgrade_files);
        $newest_upgrade_id = $this->_get_upgrade_id_from_filename($last_file);

        if ($newest_upgrade_id > $last_processed_upgrade_id) {
            $this->_upgrade_to_actual(
                $upgrade_files, $last_processed_upgrade_id
            );
        }
    }

    private function _upgrade_to_actual(
        $upgrade_files, $last_processed_upgrade_id
    )
    {
        foreach ($upgrade_files as $upgrade_file) {
            $upgrade_id = $this->_get_upgrade_id_from_filename($upgrade_file);
            if ($upgrade_id > $last_processed_upgrade_id) {
                $this->_upgrade_to_version($upgrade_id, $upgrade_file);
            }
        }
    }

    private function _get_upgrade_id_from_filename($upgrade_file) {
        $parts = explode('.', $upgrade_file);
        return $parts[0];
    }

    private function _upgrade_to_version($upgrade_id, $upgrade_file) {
        $this->process_sql_file(
            $this->env->basedir . 'sql/upgrade/' . $upgrade_file
        );
        if (!($this->_get_db_error())) $this->_update_upgrade_version($upgrade_id);
        else die($this->_get_db_error());
    }
    
    private function _get_db_error() {
        if (mysql_error() != "Query was empty")
            return mysql_error();
        return false;
    }

    private function _get_upgrade_files() {
        $dir_handler = new Dir($this->env);
        return $dir_handler->get_files_from_dir_by_extension(
             $this->env->basedir.'sql/upgrade', 'sql'
        );
    }

    private function _update_upgrade_version($upgrade_id) {
        $sql = "INSERT INTO t_upgrade_history (id, message) VALUES('$upgrade_id', 'Upgrade no. $upgrade_id');";
        $this->query($sql);
    }

    private function _query_get_result(
        $columns_list = null, $table, $where = null, $order_by = '', $desc = false, $limit = null
    ) {
        if (!$columns_list) $columns = '*';
        else $columns = implode(', ', $columns_list);
        if ($order_by <> '')
            $order_by = "ORDER BY $order_by";
        if ($where) $where = "WHERE $where";
        if ($desc) $desc = 'DESC';
        if ($limit) $limit = "LIMIT $limit";
        else
            $desc = '';
        $sql = "SELECT $columns FROM $table $where $order_by $desc $limit;";
        return $this->query($sql);
    }

    public function get_mysqli_connection() {
        if ($this->mysqli) return $this->mysqli;
        else {
            $this->mysqli = new mysqli(
                $this->env->CONFIG['DB_HOST'],
                $this->env->CONFIG['DB_USER'],
                $this->env->CONFIG['DB_PASS'],
                $this->env->CONFIG['DB_NAME']
            );
        }
        return $this->mysqli;
    }
}
?>
