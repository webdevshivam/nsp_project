<?php
include_once 'includes/header.php';
include_once 'includes/conn.php';

// Add Driver
if (isset($_POST['add_driver'])) {
  $name = $_POST['driverName'];
  $phone = $_POST['driverPhone'];
  $license = $_POST['driverLicense'];

  $conn->query("INSERT INTO drivers (name, phone, license_number) VALUES ('$name', '$phone', '$license')");
  echo "<script>window.location.href='" . $_SERVER['PHP_SELF'] . "';</script>";
  exit();
}

// Update Driver
if (isset($_POST['update_driver'])) {
  $id = $_POST['editDriverId'];
  $name = $_POST['editDriverName'];
  $phone = $_POST['editDriverPhone'];
  $license = $_POST['editDriverLicense'];

  $conn->query("UPDATE drivers SET name='$name', phone='$phone', license_number='$license' WHERE id=$id");
  echo "<script>window.location.href='" . $_SERVER['PHP_SELF'] . "';</script>";
  exit();
}

// Delete Driver
if (isset($_POST['delete_driver'])) {
  $id = $_POST['deleteDriverId'];
  $conn->query("DELETE FROM drivers WHERE id=$id");
  echo "<script>window.location.href='" . $_SERVER['PHP_SELF'] . "';</script>";
  exit();
}

// Fetch all drivers
$drivers = $conn->query("SELECT * FROM drivers");
?>


<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Driver Management</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addDriverModal">Add Driver</button>
      </div>
    </div>

    <!-- Driver List Table -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>License Number</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $drivers->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= $row['name'] ?></td>
              <td><?= $row['phone'] ?></td>
              <td><?= $row['license_number'] ?></td>
              <td>
                <button class="btn btn-info btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#editDriverModal"
                  onclick="fillEditForm(<?= $row['id'] ?>, '<?= $row['name'] ?>', '<?= $row['phone'] ?>', '<?= $row['license_number'] ?>')">Edit</button>

                <button class="btn btn-danger btn-sm"
                  data-bs-toggle="modal"
                  data-bs-target="#deleteDriverModal"
                  onclick="setDeleteId(<?= $row['id'] ?>)">Delete</button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- Add Driver Modal -->
    <div class="modal fade" id="addDriverModal" tabindex="-1" aria-labelledby="addDriverModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addDriverModalLabel">Add New Driver</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="driverName" class="form-label">Name</label>
              <input type="text" class="form-control" name="driverName" id="driverName" required>
            </div>
            <div class="mb-3">
              <label for="driverPhone" class="form-label">Phone</label>
              <input type="text" class="form-control" name="driverPhone" id="driverPhone" required>
            </div>
            <div class="mb-3">
              <label for="driverLicense" class="form-label">License Number</label>
              <input type="text" class="form-control" name="driverLicense" id="driverLicense" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="add_driver" class="btn btn-primary">Add Driver</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Driver Modal -->
    <div class="modal fade" id="editDriverModal" tabindex="-1" aria-labelledby="editDriverModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editDriverModalLabel">Edit Driver</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="editDriverId" id="editDriverId">
            <div class="mb-3">
              <label for="editDriverName" class="form-label">Name</label>
              <input type="text" class="form-control" name="editDriverName" id="editDriverName" required>
            </div>
            <div class="mb-3">
              <label for="editDriverPhone" class="form-label">Phone</label>
              <input type="text" class="form-control" name="editDriverPhone" id="editDriverPhone" required>
            </div>
            <div class="mb-3">
              <label for="editDriverLicense" class="form-label">License Number</label>
              <input type="text" class="form-control" name="editDriverLicense" id="editDriverLicense" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="update_driver" class="btn btn-primary">Update Driver</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Driver Modal -->
    <div class="modal fade" id="deleteDriverModal" tabindex="-1" aria-labelledby="deleteDriverModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteDriverModalLabel">Delete Driver</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this driver?</p>
            <input type="hidden" name="deleteDriverId" id="deleteDriverId">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="delete_driver" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Fill Edit Form
  function fillEditForm(id, name, phone, license) {
    document.getElementById('editDriverId').value = id;
    document.getElementById('editDriverName').value = name;
    document.getElementById('editDriverPhone').value = phone;
    document.getElementById('editDriverLicense').value = license;
  }

  // Set Delete ID
  function setDeleteId(id) {
    document.getElementById('deleteDriverId').value = id;
  }
</script>

<?php include_once 'includes/footer.php'; ?>
