<?php
include_once 'includes/header.php';
include_once 'includes/conn.php';

// Handle Add Inspection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
  $inspectionDate = $_POST['inspectionDate'];
  $vehicleId = $_POST['vehicleId'];
  $inspector = $_POST['inspector'];
  $condition = $_POST['condition'];
  $mileage = $_POST['mileage'];
  $remarks = $_POST['remarks'];

  $query = "INSERT INTO vehicle_inspections (inspection_date, vehicle_id, inspector, vehicle_condition, mileage, remarks)
              VALUES ('$inspectionDate', '$vehicleId', '$inspector', '$condition', '$mileage', '$remarks')";
  mysqli_query($conn, $query);
  header("Location: inspections.php");
  exit();
}

// Handle Delete Inspection
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM vehicle_inspections WHERE id = $id");
  header("Location: inspections.php");
  exit();
}
?>

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Vehicle Inspections</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addInspectionModal">
          Log New Inspection
        </button>
      </div>
    </div>

    <!-- Inspection Table -->
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Inspection Date</th>
              <th>Vehicle Name</th>
              <th>Inspector</th>
              <th>Condition</th>
              <th>Mileage</th>
              <th>Remarks</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $inspections = mysqli_query($conn, "SELECT vi.*, v.vehicle_name FROM vehicle_inspections vi
                                                JOIN vehicles v ON vi.vehicle_id = v.id
                                                ORDER BY vi.id DESC");
            while ($row = mysqli_fetch_assoc($inspections)) {
              echo "<tr>
                      <td>{$row['inspection_date']}</td>
                      <td>" . htmlspecialchars($row['vehicle_name']) . "</td>
                      <td>" . htmlspecialchars($row['inspector']) . "</td>
                      <td>" . htmlspecialchars($row['vehicle_condition']) . "</td>
                      <td>" . htmlspecialchars($row['mileage']) . "</td>
                      <td>" . htmlspecialchars($row['remarks']) . "</td>
                      <td>
                        <a href='?delete={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                      </td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add Inspection Modal -->
    <div class="modal fade" id="addInspectionModal" tabindex="-1" aria-labelledby="addInspectionModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="addInspectionModalLabel">Log New Inspection</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" value="add">

              <div class="mb-3">
                <label for="inspectionDate" class="form-label">Inspection Date</label>
                <input type="date" class="form-control" name="inspectionDate" id="inspectionDate" required />
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
                <label for="inspector" class="form-label">Inspector</label>
                <input type="text" class="form-control" name="inspector" id="inspector" placeholder="Inspector's Name" required />
              </div>
              <div class="mb-3">
                <label for="condition" class="form-label">Condition</label>
                <select class="form-control" id="condition" name="condition" required>
                  <option value="Excellent">Excellent</option>
                  <option value="Good">Good</option>
                  <option value="Fair">Fair</option>
                  <option value="Poor">Poor</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="mileage" class="form-label">Mileage</label>
                <input type="text" class="form-control" name="mileage" id="mileage" placeholder="Enter Mileage" required />
              </div>
              <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks" rows="3" placeholder="Additional notes or observations"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Inspection</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include_once 'includes/footer.php'; ?>
