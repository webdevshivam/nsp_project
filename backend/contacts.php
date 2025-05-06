<?php
include_once 'includes/header.php';
include_once 'includes/conn.php';

// Handle Delete Contact
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  mysqli_query($conn, "DELETE FROM contacts WHERE id = $id");
  header("Location: contacts.php");
  exit();
}
?>

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Contact Messages</h3>
      </div>
    </div>

    <!-- Contacts Table -->
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Received At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM contacts ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($query)) {
              echo "<tr>
                      <td>{$row['id']}</td>
                      <td>" . htmlspecialchars($row['name']) . "</td>
                      <td>" . htmlspecialchars($row['email']) . "</td>
                      <td>" . htmlspecialchars($row['subject']) . "</td>
                      <td>" . nl2br(htmlspecialchars($row['message'])) . "</td>
                      <td>{$row['created_at']}</td>
                      <td>
                        <a href='?delete={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this message?')\">Delete</a>
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
