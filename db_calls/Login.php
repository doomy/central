<?php

use Base\DbCall as BaseDbCall;

class Login_db_calls extends BaseDbCall {
    public function are_credentials_correct($credentials) {
        $env = Environment::get_env();
        $encryption_key = $env->CONFIG['DB_ENCRYPTION_KEY'];
        $sql = "SELECT AES_DECRYPT(password, '$encryption_key') AS password FROM t_users WHERE username = '$credentials->username';";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_object();
        return ($row->password == $credentials->password);
    }

    public function get_user_permissions($username) {
        $sql = "SELECT permissions FROM t_users WHERE username = '$username';";
        $result = $this->mysqli->query($sql);
        $row = $result->fetch_object();
        return explode(',', $row->permissions);
    }
}

?>
