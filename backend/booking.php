<?php
include_once 'includes/header.php';
include_once 'includes/conn.php';

// Handle Add Booking
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
  $customerName = $_POST['customerName'];
  $vehicleId = $_POST['vehicleId'];
  $bookingDate = $_POST['bookingDate'];
  $returnDate = $_POST['returnDate'];
  $status = $_POST['status'];

  $query = "INSERT INTO bookings (customer_name, vehicle_id, booking_date, return_date, status)
            VALUES ('$customerName', '$vehicleId', '$bookingDate', '$returnDate', '$status')";
  mysqli_query($conn, $query);
  header("Location: bookings.php");
  exit();
}

// Handle Delete Booking
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM bookings WHERE id = $id");
  header("Location: bookings.php");
  exit();
}
?>

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Vehicle Bookings</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addBookingModal">
          Add New Booking
        </button>
      </div>
    </div>

    <!-- Booking Table -->
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Booking ID</th>
              <th>Customer Name</th>
              <th>Vehicle Name</th>
              <th>Booking Date</th>
              <th>Return Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $bookings = mysqli_query($conn, "SELECT b.*, v.vehicle_name FROM bookings b
                                              JOIN vehicles v ON b.vehicle_id = v.id
                                              ORDER BY b.id DESC");
            while ($row = mysqli_fetch_assoc($bookings)) {
              echo "<tr>
                      <td>BK" . str_pad($row['id'], 3, '0', STR_PAD_LEFT) . "</td>
                      <td>" . htmlspecialchars($row['customer_name']) . "</td>
                      <td>" . htmlspecialchars($row['vehicle_name']) . "</td>
                      <td>{$row['booking_date']}</td>
                      <td>{$row['return_date']}</td>
                      <td>" . htmlspecialchars($row['status']) . "</td>
                      <td>
                        <a href='?delete={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this booking?')\">Delete</a>
                      </td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add Booking Modal -->
    <div class="modal fade" id="addBookingModal" tabindex="-1" aria-labelledby="addBookingModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="addBookingModalLabel">Add New Booking</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" value="add">

              <div class="mb-3">
                <label for="customerName" class="form-label">Customer Name</label>
                <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Enter Customer Name" required />
              </div>
              <div class="mb-3">
                <label for="vehicleId" class="form-label">Vehicle</label>
                <select class="form-control" id="vehicleId" name="vehicleId" required>
                  <option value="">Select Vehicle</option>
                  <?php
                  $vehicle_query = mysqli_query($conn, "SELECT id, vehicle_name FROM vehicles");
                  while ($vehicle = mysqli_fetch_assoc($vehicle_query)) {
                    echo '<option value="' . $vehicle['id'] . '">' . htmlspecialchars($vehicle['vehicle_name']) . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="bookingDate" class="form-label">Booking Date</label>
                <input type="date" class="form-control" id="bookingDate" name="bookingDate" required />
              </div>
              <div class="mb-3">
                <label for="returnDate" class="form-label">Return Date</label>
                <input type="date" class="form-control" id="returnDate" name="returnDate" required />
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                  <option value="Pending">Pending</option>
                  <option value="Confirmed">Confirmed</option>
                  <option value="Completed">Completed</option>
                  <option value="Cancelled">Cancelled</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Booking</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include_once 'includes/footer.php'; ?>
