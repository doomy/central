<?php

class Login {
    # requires session_start
    # version 6

    public function __construct() {
        $this->dbh = Environment::get_dbh();
    }

    public function has_permission($permission) {
        return (@($_SESSION['logged_in']) && (in_array($permission, $_SESSION['permissions'])));
    }

    public function log_out() {
        unset($_SESSION['logged_in']);
        unset($_SESSION['permissions']);
    }

    public function attempt_login($credentials, $permission) {
        if ($this->_check_login($credentials) && $this->_check_permissions($credentials->username, $permission)) {
            $this->_log_in($credentials->username);
            return true;
        }
        else return false;
    }
    
    public function get_username() {
        return $_SESSION['username'];
    }

    private function _check_login($credentials) {
        return $this->dbh->run_db_call('Login', 'are_credentials_correct',  $credentials);
    }

    private function _check_permissions($username, $permission) {
        $permissions = $this->dbh->run_db_call('Login', 'get_user_permissions', $username);
        return in_array($permission, $permissions);
    }

    private function _log_in($username) {
        $_SESSION['logged_in'] = true;
        $_SESSION['permissions'] = $this->dbh->run_db_call('Login', 'get_user_permissions', $username);
        $_SESSION['username'] = $username;
    }
}
?>
