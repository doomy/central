<?php

use Base\Model;

class DbHandler_db_calls extends Model  {
    public function get_last_processed_upgrade_id() {
        $sql = "SELECT MAX(id) AS max_id FROM t_upgrade_history;";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_object();
        return $row->max_id;
    }

}

?>