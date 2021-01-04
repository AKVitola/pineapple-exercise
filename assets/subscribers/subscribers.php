<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../img/pineapple.png">
  <link rel="stylesheet" href="../css/subscribers-style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script type='text/javascript' src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <title>Subscribers</title>
</head>

<body>
  <h1>
    <a href="subscribers.php">Subscribers</a>
  </h1>

  <?php
  $servername = "localhost";
  $username   = "root";
  $password   = "";
  $dbName     = "pineapple";
  $conn       = new mysqli($servername, $username, $password, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $columns    = array('date', 'email');
  $column     = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
  $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'asc' ? 'ASC' : 'DESC';
  $email  = isset($_GET['email']) ? $_GET['email'] : null;
  $whereSql   = "WHERE TRUE";
  $selectedProvider = isset($_GET['provider']) ? $_GET['provider'] : null;

  $rowsperpage = 10;
  $totalpages  = calculateTotalPages($selectedProvider, $email, $conn, $rowsperpage);
  $currentpage = calculateCurrentPage($totalpages);
  $offset= calculateOffset($currentpage, $rowsperpage);

  function calculateOffset($currentpage, $rowsperpage) {
    return ($currentpage - 1) * $rowsperpage;
  }

  function calculateTotalPages($selectedProvider, $email, $conn, $rowsperpage) {
    $whereSql   = "WHERE TRUE";

    if($selectedProvider) {
      $whereSql .= ' AND provider= "' .$selectedProvider. '"';
    }

    if($email) {
      $whereSql .= " AND email LIKE '%$email%' ";
    }

    $result = $conn->query('SELECT COUNT(*) FROM subscriptions ' . $whereSql)->fetch_all();
    $totalRows = (int)$result[0][0];

    return ceil($totalRows / $rowsperpage);
  }

  function calculateCurrentPage($totalpages) {
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
      $currentpage = (int) $_GET['page'];
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

  // Add string to WHERE if provider is selected or searched by email

  if($selectedProvider) {
    $whereSql .= ' AND provider= "' .$selectedProvider. '"';
  }

  if($email) {
    $whereSql .= " AND email LIKE '%$email%' ";
  }

  // Main query to db

  if ($result = $conn->query('SELECT * FROM subscriptions ' . $whereSql . ' ORDER BY ' . $column . ' ' . $sort_order . ' LIMIT ' . $offset .', '. $rowsperpage)) {
    $up_or_down  = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
  }

function generateDataUrl($column, $sort_order, $provider, $email, $page = null) {
  $url = "subscribers.php?column=" . $column . "&order=" . $sort_order;

  if($provider) {
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

  // Filter email by provider

  $providerQuery   = 'SELECT DISTINCT provider FROM subscriptions ' . $whereSql;
  $providerResults = $conn->query($providerQuery);
  $providerResults = $providerResults->fetch_all();
?>

  <div>
    <?php
      foreach ($providerResults as $providerArray) {
        foreach($providerArray as $provider) {
    ?>
        <button>
          <a href="<?php echo generateDataUrl($column, $sort_order, $provider, $email); ?>">
              <?php echo $provider; ?>
          </a>
        </button>
    <?php
        }
      }
    ?>
  </div>

  <!-- Search -->

  <form>
    <label for="search">Search by email </label>
    <input id="search" value="<?php echo $email;?>">
    <button type="submit" onclick="searchEmail(event, '<?php echo $column;?>','<?php echo $sort_order;?>' , '<?php echo $selectedProvider;?>' , '<?php echo $email;?>')">
      <a href="">
      Search
      </a>
    </button>
  </form>

  <!-- Sorting by email and date -->

  <table>
    <tr>
      <th>
        <a href="<?php echo generateDataUrl("email", $asc_or_desc, $selectedProvider, $email)?>">
          Email
          <i class="fas fa-sort<?php echo $column == "email" ? "-" . $up_or_down : "" ?>"></i>
        </a>
      </th>
      <th>
        <a href="<?php echo generateDataUrl("date", $asc_or_desc, $selectedProvider, $email)?>">
          Date
          <i class="fas fa-sort<?php echo $column == "date" ? "-" . $up_or_down : "" ?>"></i>
       </a>
      </th>
      <th></th>
    </tr>

<!-- Table for all the db data -->

<?php
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['date'] . "</td>";
      echo "<td class='delete'><a href='#' id='". $row['id'] . "' onclick='deleteSubscriber(id)'>Delete</a></td>";
      echo "</tr>";
    }
  }
  echo "</table>";
  $conn->close();
  ?>

<!-- Pagination links -->

  <section class="pagination">
  <?php
  $range = 3;

  if ($currentpage > 1) {
   echo "<a href='" . generateDataUrl($column, $sort_order, $selectedProvider, $email, 1) . "'><button>|<</button></a>";
   $prevpage = $currentpage - 1;
   echo "<a href='" . generateDataUrl($column, $sort_order, $selectedProvider, $email, $prevpage) . "'><button><</button></a>";
  }

  for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
    if (($x > 0) && ($x <= $totalpages)) {
      if ($x == $currentpage) {
        echo "<a href='" .generateDataUrl($column, $sort_order, $selectedProvider, $email, $x). "'><button class='active-page'>$x</button></a>";
      } else {
        echo "<a href='" .generateDataUrl($column, $sort_order, $selectedProvider, $email, $x). "'><button>$x</button></a>";
      }
    }
  }

  if ($currentpage != $totalpages) {
   $nextpage = $currentpage + 1;
   echo "<a href='" .generateDataUrl($column, $sort_order, $selectedProvider, $email, $nextpage). "'><button>></button></a>";
   echo "<a href='" .generateDataUrl($column, $sort_order, $selectedProvider, $email, $totalpages). "'><button>>|</button></a>";
  }
  ?>
  </section>

<script src="../js/subscribers.js"></script>
</body>
</html>