<?php
include "includes/autoload.inc.php";

$controller = new SubscribersContr();

if (isset($_POST) && isset($_POST["submit"])) {
  if ($_POST["submit"] === "subscribe") {
    return $controller->validateAndCreate();
  }

  if ($_POST["submit"] === "delete") {
    return $controller->deleteSubscriber();
  }
}
