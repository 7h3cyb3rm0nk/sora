<?php



namespace Sora\Config;
/** Database class to return a database object */
class Database {
      public static function get_connection(): \mysqli {

        $env = parse_ini_file(__DIR__."/.env");
        $username = $env['USERNAME'];
        $passwd = $env['PASSWORD'];
        $hostname = $env['HOSTNAME'];
        $database = $env['DATABASE'];


        /**
         * @var mysqli $mysqli object to be returned
         *
         */
        $mysqli = new \mysqli(
            $hostname,     // Database host (e.g., 'localhost')
            $username, // Database username
            $passwd, // Database password
            $database  // Database name
        );

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }
}

?>
