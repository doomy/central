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

    public static function var_dump($value, $caption = null) {
        echo "<p>";
            if ($caption)
                echo "<strong>$caption</strong><br />";
            var_dump($value);
        echo "</p>";
    }

    public static function var_dump_die($value, $caption = null) {
        self::var_dump($value, $caption);
        die();
    }

    public static function getConfig($configName) {
        return self::$env->CONFIG[$configName];
    }
}


?>