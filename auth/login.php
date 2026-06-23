<?php
session_start();

// ── FUNGSI MANAJEMEN USER DENGAN JSON ──
function getUsersFile() {
    return __DIR__ . '/users.json';
}

function loadUsers() {
    $file = getUsersFile();
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $users = json_decode($content, true);
        return is_array($users) ? $users : [];
    }
    return [];
}

function saveUsers($users) {
    $file = getUsersFile();
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

// ── INISIALISASI USER DEFAULT ──
$users = loadUsers();

// Tambahkan akun default jika file kosong
if (empty($users)) {
    $users = [
        'admin@anns.id' => [
            'name' => 'Administrator',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'role' => 'admin'
        ]
    ];
    saveUsers($users);
}

$loginError    = '';
$registerError = '';
$registerOk    = false;
$activeTab     = 'login';

// Cek parameter URL untuk pesan sukses
if (isset($_GET['registered']) && $_GET['registered'] === 'success') {
    $registerOk = true;
    $activeTab = 'login';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ── LOGIN ──
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $activeTab = 'login';
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']) ? true : false;

        if (empty($email) || empty($password)) {
            $loginError = 'Email dan kata sandi wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $loginError = 'Format email tidak valid.';
        } else {
            $users = loadUsers();
            
            if (isset($users[$email])) {
                if (password_verify($password, $users[$email]['password'])) {
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $users[$email]['name'];
                    $_SESSION['user_role'] = $users[$email]['role'] ?? 'user';
                    
                    if ($remember) {
                        setcookie('user_email', $email, time() + (86400 * 30), '/');
                        setcookie('user_name', $users[$email]['name'], time() + (86400 * 30), '/');
                    }
                    
                    $redirect = $_POST['redirect'] ?? '../index.php';
                    header('Location: ' . $redirect);
                    exit;
                } else {
                    $loginError = 'Email atau kata sandi salah.';
                }
            } else {
                $loginError = 'Email tidak terdaftar. Silakan daftar terlebih dahulu.';
            }
        }
    }

    // ── REGISTER ──
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $activeTab = 'register';
        $name      = trim($_POST['name'] ?? '');
        $email     = trim($_POST['reg_email'] ?? '');
        $password  = $_POST['reg_password'] ?? '';
        $confirm   = $_POST['reg_confirm'] ?? '';

        $users = loadUsers();

        if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
            $registerError = 'Semua kolom wajib diisi.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $registerError = 'Format email tidak valid.';
        } elseif (strlen($password) < 8) {
            $registerError = 'Kata sandi minimal 8 karakter.';
        } elseif ($password !== $confirm) {
            $registerError = 'Konfirmasi kata sandi tidak cocok.';
        } elseif (isset($users[$email])) {
            $registerError = 'Email sudah terdaftar. Silakan login.';
        } else {
            // Simpan user baru
            $users[$email] = [
                'name' => $name,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'role' => 'user'
            ];
            
            saveUsers($users);
            
            // Redirect ke login dengan parameter sukses
            header('Location: login.php?registered=success');
            exit;
        }
    }
}

// Auto-login dari cookie
if (!isset($_SESSION['user_logged_in']) && isset($_COOKIE['user_email'])) {
    $users = loadUsers();
    $email = $_COOKIE['user_email'];
    if (isset($users[$email])) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $users[$email]['name'];
        $_SESSION['user_role'] = $users[$email]['role'] ?? 'user';
        header('Location: ../index.php');
        exit;
    }
}

// Cek login status
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ann's — Masuk / Daftar</title>
  <link rel="stylesheet" href="../assets/styles/main.css" />
  <link rel="stylesheet" href="login.css" />
</head>
<body>

  <!-- ── NAVBAR ── -->
  <?php
  include '../components/navbar/navbar.php';
  ?>

  <!-- ── AUTH CARD ── -->
  <main class="auth-wrapper">
    <div class="auth-card">

      <!-- Tabs -->
      <div class="auth-tabs">
        <button class="auth-tab <?= $activeTab === 'login' ? 'active' : '' ?>"
                onclick="switchTab('login')" id="tab-login">Log Masuk</button>
        <button class="auth-tab <?= $activeTab === 'register' ? 'active' : '' ?>"
                onclick="switchTab('register')" id="tab-register">Daftar</button>
      </div>

      <!-- ── LOGIN PANEL ── -->
      <div class="auth-panel <?= $activeTab === 'login' ? 'active' : '' ?>" id="panel-login">

        <?php if ($registerOk): ?>
          <div class="alert-success show">
            ✅ Akun berhasil dibuat! Silakan log masuk.
          </div>
        <?php endif; ?>

        <?php if ($loginError): ?>
          <div class="alert-success" style="background:#fff0f0;border-color:#f5c6cb;color:#c0392b;display:block">
            <?= htmlspecialchars($loginError) ?>
          </div>
        <?php endif; ?>

        <form method="POST" novalidate id="form-login">
          <input type="hidden" name="action" value="login" />
          <input type="hidden" name="redirect" value="<?= htmlspecialchars($_GET['redirect'] ?? '../index.php') ?>" />

          <div class="form-group">
            <label class="form-label">
              <span>Email</span>
            </label>
            <input
              type="email"
              name="email"
              class="form-input <?= ($loginError && empty($_POST['email'])) ? 'error' : '' ?>"
              placeholder="Email"
              value="<?= htmlspecialchars($_POST['email'] ?? $_COOKIE['user_email'] ?? '') ?>"
              autocomplete="email"
              required
            />
            <div class="form-error">Masukkan alamat email yang valid.</div>
          </div>

          <div class="form-group">
            <label class="form-label">
              <span>Kata Sandi</span>
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

          <div style="margin-bottom:16px; font-size:0.8rem; color:#999;">
            Dengan mendaftar, Anda menyetujui <a href="#" style="color:#b5832a;">Syarat & Ketentuan</a> kami.
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
      document.getElementById('tab-' + tab).classList.add('active');
      document.getElementById('panel-' + tab).classList.add('active');
    }

    // Client-side validation
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

    // Konfirmasi password di register
    const regPassword = document.querySelector('input[name="reg_password"]');
    const regConfirm = document.querySelector('input[name="reg_confirm"]');
    
    if (regConfirm) {
      regConfirm.addEventListener('input', () => {
        if (regPassword.value !== regConfirm.value) {
          regConfirm.classList.add('error');
        } else {
          regConfirm.classList.remove('error');
        }
      });
    }

    // Cek parameter URL untuk menampilkan tab yang sesuai
    window.onload = function() {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.get('registered') === 'success') {
        switchTab('login');
      }
    }
  </script>
</body>
</html>