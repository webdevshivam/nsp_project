<?php
include_once 'includes/header.php';
include_once 'includes/conn.php'; // Database connection

// Handle Add Expense
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
  $expenseType = mysqli_real_escape_string($conn, $_POST['expenseType']);
  $amount = (float)$_POST['amount'];
  $expenseDate = mysqli_real_escape_string($conn, $_POST['expenseDate']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);

  $query = "INSERT INTO expenses (expense_type, amount, expense_date, description)
              VALUES ('$expenseType', '$amount', '$expenseDate', '$description')";
  mysqli_query($conn, $query);

  header("Location: expenses.php");
  exit();
}

// Handle Delete Expense
if (isset($_GET['delete'])) {
  $id = (int)$_GET['delete'];
  mysqli_query($conn, "DELETE FROM expenses WHERE id = $id");

  header("Location: expenses.php");
  exit();
}
?>

<div class="container">
  <div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Expenses</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
          Add New Expense
        </button>
      </div>
    </div>

    <!-- Expense Table -->
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Expense Type</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $expenses = mysqli_query($conn, "SELECT * FROM expenses ORDER BY id DESC");
            while ($row = mysqli_fetch_assoc($expenses)) {
              echo "<tr>
                      <td>{$row['id']}</td>
                      <td>" . htmlspecialchars($row['expense_type']) . "</td>
                      <td>₹" . htmlspecialchars($row['amount']) . "</td>
                      <td>" . htmlspecialchars($row['expense_date']) . "</td>
                      <td>" . htmlspecialchars($row['description']) . "</td>
                      <td>
                        <a href='?delete={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete?')\">
                          Delete
                        </a>
                      </td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add Expense Modal -->
    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST">
            <div class="modal-header">
              <h5 class="modal-title" id="addExpenseModalLabel">Add New Expense</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" value="add">
              <div class="mb-3">
                <label for="expenseType" class="form-label">Expense Type</label>
                <input type="text" class="form-control" name="expenseType" id="expenseType" required />
              </div>
              <div class="mb-3">
                <label for="amount" class="form-label">Amount (in ₹)</label>
                <input type="number" step="0.01" class="form-control" name="amount" id="amount" required />
              </div>
              <div class="mb-3">
                <label for="expenseDate" class="form-label">Date</label>
                <input type="date" class="form-control" name="expenseDate" id="expenseDate" required />
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Expense</button>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<?php include_once 'includes/footer.php'; ?>
