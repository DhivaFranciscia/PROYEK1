<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DigiLib - Login</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="assets/style_login.css" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row login-container">
        <div class="col-md-6 d-none d-md-flex flex-column">
          <div class="logo-section">
            <img src="assets/img/Logoputih.png" alt="DigiLib Logo" />
          </div>
          <div class="d-flex align-items-center justify-content-center flex-grow-1">
            <img
              src="assets/img/bg_buku.png"
              alt="Books Illustration"
              class="illustration"
            />
          </div>
        </div>

        <div class="col-md-6 position-relative">
          <div class="register-link">
            Belum punya akun? <a href="register.php">Daftar akun</a>
          </div>

          <div class="login-section">
            <div class="login-header">
              <h1>Halo!</h1>
              <p>Selamat datang kembali di DigiLib!</p>
            </div>

            <form>
              <div class="mb-3">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Id"
                  required
                />
              </div>

              <div class="mb-3 password-wrapper">
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  placeholder="Password"
                  required
                />
                <i class="bi bi-eye-fill password-toggle" onclick="togglePassword()"></i>
              </div>

              <div class="forgot-password">
                <a href="#">lupa password?</a>
              </div>

              <button type="submit" class="btn btn-login">Login</button>
            </form>

            <div class="divider">atau login dengan</div>

            <div class="google-login">
              <a href="#" class="google-btn">
                <img src="https://cdn.cdnlogo.com/logos/g/35/google-icon.svg" alt="Google" width="40" height="40">
              </a>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.password-toggle');
        
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          toggleIcon.classList.remove('bi-eye-fill');
          toggleIcon.classList.add('bi-eye-slash-fill');
        } else {
          passwordInput.type = 'password';
          toggleIcon.classList.remove('bi-eye-slash-fill');
          toggleIcon.classList.add('bi-eye-fill');
        }
      }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>