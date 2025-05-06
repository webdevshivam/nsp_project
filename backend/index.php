<?php
include_once 'includes/header.php';
include_once 'includes/conn.php';  // Include database connection

// Fetch total drivers
$result_drivers = $conn->query("SELECT COUNT(*) as total FROM drivers");
$drivers = $result_drivers->fetch_assoc();

// Fetch total bookings
$result_bookings = $conn->query("SELECT COUNT(*) as total FROM bookings");
$bookings = $result_bookings->fetch_assoc();

// Fetch total income (assuming you want the sum of all vehicle rental income)
$result_income = $conn->query("SELECT SUM(per_day_price) as total FROM vehicles");
$income = $result_income->fetch_assoc();

// Fetch total expense
$result_expense = $conn->query("SELECT SUM(amount) as total FROM expenses");
$expense = $result_expense->fetch_assoc();

// Fetch new trip requests (limit to 5)
$result_trip_requests = $conn->query("SELECT * FROM trip_requests LIMIT 5");
$trip_requests = $result_trip_requests->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
        <a href="#" class="btn btn-primary btn-round">Add Trip Request</a>
      </div>
    </div>

    <div class="row">
      <!-- Total Driver Card -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary bubble-shadow-small">
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Drivers</p>
                  <h4 class="card-title"><?php echo $drivers['total']; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Booking Card -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info bubble-shadow-small">
                  <i class="fas fa-user-check"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Bookings</p>
                  <h4 class="card-title"><?php echo $bookings['total']; ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Income Card -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success bubble-shadow-small">
                  <i class="fas fa-luggage-cart"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Income</p>
                  <h4 class="card-title">$ <?php echo number_format($income['total'], 2); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Expense Card -->
      <div class="col-sm-6 col-md-3">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                  <i class="far fa-check-circle"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Expense</p>
                  <h4 class="card-title">$ <?php echo number_format($expense['total'], 2); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- New Trip Requests -->
    <div class="row">
      <div class="col-md-4">
        <div class="card card-round">
          <div class="card-body">
            <div class="card-head-row card-tools-still-right">
              <div class="card-title">New Trip Requests</div>
              <div class="card-tools">
                <div class="dropdown">
                  <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-list py-4">
              <?php foreach ($trip_requests as $request): ?>
                <div class="item-list">
                  <div class="avatar">

                  </div>
                  <div class="info-user ms-3">
                    <div class="username"><?php echo $request['name']; ?></div>
                    <div class="status">Pickup: <?php echo $request['pickup_location']; ?> - Dropoff: <?php echo $request['dropoff_location']; ?></div>
                  </div>
                  <button class="btn btn-icon btn-link op-8 me-1">
                    <i class="far fa-envelope"></i>
                  </button>
                  <button class="btn btn-icon btn-link btn-danger op-8">
                    <i class="fas fa-ban"></i>
                  </button>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once 'includes/footer.php'; ?>
