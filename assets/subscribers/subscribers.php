<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <title>Subscribers</title>

  <style>
    h1 {
      text-align: center;
    }

    table, th, td {
    border: 1px solid black;
    }

    table {
      width: 90%;
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
      border-collapse: collapse;
    }

    th a {
      text-decoration:none;
      color: #000;
    }

    th a i {
      margin-left: 10px;
      color: rgba(0,0,0,0.5);
    }

  </style>
</head>

<body>


  <h1>Subscribers</h1>

  <!-- Creates a table displaying db data -->
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbName = "pineapple";

    // Adds sorting option to the table

  $columns = array('email','date');
  $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
  $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';


  $conn = new mysqli($servername, $username, $password, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT id, email, provider, date FROM subscriptions ORDER BY date DESC";
  $result = $conn->query($sql);

  if ($result = $conn->query('SELECT * FROM subscriptions ORDER BY ' .  $column . ' ' . $sort_order)) {
    $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
  }
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
    </tr>

<?php
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['date'] . "</td>";
      echo "</tr>";
    }
  } else {
      echo "0 results";
  }
  echo "</table>";
  $conn->close();
?>

</body>
</html>