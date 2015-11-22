<?php 


class Environment {
    private static $env;
    private static $dbh;

    public static function get_env() {
        if(!self::$env) {
            self::$env = new Env('');
        }
        return self::$env;
    }
    
    public static function get_dbh() {
        if(!self::$dbh) {
            self::$dbh = new DbHandler();
        }
        return self::$dbh;
    }
}


?>