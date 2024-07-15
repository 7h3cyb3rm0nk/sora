<?php


$env = parse_ini_file("../.env");

$username = $env['USERNAME'];
$passwd = $env['PASSWORD'];
$hostname = $env['HOSTNAME'];
$database = $env['DATABASE'];

$mysqli = new mysqli($hostname, $username, $passwd, $database);

if ($mysqli->connect_error) {
  die("Connection failed ". $mysqli->connect_error);
}


?>
