<?php include_once 'includes/header.php'; ?>
<!-- END nav -->

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg')" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
          <span>Cars <i class="ion-ios-arrow-forward"></i></span>
        </p>
        <h1 class="mb-3 bread">Choose Your Car</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row">
      <?php
      // Include database connection
      include 'includes/conn.php';

      // Query to fetch all vehicles
      $sql = "SELECT * FROM vehicles";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $vehicle_name = $row['vehicle_name'];
          $model = $row['model'];
          $license_plate = $row['license_plate'];
          $price_per_day = $row['per_day_price'];
          $image_url = $row['image'] ? "../backend/uploads/{$row['image']}" : "images/default_car.jpg"; // Default image if no image is set
      ?>
          <div class="col-md-4">
            <div class="car-wrap rounded ftco-animate">
              <div class="img rounded d-flex align-items-end" style="background-image: url(<?php echo $image_url; ?>)"></div>
              <div class="text">
                <h2 class="mb-0">
                  <a href="car-single.php?id=<?php echo $row['id']; ?>"><?php echo $vehicle_name; ?> - <?php echo $model; ?></a>
                </h2>
                <div class="d-flex mb-3">
                  <span class="cat"><?php echo $license_plate; ?></span>
                  <p class="price ml-auto">$<?php echo number_format($price_per_day, 2); ?> <span>/day</span></p>
                </div>
                <p class="d-flex mb-0 d-block">
                  <a href="book.php?vehicle_id=<?php echo $row['id']; ?>" class="btn btn-primary py-2 mr-1">Book now</a>
                  <a href="car-single.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary py-2 ml-1">Details</a>
                </p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No cars available at the moment.</p>";
      }

      // Close connection
      $conn->close();
      ?>
    </div>

  </div>
</section>

<?php include_once 'includes/footer.php'; ?>
