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
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <title>Pineapple</title>
</head>
<body>

  <main class="main">
    <div class="flex-container">

      <section class="page-content">

        <header class="header">
          <a class="logo-container" href="#">
            <img class="company-logo" src="assets/img/logo_pineapple.png" alt="Company logo.">
            <img class="company-logo-mobile" src="assets/img/pineapple.png" alt="Company logo.">
          </a>
          <nav class="nav">
            <ul class="inner-nav">
              <li class="nav-item"><a href="#">About</a></li>
              <li class="nav-item"><a href="#">How it works</a></li>
              <li class="nav-item"><a href="#">Contact</a></li>
            </ul>
          </nav>
        </header>

        <div class="mobile-page-container">
          <section class="subscripion-container mobile">
            <h1 class="heading">Subscribe to newsletter</h1>
            <p class="paragraph">Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
            <form novalidate action="assets/php/functionality.php" method="post" onsubmit="onsubmitValidation()">
              <label for="email"></label>
              <input class="email-input" id="js-email-input" type="email" id="email" name="email" placeholder="Type your email address here…" required oninput="oninputValidation()" >
              <button id="button" class="form-arrow-btn" type="submit" name="submit" disabled>
                <span class="icon icon-ic_arrow" id="js-arrow-icon"></span>
              </button>
              <div class="error-container" id="js-error-container"></div>
              <div class="checkbox-wrap">
                <label>
                  <input id="js-checkbox" type="checkbox" name="terms-of-service" value="agree" required onchange="oncheckValidation()"/>
                  <span class="checkbox-text">
                    I agree to <a href="#"> terms of service</a>
                  </span>
                </label>
              </div>
            </form>
          </section> <!-- /.subscripion-container -->

          <footer class="footer">
            <section class="social-icon-wrap">
                <div class="social-icon facebook-wrap">
                  <a href="#">
                    <span class="icon-social icon-Facebook"></span>
                  </a>
                </div>
                <div class="social-icon instragram-wrap">
                  <a href="#">
                    <span class="icon-social icon-Instagram"></span>
                  </a>
                </div>
                <div class="social-icon twitter-wrap">
                  <a href="#">
                    <span class="icon-social icon-Twitter"></span>
                  </a>
                </div>
                <div class="social-icon youtube-wrap">
                  <a href="#">
                    <span class="icon-social icon-Youtube"></span>
                  </a>
                </div>
            </section> <!-- /.social-icon-wrap -->

          </footer>
          </div> <!-- /.mobile-page-container -->
        </section> <!-- /.page-content -->

        <section class="hero-image"></section>

    </div> <!-- /.flex-container -->
  </main>
</body>

<script src="assets/js/validation.js"></script>
</html>