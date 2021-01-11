<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../assets/img/pineapple.png">
  <link rel="stylesheet" href="../assets/css/subscribers-style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script type='text/javascript' src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <title>Subscribers</title>
</head>

<body>
  <h1>
    <a href="subscribers">Subscribers</a>
  </h1>

  <!-- Provider buttons -->
  <div>
    <?php
    foreach ($providers as $provider) {
    ?>
      <button>
        <a href="<?php echo $this->generateDataUrl($column, $sortOrder, $provider, $email); ?>">
          <?php echo $provider; ?>
        </a>
      </button>
    <?php } ?>
  </div>

  <!-- Search -->
  <form>
    <label for="search">Search by email </label>
    <input id="search" value="<?php echo $email; ?>">
    <button type="submit" onclick="searchEmail(event, '<?php echo $column; ?>','<?php echo $sortOrder; ?>' , '<?php echo $selectedProvider; ?>' , '<?php echo $email; ?>')">
      <a href="">
        Search
      </a>
    </button>
  </form>

  <!-- Sorting by email and date -->
  <table>
    <tr>
      <th>
        <a href="<?php echo $this->generateDataUrl("email", $this->ascOrDesc($sortOrder), $selectedProvider, $email); ?>">
          Email
          <i class="fas fa-sort<?php echo $column == "email" ? "-" . $this->upOrDown($sortOrder) : "" ?>"></i>
        </a>
      </th>
      <th>
        <a href="<?php echo $this->generateDataUrl("date", $this->ascOrDesc($sortOrder), $selectedProvider, $email); ?>">
          Date
          <i class="fas fa-sort<?php echo $column == "date" ? "-" . $this->upOrDown($sortOrder) : "" ?>"></i>
        </a>
      </th>
      <th></th>
    </tr>

    <!-- Displays all db data -->
    <?php
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
          <td><?php echo $row["email"]; ?></td>
          <td><?php echo $row["date"]; ?></td>
          <td class="delete"><a href="#" id="<?php echo $row["id"]; ?>" onclick="deleteSubscriber(id)">Delete</a></td>
        </tr>
    <?php
      }
    }
    ?>
  </table>

  <!-- Pagination -->
  <section class="pagination">
    <?php
    $range = 3;

    if ($currentpage > 1) {
      echo "<a href='" . $this->generateDataUrl($column, $sortOrder, $selectedProvider, $email, 1) . "'><button>|<</button></a>";
      $prevpage = $currentpage - 1;
      echo "<a href='" . $this->generateDataUrl($column, $sortOrder, $selectedProvider, $email, $prevpage) . "'><button><</button></a>";
    }

    for ($pageNo = ($currentpage - $range); $pageNo < (($currentpage + $range) + 1); $pageNo++) {
      if (($pageNo > 0) && ($pageNo <= $totalpages)) {
        if ($pageNo == $currentpage) {
          echo "<a href='" . $this->generateDataUrl($column, $sortOrder, $selectedProvider, $email, $pageNo) . "'><button class='active-page'>$pageNo</button></a>";
        } else {
          echo "<a href='" . $this->generateDataUrl($column, $sortOrder, $selectedProvider, $email, $pageNo) . "'><button>$pageNo</button></a>";
        }
      }
    }

    if ($currentpage != $totalpages) {
      $nextpage = $currentpage + 1;
      echo "<a href='" . $this->generateDataUrl($column, $sortOrder, $selectedProvider, $email, $nextpage) . "'><button>></button></a>";
      echo "<a href='" . $this->generateDataUrl($column, $sortOrder, $selectedProvider, $email, $totalpages) . "'><button>>|</button></a>";
    }
    ?>
  </section>

  <script src="../js/subscribers.js"></script>
</body>

</html>