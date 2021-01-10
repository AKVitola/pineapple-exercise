<?php
class Dbh
{
  protected function connect()
  {
    $config = include "config/db_config.php";

    $conn = new mysqli($config["host"], $config["user"], $config["psw"], $config["dbName"]);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
  }
}
