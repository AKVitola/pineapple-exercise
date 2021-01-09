<?php

class Dbh {
  private $host = "localhost";
  private $user = "root";
  private $psw  = "";
  private $dbName = "pineapple";

  protected function connect() {
    $conn = new mysqli($this->host, $this->user, $this->psw, $this->dbName);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    return $conn;

  }
}