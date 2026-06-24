<?php
/**
 * config.php
 * Konfigurasi global project
 * SATU-SATUNYA TEMPAT DEFINISI KONSTANTA
 */

// Cek apakah konstanta sudah didefinisikan
if (!defined('FOLDER_NAME')) {
    define('FOLDER_NAME', 'web-tokokue');
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '/' . FOLDER_NAME . '/');
}

if (!defined('WA_NUMBER')) {
    define('WA_NUMBER', '6282111707125'); // Ganti dengan nomor WA kamu
}
?>