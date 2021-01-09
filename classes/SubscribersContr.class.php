<?php
class SubscribersContr extends Subscribers
{
  public function validateAndCreate()
  {
    session_start();
    $emailAdress = $_POST["email"];

    if (empty($emailAdress)) {
      $this->setError("Email address is required");
    } else {
      $email = filter_var($emailAdress, FILTER_SANITIZE_EMAIL);

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $this->setError("Please provide a valid e-mail address");
      }

      if ($this->endsWith($emailAdress, ".co")) {
        $this->setError("We are not accepting subscriptions from Colombia emails");
      }
    }

    if (!isset($_POST["terms"])) {
      $this->setError("You must accept the terms and conditions");
    }

    if (!isset($_SESSION["error"]) && empty($_SESSION["error"])) {
      $emailProvider  = substr($emailAdress, strpos($emailAdress, "@") + 1);
      $emailProvider  = explode(".", $emailProvider);
      array_pop($emailProvider);
      $emailProvider = implode(".", $emailProvider);

      if ($this->addSubscriber($emailAdress, $emailProvider) === TRUE) {
        if ($_POST["jsEnabled"]) {
          echo json_encode("New record created successfully");
        } else {
          header("Location: success.php");
          exit;
        }
      } else {
        if ($_POST["jsEnabled"]) {
          echo json_encode("Error: " . $this->conn->error);
        } else {
          $this->setError("Couldn't add your email to the subscription list.");
        }
      }
    } else {
      header("Location: index.php");
      $_SESSION["email"] = $emailAdress;
      exit;
    }
  }

  public function deleteSubscriber()
  {
    $subscriberId = $_POST["subscriberId"];

    if ($this->delete($subscriberId) === TRUE) {
      echo json_encode("Subscriber deleted");
    } else {
      echo json_encode("Error: " . $this->conn->error);
    }
  }

  private function setError($errorMessage)
  {
    $_SESSION["error"] = $errorMessage;
  }

  private function endsWith($haystack, $needle)
  {
    $length = strlen($needle);

    if (!$length) {
      return true;
    }

    return substr($haystack, -$length) === $needle;
  }

  public function indexPage()
  {
    session_start();
    include "views/index.view.php";
  }

  public function successPage()
  {
    include "views/success.view.php";
  }

  public function subscribersPage()
  {
    $columns   = array("date", "email");
    $column    = isset($_GET["column"]) && in_array($_GET["column"], $columns) ? $_GET["column"] : $columns[0];
    $sortOrder = isset($_GET["order"]) && strtolower($_GET["order"]) == "asc" ? "ASC" : "DESC";
    $email     = isset($_GET["email"]) ? $_GET["email"] : null;
    $selectedProvider = isset($_GET["provider"]) ? $_GET["provider"] : null;

    $totalpages  = $this->calculateTotalPages($selectedProvider, $email);
    $providers   = $this->getDistinctProviders($selectedProvider, $email);
    $currentpage = $this->calculateCurrentPage($totalpages);
    $offset      = $this->calculateOffset($currentpage, self::$rowsPerPage);
    $result      = $this->getSubscribers($column, $sortOrder, $offset, $email, $selectedProvider);

    include "views/subscribers.view.php";
  }

  public function calculateCurrentPage($totalpages)
  {
    if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
      $currentpage = (int) $_GET["page"];
    } else {
      $currentpage = 1;
    }
    if ($currentpage > $totalpages) {
      $currentpage = $totalpages;
    }
    if ($currentpage < 1) {
      $currentpage = 1;
    }

    return $currentpage;
  }

  public function calculateOffset($currentpage)
  {
    return ($currentpage - 1) * self::$rowsPerPage;
  }
}
