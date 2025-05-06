<?php
ob_start();

session_start();


if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit();
}

// Database connection
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Car DIKHAO - Created by Shivam kushwah and Tanish Agarwal</title>

  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ['Public Sans:300,400,500,600,700']
      },
      custom: {
        families: [
          'Font Awesome 5 Solid',
          'Font Awesome 5 Regular',
          'Font Awesome 5 Brands',
          'simple-line-icons',
        ],
        urls: ['assets/css/fonts.min.css'],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/plugins.min.css" />
  <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />

  <link rel="stylesheet" href="assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.php" class="navbar-brand fw-bold fs-3">
            <span style="font-weight: bold; color: #ff6600">Car</span><span style="color: white">DIKHAO</span>
          </a>

          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item">
              <a href="index.php">
                <i class="fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="driver.php">
                <i class="fas fa-user-tie"></i>
                <p>Driver</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="vehicle.php">
                <i class="fas fa-car"></i>
                <p>Vehicle</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="inspection.php">
                <i class="fas fa-clipboard-check"></i>
                <p>Inspection</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="booking.php">
                <i class="fas fa-calendar-check"></i>
                <p>Booking</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="rental-agreement.php">
                <i class="fas fa-file-contract"></i>
                <p>Rental Agreement</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="expense.php">
                <i class="fas fa-money-bill-wave"></i>
                <p>Expense</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="trip_requests.php">
                <i class="fas fa-route"></i>
                <p>Trip Request</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="contacts.php">
                <i class="fas fa-address-book"></i>
                <p>Contact Entries</p>
              </a>
            </li>
          </ul>

        </div>
      </div>
    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.php" class="logo">
              <img
                src="assets/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav
          class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">
            <nav
              class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input
                  type="text"
                  placeholder="Search ..."
                  class="form-control" />
              </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li
                class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  href="#"
                  role="button"
                  aria-expanded="false"
                  aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input
                        type="text"
                        placeholder="Search ..."
                        class="form-control" />
                    </div>
                  </form>
                </ul>
              </li>

              <li class="nav-item topbar-user dropdown hidden-caret">
                <a
                  class="dropdown-toggle profile-pic"
                  data-bs-toggle="dropdown"
                  href="#"
                  aria-expanded="false">
                  <div class="avatar-sm">
                    <img
                      src="assets/img/profile.jpg"
                      alt="..."
                      class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">Shivam Kushwah</span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img
                            src="assets/img/profile.jpg"
                            alt="image profile"
                            class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <h4>Shivam</h4>
                          <p class="text-muted">
                            2023pietcsshivam151@poornima.org
                          </p>
                          <a
                            href="profile.php"
                            class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">My Profile</a>

                      <div class="dropdown-divider"></div>

                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Logout</a>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
