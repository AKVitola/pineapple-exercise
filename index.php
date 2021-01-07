<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="assets/img/pineapple.png">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/iconFontStyle.css">
  <script type='text/javascript' src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <title>Pineapple</title>
</head>
<body>
  <main class="main">
    <div class="flex-container">

      <section class="page-content">

         <?php include "partials/header.html" ?>

        <div class="mobile-page-container">
          <section class="subscripion-container mobile">
            <h1 class="heading">Subscribe to newsletter</h1>
            <p class="paragraph">Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>

            <form novalidate action="php/functionality.php" method="post" onsubmit="onsubmitValidation()">
              <label for="email"></label>
              <input class="email-input" id="js-email-input" type="email" id="email" name="email" placeholder="Type your email address here…" required oninput="oninputValidation()" >
              <button id="button" class="form-arrow-btn" type="submit" name="submit" value="submit">
                <span class="icon icon-ic_arrow" id="js-arrow-icon"></span>
              </button>
              <div class="error-container" id="js-error-container">
                <p class="error">
                <?php
                  if(isset($_SESSION["error"])) {
                    echo $_SESSION["error"];
                    unset($_SESSION['error']);
                  }
                ?>
                </p>
              </div>
              <div class="checkbox-wrap">
                <label>
                  <input id="js-checkbox" type="checkbox" name="terms" value="terms" required onchange="oncheckValidation()"/>
                  <span class="checkbox-text">
                    I agree to <a href="#"> terms of service</a>
                  </span>
                </label>
              </div>
            </form>
          </section> <!-- /.subscripion-container -->

          <?php include "partials/footer.html" ?>

          </div> <!-- /.mobile-page-container -->
        </section> <!-- /.page-content -->

        <section class="hero-image"></section>

    </div> <!-- /.flex-container -->
  </main>
</body>

<script src="js/validation.js"></script>
</html>