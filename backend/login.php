<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <title>Admin Login</title>
  <style>
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .login-card:hover {
      transform: translateY(-5px);
    }

    .form-control {
      border-radius: 10px;
      padding: 15px 20px;
      border: 2px solid #e0e0e0;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #203a43;
      box-shadow: 0 0 0 3px rgba(32, 58, 67, 0.2);
    }

    .btn-primary {
      background: linear-gradient(135deg, #0f2027, #203a43);
      border: none;
      padding: 15px 30px;
      border-radius: 10px;
      font-weight: 600;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .admin-badge {
      display: inline-block;
      background-color: #dc3545;
      color: white;
      font-size: 0.75rem;
      font-weight: bold;
      padding: 0.25rem 0.5rem;
      border-radius: 10px;
    }

    .security-note {
      font-size: 0.9rem;
      color: #b30000;
      text-align: center;
      margin-top: 1rem;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="login-card p-4">
          <div class="text-center mb-4">
            <h2 class="fw-bold mb-2" style="color: #2d3748;">Admin Login</h2>
            <span class="admin-badge"><i class="fas fa-shield-alt me-1"></i> SECURED</span>
            <p class="text-muted mt-3">Authorized personnel only</p>
          </div>

          <form action="login_action.php" method="post">
            <div class="mb-3">
              <label for="username" class="form-label fw-bold">Username</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
            </div>

            <input type="hidden" name="csrf_token" value="1b8fbf6c7fdf8d1da6b30754cfe66d6d8549950ca2f6bbea154beb4bfe8c7741">



            <div class="mb-4">
              <label for="password" class="form-label fw-bold">Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
                <input type="password" class="form-control" id="password" name="password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="fas fa-eye-slash"></i>
                </button>
              </div>

            </div>

            <button type="submit" class="btn btn-primary w-100 mb-2">
              <i class="fas fa-sign-in-alt me-2"></i>Login
            </button>
          </form>

          <div class="security-note">
            <i class="fas fa-exclamation-triangle me-1"></i>
            This portal is strictly for admin access only.
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      // Toggle icon
      togglePassword.innerHTML =
        type === 'password' ?
        '<i class="fas fa-eye-slash"></i>' :
        '<i class="fas fa-eye"></i>';
    });
  </script>

</body>

</html>
