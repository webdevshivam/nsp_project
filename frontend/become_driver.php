<?php
include_once 'includes/header.php';
include_once 'includes/conn.php';

// Handle Become Driver Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);

  $query = "INSERT INTO become_driver (name, phone, email, address)
            VALUES ('$name', '$phone', '$email', '$address')";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Application submitted successfully!'); window.location.href='become_driver.php';</script>";
  } else {
    echo "<script>alert('Error occurred. Please try again.');</script>";
  }
}
?>

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Become a Driver</h3>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required />
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Phone Number" required />
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required />
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Your Address" required></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once 'includes/footer.php'; ?>
