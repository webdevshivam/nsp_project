<?php
include_once 'includes/header.php';
?>
<div class="container">
  <div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Rental Agreements</h3>
      </div>
      <div class="ms-md-auto py-2 py-md-0">
        <button
          class="btn btn-primary btn-round"
          data-bs-toggle="modal"
          data-bs-target="#addAgreementModal">
          Add New Agreement
        </button>
      </div>
    </div>

    <!-- Rental Agreement Table -->
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Agreement ID</th>
              <th>Customer Name</th>
              <th>Vehicle ID</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Sample row data -->
            <tr>
              <td>AG001</td>
              <td>Rahul Sharma</td>
              <td>VH1234</td>
              <td>2024-11-01</td>
              <td>2024-11-10</td>
              <td>Active</td>
              <td>
                <button class="btn btn-icon btn-link op-8">
                  <i class="far fa-eye"></i>
                </button>
                <button class="btn btn-icon btn-link btn-danger op-8">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
            <!-- Additional rows will be dynamically generated here -->
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add Rental Agreement Modal -->
    <div
      class="modal fade"
      id="addAgreementModal"
      tabindex="-1"
      aria-labelledby="addAgreementModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addAgreementModalLabel">
              Add New Rental Agreement
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addAgreementForm">
              <div class="mb-3">
                <label for="customerName" class="form-label">Customer Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="customerName"
                  placeholder="Enter Customer Name"
                  required />
              </div>
              <div class="mb-3">
                <label for="vehicleId" class="form-label">Vehicle ID</label>
                <input
                  type="text"
                  class="form-control"
                  id="vehicleId"
                  placeholder="Enter Vehicle ID"
                  required />
              </div>
              <div class="mb-3">
                <label for="startDate" class="form-label">Start Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="startDate"
                  required />
              </div>
              <div class="mb-3">
                <label for="endDate" class="form-label">End Date</label>
                <input
                  type="date"
                  class="form-control"
                  id="endDate"
                  required />
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" required>
                  <option value="Pending">Pending</option>
                  <option value="Active">Active</option>
                  <option value="Completed">Completed</option>
                  <option value="Cancelled">Cancelled</option>
                </select>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal">
                  Close
                </button>
                <button type="submit" class="btn btn-primary">
                  Save Agreement
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once 'includes/footer.php';
?>
