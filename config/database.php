<?php



namespace Sora\Config;

class Database {
      public static function getConnection() {

        $env = parse_ini_file("./.env");
        $username = $env['USERNAME'];
        $passwd = $env['PASSWORD'];
        $hostname = $env['HOSTNAME'];
        $database = $env['DATABASE'];

        $mysqli = new \mysqli(
            $env['host'],     // Database host (e.g., 'localhost')
            $env['username'], // Database username
            $env['password'], // Database password
            $env['database']  // Database name
        );

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        return $mysqli;
    }
}

?>
