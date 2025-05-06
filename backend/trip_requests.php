<?php
include_once 'includes/header.php';
include_once 'includes/conn.php';

// Handle Delete Trip Request
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  mysqli_query($conn, "DELETE FROM trip_requests WHERE id = $id");
  header("Location: trip_requests.php");
  exit();
}
?>

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Trip Requests</h3>
      </div>
    </div>

    <!-- Trip Requests Table -->
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Pickup Location</th>
              <th>Dropoff Location</th>
              <th>Pickup Date</th>
              <th>Dropoff Date</th>
              <th>Pickup Time</th>
              <th>Requested At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM trip_requests ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($query)) {
              echo "<tr>
                      <td>{$row['id']}</td>
                      <td>" . htmlspecialchars($row['name']) . "</td>
                      <td>" . htmlspecialchars($row['pickup_location']) . "</td>
                      <td>" . htmlspecialchars($row['dropoff_location']) . "</td>
                      <td>{$row['pickup_date']}</td>
                      <td>{$row['dropoff_date']}</td>
                      <td>{$row['pickup_time']}</td>
                      <td>{$row['created_at']}</td>
                      <td>
                        <a href='?delete={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this trip request?')\">Delete</a>
                      </td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<?php include_once 'includes/footer.php'; ?>
