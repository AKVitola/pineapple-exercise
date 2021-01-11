<?php
class Subscribers extends Dbh
{
  private $conn;
  protected static $rowsPerPage = 10;

  public function __construct()
  {
    $this->conn = $this->connect();
  }

  protected function addSubscriber($emailAdress, $emailProvider)
  {
    $sql = "INSERT INTO subscriptions (email, provider)
    VALUES ('$emailAdress', '$emailProvider')";

    return $this->conn->query($sql);
  }

  protected function getSubscribers($column, $sortOrder, $offset, $email, $selectedProvider)
  {
    $whereSql = $this->generateWhereSql($selectedProvider, $email);

    return $this->conn->query("SELECT * FROM subscriptions " . $whereSql . " ORDER BY " . $column . " " . $sortOrder . " LIMIT " . $offset . ", " . self::$rowsPerPage);
  }

  protected function getDistinctProviders($selectedProvider, $email)
  {
    $whereSql      = $this->generateWhereSql($selectedProvider, $email);
    $providerQuery = "SELECT DISTINCT provider FROM subscriptions " . $whereSql;
    $result        = $this->conn->query($providerQuery);

    while ($provider = $result->fetch_array()) {
      $providers[] = $provider["provider"];
    }

    return $providers;
  }

  protected function delete($subscriberId)
  {
    $sql = "DELETE FROM subscriptions WHERE ID = " . $subscriberId;

    return $this->conn->query($sql);
  }

  private function generateWhereSql($selectedProvider, $email)
  {
    $whereSql = "WHERE TRUE";

    if ($selectedProvider) {
      $whereSql .= " AND provider= '" . $selectedProvider . "'";
    }

    if ($email) {
      $whereSql .= " AND email LIKE '%$email%' ";
    }

    return $whereSql;
  }

  protected function ascOrDesc($sortOrder)
  {
    return $sortOrder == "ASC" ? "desc" : "asc";
  }

  protected function upOrDown($sortOrder)
  {
    return str_replace(array("ASC", "DESC"), array("up", "down"), $sortOrder);
  }

  protected function calculateTotalPages($selectedProvider, $email)
  {
    $whereSql = $this->generateWhereSql($selectedProvider, $email);

    if ($selectedProvider) {
      $whereSql .= " AND provider= '" . $selectedProvider . "'";
    }

    if ($email) {
      $whereSql .= " AND email LIKE '%$email%' ";
    }

    $result = $this->conn->query("SELECT COUNT(*) FROM subscriptions " . $whereSql)->fetch_array();
    $totalRows = (int)$result[0];

    return ceil($totalRows / self::$rowsPerPage);
  }

  protected function generateDataUrl($column, $sortOrder, $provider, $email, $page = null)
  {
    $url = "subscribers.php?column=" . $column . "&order=" . $sortOrder;

    if ($provider) {
      $url .= "&provider=" . $provider;
    }
    if ($email) {
      $url .= "&email=" . $email;
    }
    if ($page) {
      $url .= "&page=" . $page;
    }

    return $url;
  }
}
