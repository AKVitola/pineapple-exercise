<?php
  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbName     = "pineapple";
  $conn       = new mysqli($servername, $username, $password, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $subscriberId = $_POST['subscriberId'];
  $sql = "DELETE FROM subscriptions WHERE ID = ". $subscriberId;

  if ($conn->query($sql) === TRUE) {
    echo json_encode("Subscriber deleted");
  } else {
    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
  }

  $conn->close();
?>