<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrasi - Absensi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #e6f0ff;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .register-box {
      background-color: #cfe0ff;
      border-radius: 15px;
      padding: 40px 50px;
      width: 420px;
      box-shadow: 0 0 15px rgba(173, 216, 230, 0.4);
    }
    h2 {
      text-align: center;
      font-weight: 700;
      margin-bottom: 25px;
      color: #0d2e4a;
    }
    .form-control {
      border-radius: 10px;
      height: 45px;
      border: 1px solid #7da9f2;
    }
    .form-control:focus {
      box-shadow: 0 0 5px #7da9f2;
      border-color: #7da9f2;
    }
    .btn-primary {
      background-color: #4a90e2;
      border: none;
      border-radius: 10px;
      height: 45px;
      font-weight: 600;
    }
    .btn-primary:hover {
      background-color: #3571c1;
    }
    .toggle-password {
      position: absolute;
      right: 10px;
      top: 10px;
      cursor: pointer;
      color: #5b8fcf;
      font-size: 18px;
    }
    .position-relative { position: relative; }
    .text-center a { color: #2e5da0; font-weight: 500; text-decoration: none; }
    .text-center a:hover { text-decoration: underline; }
  </style>
</head>
<body>

<div class="register-box">
  <h2>REGISTRASI</h2>

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
      <label for="name" class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
    </div>

    <div class="mb-3 position-relative">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
      <span class="toggle-password" onclick="togglePassword('password', this)">👁️</span>
    </div>

    <div class="mb-3 position-relative">
      <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Ulangi password" required>
      <span class="toggle-password" onclick="togglePassword('password_confirmation', this)">👁️</span>
    </div>

    <button type="submit" class="btn btn-primary w-100">Registrasi</button>

    <div class="text-center mt-3">
      <span>Sudah punya akun?</span>
      <a href="{{ route('login') }}">Login</a>
    </div>
  </form>
</div>

<script>
function togglePassword(id, el) {
  const input = document.getElementById(id);
  input.type = input.type === "password" ? "text" : "password";
  el.textContent = input.type === "password" ? "👁️" : "🙈";
}
</script>

</body>
</html>
