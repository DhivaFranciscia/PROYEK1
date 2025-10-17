<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DigiLib - Daftar</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="assets/style_daftar.css" />
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
              <div class="google-btn">
                <svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="20" cy="20" r="20" fill="white"/>
                  <path d="M30.7 20.2c0-.8-.1-1.6-.2-2.3H20v4.4h6c-.3 1.4-1 2.6-2.2 3.4v2.8h3.5c2.1-1.9 3.3-4.7 3.3-8.3z" fill="#4285F4"/>
                  <path d="M20 31c3 0 5.5-1 7.3-2.7l-3.5-2.8c-1 .7-2.3 1.1-3.8 1.1-2.9 0-5.4-2-6.3-4.6h-3.6v2.9C11.9 28.7 15.6 31 20 31z" fill="#34A853"/>
                  <path d="M13.7 22c-.2-.7-.4-1.5-.4-2.2s.1-1.5.4-2.2v-2.9h-3.6c-.8 1.5-1.2 3.1-1.2 4.9s.4 3.5 1.2 4.9l3.6-2.9z" fill="#FBBC05"/>
                  <path d="M20 12.6c1.6 0 3.1.6 4.2 1.7l3.2-3.2C25.5 9.4 23 8.4 20 8.4c-4.4 0-8.1 2.3-10 5.9l3.6 2.9c.9-2.6 3.4-4.6 6.4-4.6z" fill="#EA4335"/>
                </svg>
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