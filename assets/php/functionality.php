<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbName     = "pineapple";

$conn = new mysqli($servername, $username, $password, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$emailAdress    = $_POST['email'];
$emailProvider  = substr($emailAdress, strpos($emailAdress, '@') + 1);
$emailProvider  = explode('.', $emailProvider);
array_pop($emailProvider);
$emailProvider = implode(".", $emailProvider);

$sql = "INSERT INTO subscriptions (email, provider)
VALUES ('$emailAdress', '$emailProvider')";

if ($conn->query($sql) === TRUE) {
  echo json_encode("New record created successfully");
} else {
  echo json_encode("Error: " . $sql . "<br>" . $conn->error);
}

$conn->close();
?>






