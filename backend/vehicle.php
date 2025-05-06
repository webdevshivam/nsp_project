<?php

include_once 'includes/conn.php';

// Handle Add Vehicle
if (isset($_POST['addVehicle'])) {
  $vehicleName = $_POST['vehicleName'];
  $vehicleModel = $_POST['vehicleModel'];
  $licensePlate = $_POST['licensePlate'];
  $vehicleType = $_POST['vehicleType'];
  $pricePerDay = $_POST['pricePerDay'];

  // Validate required image
  if (empty($_FILES['vehicleImage']['name'])) {
    $_SESSION['error'] = 'Vehicle image is required.';
    echo '<script type="text/javascript">',
    'window.location.href = window.location.href;',
    '</script>';
    exit();
  }

  // Validate image file
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  $fileExtension = strtolower(pathinfo($_FILES['vehicleImage']['name'], PATHINFO_EXTENSION));
  if (!in_array($fileExtension, $allowedExtensions)) {
    $_SESSION['error'] = 'Invalid file type. Only JPG, JPEG, PNG, GIF allowed.';
    echo '<script type="text/javascript">',
    'window.location.href = window.location.href;',
    '</script>';
    exit();
  }

  // Upload Image
  $imageName = time() . '_' . uniqid() . '.' . $fileExtension;
  $uploadPath = 'uploads/' . $imageName;

  if (!move_uploaded_file($_FILES['vehicleImage']['tmp_name'], $uploadPath)) {
    $_SESSION['error'] = 'Failed to upload image.';
    echo '<script type="text/javascript">',
    'window.location.href = window.location.href;',
    '</script>';
    exit();
  }

  $stmt = $conn->prepare("INSERT INTO vehicles (vehicle_name, model, license_plate, type, image, per_day_price) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssd", $vehicleName, $vehicleModel, $licensePlate, $vehicleType, $imageName, $pricePerDay);
  if ($stmt->execute()) {
    $_SESSION['success'] = 'Vehicle added successfully.';
  } else {
    $_SESSION['error'] = 'Error adding vehicle.';
  }
  $stmt->close();
  echo '<script type="text/javascript">',
  'window.location.href = window.location.href;',
  '</script>';
  exit();
}

// Handle Edit Vehicle
if (isset($_POST['editVehicle'])) {
  $editId = $_POST['editVehicleId'];
  $vehicleName = $_POST['editVehicleName'];
  $vehicleModel = $_POST['editVehicleModel'];
  $licensePlate = $_POST['editLicensePlate'];
  $vehicleType = $_POST['editVehicleType'];
  $pricePerDay = $_POST['editPricePerDay'];
  $newImageUploaded = !empty($_FILES['editVehicleImage']['name']);

  // Get old image name
  $oldImage = '';
  $stmt = $conn->prepare("SELECT image FROM vehicles WHERE id = ?");
  $stmt->bind_param("i", $editId);
  $stmt->execute();
  $stmt->bind_result($oldImage);
  $stmt->fetch();
  $stmt->close();

  if ($newImageUploaded) {
    // Validate new image
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $fileExtension = strtolower(pathinfo($_FILES['editVehicleImage']['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
      $_SESSION['error'] = 'Invalid file type. Only JPG, JPEG, PNG, GIF allowed.';
      echo '<script type="text/javascript">',
      'window.location.href = window.location.href;',
      '</script>';
      exit();
    }

    // Delete old image
    if (!empty($oldImage) && file_exists("uploads/$oldImage")) {
      unlink("uploads/$oldImage");
    }

    // Upload new image
    $imageName = time() . '_' . uniqid() . '.' . $fileExtension;
    $uploadPath = 'uploads/' . $imageName;
    if (!move_uploaded_file($_FILES['editVehicleImage']['tmp_name'], $uploadPath)) {
      $_SESSION['error'] = 'Failed to upload new image.';
      echo '<script type="text/javascript">',
      'window.location.href = window.location.href;',
      '</script>';
      exit();
    }

    $stmt = $conn->prepare("UPDATE vehicles SET vehicle_name=?, model=?, license_plate=?, type=?, image=?, per_day_price=? WHERE id=?");
    $stmt->bind_param("sssssdi", $vehicleName, $vehicleModel, $licensePlate, $vehicleType, $imageName, $pricePerDay, $editId);
  } else {
    $stmt = $conn->prepare("UPDATE vehicles SET vehicle_name=?, model=?, license_plate=?, type=?, per_day_price=? WHERE id=?");
    $stmt->bind_param("ssssdi", $vehicleName, $vehicleModel, $licensePlate, $vehicleType, $pricePerDay, $editId);
  }

  if ($stmt->execute()) {
    $_SESSION['success'] = 'Vehicle updated successfully.';
  } else {
    $_SESSION['error'] = 'Error updating vehicle.';
  }
  $stmt->close();
  echo '<script type="text/javascript">',
  'window.location.href = window.location.href;',
  '</script>';
  exit();
}

// Handle Delete Vehicle
if (isset($_POST['deleteVehicle'])) {
  $deleteId = $_POST['deleteVehicleId'];

  // Get image name
  $stmt = $conn->prepare("SELECT image FROM vehicles WHERE id = ?");
  $stmt->bind_param("i", $deleteId);
  $stmt->execute();
  $stmt->bind_result($imageName);
  $stmt->fetch();
  $stmt->close();

  // Delete from database
  $stmt = $conn->prepare("DELETE FROM vehicles WHERE id=?");
  $stmt->bind_param("i", $deleteId);
  if ($stmt->execute()) {
    // Delete image file
    if (!empty($imageName) && file_exists("uploads/$imageName")) {
      unlink("uploads/$imageName");
    }
    $_SESSION['success'] = 'Vehicle deleted successfully.';
  } else {
    $_SESSION['error'] = 'Error deleting vehicle.';
  }
  $stmt->close();
  echo '<script type="text/javascript">',
  'window.location.href = window.location.href;',
  '</script>';
  exit();
}

include_once 'includes/header.php';
?>

<div class="container">
  <div class="page-inner">
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['error'];
                                      unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert alert-success"><?= $_SESSION['success'];
                                        unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Vehicle Management</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addVehicleModal">Add Vehicle</button>
      </div>
    </div>

    <!-- Vehicle List Table -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Vehicle Image</th>
            <th>Vehicle Name</th>
            <th>Model</th>
            <th>License Plate</th>
            <th>Type</th>
            <th>Price/Day</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = $conn->query("SELECT * FROM vehicles");
          while ($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $row['id']; ?></td>
              <td>
                <?php if ($row['image']): ?>
                  <img src="uploads/<?= $row['image']; ?>" width="100" alt="Vehicle Image">
                <?php else: ?>
                  No Image
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($row['vehicle_name']); ?></td>
              <td><?= htmlspecialchars($row['model']); ?></td>
              <td><?= htmlspecialchars($row['license_plate']); ?></td>
              <td><?= htmlspecialchars($row['type']); ?></td>
              <td>₹<?= number_format($row['per_day_price'], 2); ?></td>
              <td>
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editVehicleModal<?= $row['id']; ?>">Edit</button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteVehicleModal<?= $row['id']; ?>">Delete</button>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editVehicleModal<?= $row['id']; ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5>Edit Vehicle</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="editVehicleId" value="<?= $row['id']; ?>">
                      <div class="mb-3">
                        <label>Vehicle Name</label>
                        <input type="text" name="editVehicleName" class="form-control" value="<?= htmlspecialchars($row['vehicle_name']); ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>Model</label>
                        <input type="text" name="editVehicleModel" class="form-control" value="<?= htmlspecialchars($row['model']); ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>License Plate</label>
                        <input type="text" name="editLicensePlate" class="form-control" value="<?= htmlspecialchars($row['license_plate']); ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>Type</label>
                        <select name="editVehicleType" class="form-control" required>
                          <option <?= ($row['type'] == 'Sedan') ? 'selected' : ''; ?>>Sedan</option>
                          <option <?= ($row['type'] == 'SUV') ? 'selected' : ''; ?>>SUV</option>
                          <option <?= ($row['type'] == 'Truck') ? 'selected' : ''; ?>>Truck</option>
                          <option <?= ($row['type'] == 'Van') ? 'selected' : ''; ?>>Van</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label>Price per Day</label>
                        <input type="number" name="editPricePerDay" step="0.01" class="form-control" value="<?= $row['per_day_price']; ?>" required>
                      </div>
                      <div class="mb-3">
                        <label>Change Vehicle Image (optional)</label>
                        <input type="file" name="editVehicleImage" class="form-control" accept="image/*">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="editVehicle" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteVehicleModal<?= $row['id']; ?>" tabindex="-1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST">
                    <div class="modal-header">
                      <h5>Delete Vehicle</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to delete <strong><?= htmlspecialchars($row['vehicle_name']); ?></strong>?
                      <input type="hidden" name="deleteVehicleId" value="<?= $row['id']; ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="deleteVehicle" class="btn btn-danger">Delete</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addVehicleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5>Add New Vehicle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Vehicle Name</label>
            <input type="text" name="vehicleName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Model</label>
            <input type="text" name="vehicleModel" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>License Plate</label>
            <input type="text" name="licensePlate" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Type</label>
            <select name="vehicleType" class="form-control" required>
              <option>Sedan</option>
              <option>SUV</option>
              <option>Truck</option>
              <option>Van</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Price per Day</label>
            <input type="number" name="pricePerDay" step="0.01" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Vehicle Image</label>
            <input type="file" name="vehicleImage" class="form-control" accept="image/*" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="addVehicle" class="btn btn-primary">Add Vehicle</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include_once 'includes/footer.php';
?>
