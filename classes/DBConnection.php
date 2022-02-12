<?php

class DBConnection 
{
    private static $instance = null;

    public static function get() {
        if(self::$instance === null)
        {
            self::$instance = new PDO("sqlite:rocketlab.db");
        }

        return self::$instance;
    }
}

?>