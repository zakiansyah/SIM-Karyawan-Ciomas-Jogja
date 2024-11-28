<?php
// mengaktifkan session php
session_start();

// jika logout dikonfirmasi
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // menghapus semua session
    session_destroy();

    // mengalihkan halaman ke halaman login
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Logout</title>
</head>
<body>
    <script>
        if (confirm("Apakah Anda yakin ingin logout?")) {
            window.location.href = "?confirm=yes";
        } else {
            window.location.href = "index.php"; // halaman sebelumnya
        }
    </script>
</body>
</html>
