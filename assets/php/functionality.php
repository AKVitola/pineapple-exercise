<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["email"])) {
    $_SESSION["error"] = "Email address is required";
  } else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Please provide a valid e-mail address";
      }

      if (endsWith($_POST["email"], ".co")) {
        $_SESSION["error"] = "We are not accepting subscriptions from Colombia emails";
      }
  }

  if (!isset($_POST["terms"])) {
    $_SESSION["error"] = "You must accept the terms and conditions";
  }
}

if(!isset($_SESSION["error"]) && empty($_SESSION["error"])) {

  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbName     = "pineapple";

  $conn = new mysqli($servername, $username, $password, $dbName);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $emailAdress    = $_POST["email"];
  $emailProvider  = substr($emailAdress, strpos($emailAdress, '@') + 1);
  $emailProvider  = explode('.', $emailProvider);
  array_pop($emailProvider);
  $emailProvider = implode(".", $emailProvider);

  $sql = "INSERT INTO subscriptions (email, provider)
  VALUES ('$emailAdress', '$emailProvider')";

  if ($conn->query($sql) === TRUE) {
    echo json_encode("New record created successfully");
    print_r(".");
  } else {
    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
  }

  $conn->close();
} else {
  header('Location: ../../index.php');
  exit;
}

function endsWith($haystack, $needle) {
  $length = strlen($needle);
  if(!$length) {
      return true;
  }
  return substr($haystack, -$length) === $needle;
}
?>






