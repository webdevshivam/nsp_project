<!DOCTYPE html>
<html lang="en">

<head>
  <title>
    Car DIKHAO - Car Rental mangement sytem created by shivam kushwah and
    tanish Agarwal
  </title>

  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css" />
  <link rel="stylesheet" href="css/animate.css" />

  <link rel="stylesheet" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" href="css/owl.theme.default.min.css" />
  <link rel="stylesheet" href="css/magnific-popup.css" />

  <link rel="stylesheet" href="css/aos.css" />

  <link rel="stylesheet" href="css/ionicons.min.css" />

  <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
  <link rel="stylesheet" href="css/jquery.timepicker.css" />

  <link rel="stylesheet" href="css/flaticon.css" />
  <link rel="stylesheet" href="css/icomoon.css" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <nav
    class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
    id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">Car<span>DIKHAO</span>
        <small class="text-white" style="font-size: 12px">created by <b>Shivam</b> and <b>Tanish</b></small>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#ftco-nav"
        aria-controls="ftco-nav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <?php
        $page = basename($_SERVER['PHP_SELF'], ".php"); // Get the page name without the .php extension
        ?>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php if ($page == 'home') echo 'active'; ?>">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item <?php if ($page == 'about') echo 'active'; ?>">
            <a href="about.php" class="nav-link">About</a>
          </li>
          <li class="nav-item <?php if ($page == 'services') echo 'active'; ?>">
            <a href="services.php" class="nav-link">Services</a>
          </li>
          <li class="nav-item <?php if ($page == 'pricing') echo 'active'; ?>">
            <a href="pricing.php" class="nav-link">Pricing</a>
          </li>
          <li class="nav-item <?php if ($page == 'cars') echo 'active'; ?>">
            <a href="car.php" class="nav-link">Cars</a>
          </li>
          <li class="nav-item <?php if ($page == 'blog') echo 'active'; ?>">
            <a href="blog.php" class="nav-link">Blog</a>
          </li>
          <li class="nav-item <?php if ($page == 'contact') echo 'active'; ?>">
            <a href="contact.php" class="nav-link">Contact</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
  <!-- END nav -->
