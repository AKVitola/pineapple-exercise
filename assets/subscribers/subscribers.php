<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type='text/javascript' src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/subscribers-style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <title>Subscribers</title>
</head>

<body>
  <h1>Subscribers</h1>

  <?php
  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbName     = "pineapple";
  $conn       = new mysqli($servername, $username, $password, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql        = "SELECT email, date, id FROM subscriptions ORDER BY date DESC";
  $result     = $conn->query($sql);
  $columns    = array('email','date', 'id');
  $column     = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
  $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

  if ($result = $conn->query('SELECT * FROM subscriptions ORDER BY ' .  $column . ' ' . $sort_order)) {
    $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
  }

  $providerQuery   = 'SELECT DISTINCT provider FROM subscriptions';
  $providerResults = $conn->query($providerQuery);
  $providerResults = $providerResults->fetch_all();

  echo "<div>";
  foreach ($providerResults as $providerArray) {
    foreach($providerArray as $provider) {
      echo "<button>$provider</button>";
    }
  }
  echo "</div>";
?>

  <table>
    <tr>
      <th>
        <a href="subscribers.php?column=email&order=<?php echo $asc_or_desc ?>">
          Email
          <i class="fas fa-sort<?php echo $column == "email" ? "-" . $up_or_down : "" ?>"></i>
        </a>
      </th>
      <th>
        <a href="subscribers.php?column=date&order=<?php echo $asc_or_desc ?>">
          Date
          <i class="fas fa-sort<?php echo $column == "date" ? "-" . $up_or_down : "" ?>"></i>
       </a>
      </th>
      <th></th>
    </tr>

<?php
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['date'] . "</td>";
      echo "<td><a href='#' id='". $row['id'] . "' onclick='deleteSubscriber(id)'>Delete</a></td>";
      echo "</tr>";
    }
  } else {
      echo "0 results";
  }
  echo "</table>";
  $conn->close();
?>

<script src="../js/subscribers.js"></script>
</body>
</html>