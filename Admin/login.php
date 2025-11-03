<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carpet Me - Login</title>
  <link rel="stylesheet" href="../css/bootsrap.css">
  <style>
    /* ===== Body Background ===== */
    body {
      font-family: 'Georgia', serif;
      background: url('../assets/img/background.png') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* ===== Login Container ===== */
    .login-container {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      padding: 3rem;
      max-width: 950px;
      width: 95%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      backdrop-filter: blur(5px);
    }

    .login-left img {
      width: 320px;
      max-width: 100%;
    }

    .login-right {
      flex: 1;
      margin-left: 2rem;
    }

    h2 {
      font-style: italic;
      font-weight: 600;
      color: #2f2146;
    }

    .form-label {
      font-style: italic;
      font-weight: 500;
      color: #2f2146;
    }

    /* ===== Inputs ===== */
    .hex-input {
      width: 100%;
      border: 1px solid #fff;
      border-radius: 6px;
      padding: 0.7rem 24px;
      background-color: #fff;
      clip-path: polygon(8% 0, 92% 0, 100% 50%, 92% 100%, 8% 100%, 0 50%);
      font-style: italic;
    }

    .hex-input::placeholder {
      color: #7b7061;
    }

    .hex-input:focus {
      outline: none;
      background-color: #fff;
      border-color: #7D53F3;
    }

    /* ===== Buttons ===== */
    .hex-btn {
      display: inline-block;
      text-align: center;
      width: 100%;
      padding: 0.7rem;
      border: none;
      font-weight: 500;
      font-style: italic;
      color: white;
      background-color: #7D53F3;
      clip-path: polygon(8% 0, 92% 0, 100% 50%, 92% 100%, 8% 100%, 0 50%);
      transition: 0.3s;
    }

    .hex-btn:hover {
      background-color: #7D53F3cc;
    }

    .hex-outline-btn {
      display: inline-block;
      text-align: center;
      width: 100%;
      padding: 0.7rem;
      background: none;
      border: 2px solid #7D53F3;
      color: #7D53F3;
      font-style: italic;
      font-weight: 500;
      clip-path: polygon(8% 0, 92% 0, 100% 50%, 92% 100%, 8% 100%, 0 50%);
      transition: 0.3s;
    }

    .hex-outline-btn:hover {
      background-color: #7D53F3;
      color: white;
    }

    .form-check-label {
      font-size: 0.9rem;
      font-style: italic;
    }

    .forgot-password {
      font-size: 0.9rem;
      color: #7D53F3;
      text-decoration: none;
      font-style: italic;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    /* ===== Responsive ===== */
    @media (max-width: 992px) {
      .login-container {
        flex-direction: column;
        text-align: center;
      }

      .login-right {
        margin-left: 0;
        margin-top: 2rem;
      }
    }
  </style>
</head>

<body>

  <div class="login-container">
    <!-- Left side image -->
    <div class="login-left text-center">
      <img src="../assets/img/side2.png" alt="Carpet Pattern">
    </div>

    <!-- Right side form -->
    <div class="login-right">
      <div class="text-start mb-4">
        <small class="text-muted" style="font-style: italic;">VICTOR</small>
        <h2>Welcome to Victor Me,</h2>
        <p class="mb-4" style="font-style: italic;">Please Log in to your account.</p>
      </div>

      <form id="loginForm">
        <div class="mb-3">
          <label class="form-label">Email Address</label>
          <input type="email" name="username" class="hex-input" placeholder="youremail@gmail.com">
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="hex-input" placeholder="Enter your password">
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label for="remember" class="form-check-label">Remember me</label>
          </div>
          <a href="#" class="forgot-password">Forgot password?</a>
        </div>

        <button type="submit" class="hex-btn mb-3">Login</button>
        <button type="button" class="hex-outline-btn">Create account</button>
      </form>
    </div>
  </div>

  <script src="../js/sweetalert2.all.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/helper.js"></script>
  <script src="login.js"></script>

</body>

</html>