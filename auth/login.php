<?php
session_start();

// ── Simple demo handler ──────────────────────────────────────────────────────
// Replace this block with your actual DB logic.
$loginError    = '';
$registerError = '';
$registerOk    = false;
$activeTab     = 'login'; // which tab to show on load

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ── LOGIN ──
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $activeTab = 'login';
        $email    = trim($_POST['email']    ?? '');
        $password =       $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $loginError = 'Email dan kata sandi wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $loginError = 'Format email tidak valid.';
        } else {
            // TODO: replace with real DB check
            // Example:
            // $user = getUserByEmail($email);
            // if ($user && password_verify($password, $user['password_hash'])) { ... }
            if ($email === 'demo@anns.id' && $password === 'demo1234') {
                $_SESSION['user_email'] = $email;
                header('Location: index.php'); // redirect after login
                exit;
            } else {
                $loginError = 'Email atau kata sandi salah.';
            }
        }
    }

    // ── REGISTER ──
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $activeTab = 'register';
        $name      = trim($_POST['name']       ?? '');
        $email     = trim($_POST['reg_email']  ?? '');
        $password  =       $_POST['reg_password'] ?? '';
        $confirm   =       $_POST['reg_confirm']  ?? '';

        if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
            $registerError = 'Semua kolom wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $registerError = 'Format email tidak valid.';
        } elseif (strlen($password) < 8) {
            $registerError = 'Kata sandi minimal 8 karakter.';
        } elseif ($password !== $confirm) {
            $registerError = 'Konfirmasi kata sandi tidak cocok.';
        } else {
            // TODO: save to DB
            // $hash = password_hash($password, PASSWORD_DEFAULT);
            // insertUser($name, $email, $hash);
            $registerOk = true;
            $activeTab  = 'login';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ann's — Masuk / Daftar</title>
  <link rel="stylesheet" href="../assets/styles/main.css" />
</head>
<body>

  <!-- ── NAVBAR ── -->
  <?php
  include '../components/navbar/navbar.php';  // ← tambah ini
  ?>

  <!-- ── AUTH CARD ── -->
  <main class="auth-wrapper">
    <div class="auth-card">

      <!-- Tabs -->
      <div class="auth-tabs">
        <button class="auth-tab <?= $activeTab === 'login'    ? 'active' : '' ?>"
                onclick="switchTab('login')"    id="tab-login">Log Masuk</button>
        <button class="auth-tab <?= $activeTab === 'register' ? 'active' : '' ?>"
                onclick="switchTab('register')" id="tab-register">Daftar</button>
      </div>

      <!-- ── LOGIN PANEL ── -->
      <div class="auth-panel <?= $activeTab === 'login' ? 'active' : '' ?>" id="panel-login">

        <?php if ($registerOk): ?>
          <div class="alert-success show">Akun berhasil dibuat! Silakan log masuk.</div>
        <?php endif; ?>

        <?php if ($loginError): ?>
          <div class="alert-success" style="background:#fff0f0;border-color:#f5c6cb;color:#c0392b;display:block">
            <?= htmlspecialchars($loginError) ?>
          </div>
        <?php endif; ?>

        <form method="POST" novalidate id="form-login">
          <input type="hidden" name="action" value="login" />

          <div class="form-group">
            <label class="form-label">
              <span>Email</span>
            </label>
            <input
              type="email"
              name="email"
              class="form-input <?= ($loginError && empty($_POST['email'])) ? 'error' : '' ?>"
              placeholder="Email"
              value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
              autocomplete="email"
              required
            />
            <div class="form-error">Masukkan alamat email yang valid.</div>
          </div>

          <div class="form-group">
            <label class="form-label">
              <span>Kata Sandi</span>
              <a href="forgot-password.php">Atur Ulang Kata Sandi</a>
            </label>
            <input
              type="password"
              name="password"
              class="form-input"
              placeholder="Kata Sandi"
              autocomplete="current-password"
              required
            />
            <div class="form-error">Kata sandi wajib diisi.</div>
          </div>

          <button type="submit" class="btn-submit">
            <span>Log masuk</span>
          </button>
        </form>

        <p class="auth-footer">
          Tidak punya akun?
          <a href="#" onclick="switchTab('register'); return false;">Daftar sekarang</a>
        </p>
      </div><!-- /panel-login -->

      <!-- ── REGISTER PANEL ── -->
      <div class="auth-panel <?= $activeTab === 'register' ? 'active' : '' ?>" id="panel-register">

        <?php if ($registerError): ?>
          <div class="alert-success" style="background:#fff0f0;border-color:#f5c6cb;color:#c0392b;display:block">
            <?= htmlspecialchars($registerError) ?>
          </div>
        <?php endif; ?>

        <form method="POST" novalidate id="form-register">
          <input type="hidden" name="action" value="register" />

          <div class="form-group">
            <label class="form-label"><span>Nama Lengkap</span></label>
            <input
              type="text"
              name="name"
              class="form-input"
              placeholder="Nama Lengkap"
              value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
              autocomplete="name"
              required
            />
            <div class="form-error">Nama wajib diisi.</div>
          </div>

          <div class="form-group">
            <label class="form-label"><span>Email</span></label>
            <input
              type="email"
              name="reg_email"
              class="form-input"
              placeholder="Email"
              value="<?= htmlspecialchars($_POST['reg_email'] ?? '') ?>"
              autocomplete="email"
              required
            />
            <div class="form-error">Masukkan alamat email yang valid.</div>
          </div>

          <div class="form-group">
            <label class="form-label"><span>Kata Sandi</span></label>
            <input
              type="password"
              name="reg_password"
              class="form-input"
              placeholder="Minimal 8 karakter"
              autocomplete="new-password"
              required
            />
            <div class="form-error">Kata sandi minimal 8 karakter.</div>
          </div>

          <div class="form-group">
            <label class="form-label"><span>Konfirmasi Kata Sandi</span></label>
            <input
              type="password"
              name="reg_confirm"
              class="form-input"
              placeholder="Ulangi kata sandi"
              autocomplete="new-password"
              required
            />
            <div class="form-error">Konfirmasi kata sandi tidak cocok.</div>
          </div>

          <button type="submit" class="btn-submit">
            <span>Buat Akun</span>
          </button>
        </form>

        <p class="auth-footer">
          Sudah punya akun?
          <a href="#" onclick="switchTab('login'); return false;">Log masuk</a>
        </p>
      </div><!-- /panel-register -->

    </div><!-- /auth-card -->
  </main>

  <script>
    function switchTab(tab) {
      document.querySelectorAll('.auth-tab').forEach(t => t.classList.remove('active'));
      document.querySelectorAll('.auth-panel').forEach(p => p.classList.remove('active'));
      document.getElementById('tab-'   + tab).classList.add('active');
      document.getElementById('panel-' + tab).classList.add('active');
    }

    // Client-side validation (progressive enhancement)
    document.querySelectorAll('.form-input[required]').forEach(input => {
      input.addEventListener('blur', () => {
        if (!input.value.trim()) {
          input.classList.add('error');
        } else {
          input.classList.remove('error');
        }
      });
      input.addEventListener('input', () => {
        if (input.value.trim()) input.classList.remove('error');
      });
    });
  </script>
</body>
</html>
