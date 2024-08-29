<?php
// nuestra conexion a db
class DB
{
    private static $instance = null;

        /**
     * Conexión con nuestra base de datos
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $db_info = array(
                "db_host" => constant('DB_HOST'),
                "db_port" => constant('DB_PORT'),
                "db_user" => constant('DB_USER'),
                "db_pass" => constant('DB_PASS'),
                "db_name" => constant('DB'),
                "db_charset" => "UTF-8");

            try {
                self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass']);
                self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');

            } catch(PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$instance;
    }
}