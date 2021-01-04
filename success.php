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

         <?php include "assets/partials/header.html" ?>

         <div class="mobile-page-container">
          <div class="success-cup"></div>
          <section class="subscripion-container mobile">
            <h1 class="heading">Thanks for subscribing!</h1>
            <p class="paragraph underline">You have successfully subscribed to our email listing. Check your email for the discount code.</p>
          </section> <!-- /.subscripion-container -->

          <?php include "assets/partials/footer.html" ?>

          </div> <!-- /.mobile-page-container -->
        </section> <!-- /.page-content -->

        <section class="hero-image"></section>

    </div> <!-- /.flex-container -->
  </main>
</body>

<script src="assets/js/validation.js"></script>
</html>