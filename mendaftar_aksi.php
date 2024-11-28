<?php
include 'koneksi.php';

if (isset($_POST['btnDAFTAR'])) {
    // First check if the pelamar exists
    $check_pelamar = "SELECT id_pelamar FROM pelamars WHERE id_pelamar = '" . mysqli_real_escape_string($koneksi, $_POST['txtidpelamar']) . "'";
    $pelamar_result = mysqli_query($koneksi, $check_pelamar);
// Check if the user has already applied for the job
if(isset($_POST['btnDAFTAR'])) {
    // Get the user ID and job ID from the form
    $id_pelamar = $_POST['txtidpelamar'];
    $id_lowongan = $_POST['txtidlowongan'];

    // Check if the user has already applied for this job
    $sql_check = "SELECT * FROM pelamars WHERE id_user = '$id_pelamar' AND id_lowongan = '$id_lowongan'";
    $query_check = mysqli_query($koneksi, $sql_check);
    
    if(mysqli_num_rows($query_check) > 0) {
        // If the user has already applied, show a message
        echo "<script>alert('You have already applied for this job.'); window.location = 'lowongan_detail.php?kode=".$id_lowongan."';</script>";
    } else {
        // If the user hasn't applied yet, proceed with the registration
        // Process the form data (e.g., insert into the database)
        $cv = $_FILES['cv']['name'];
        $surat = $_FILES['surat']['name'];
        $skck = $_FILES['skck']['name'];

        // Your existing code to handle file uploads and insert data
        // Example:
        // move_uploaded_file($_FILES['cv']['tmp_name'], "uploads/" . $cv);
        // Insert registration into pelamars table, etc.

        echo "<script>alert('You have successfully registered for this job.'); window.location = 'lowongan.php';</script>";
    }
}
    if (mysqli_num_rows($pelamar_result) == 0) {
        echo "<script>alert('Data diri tidak ditemukan. Silakan lengkapi profil Anda terlebih dahulu.')</script>";
        echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
        exit;
    }

    // Then check if application already exists
    $sql_cek = "SELECT * FROM lamarans WHERE id_pelamar = '" . mysqli_real_escape_string($koneksi, $_POST['txtidpelamar']) . "' AND id_lowongan = '" . mysqli_real_escape_string($koneksi, $_POST['txtidlowongan']) . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);

    if (mysqli_num_rows($query_cek) > 0) {
        echo "<script>alert('Anda sudah mendaftar lowongan ini!')</script>";
        echo "<meta http-equiv='refresh' content='0; url=lamaran.php'>";
        exit;
    }

    // Process file uploads
    $cv = $_FILES['cv']['name'];
    $surat = $_FILES['surat']['name'];
    $skck = $_FILES['skck']['name'];

    $lokasi1 = $_FILES['cv']['tmp_name'];
    $lokasi2 = $_FILES['surat']['tmp_name'];
    $lokasi3 = $_FILES['skck']['tmp_name'];

    // Validate file types (only allow PDF files)
    $allowed_extensions = ['pdf'];  // Allowed file extensions
    $cv_extension = strtolower(pathinfo($cv, PATHINFO_EXTENSION));
    $surat_extension = strtolower(pathinfo($surat, PATHINFO_EXTENSION));
    $skck_extension = strtolower(pathinfo($skck, PATHINFO_EXTENSION));

    // Check if the files are PDFs
    if (!in_array($cv_extension, $allowed_extensions) || !in_array($surat_extension, $allowed_extensions) || !in_array($skck_extension, $allowed_extensions)) {
        echo "<script>alert('Hanya file PDF yang diperbolehkan untuk CV, Surat Lamaran, dan SKCK.')</script>";
        echo "<meta http-equiv='refresh' content='0; url=lowongan.php'>";
        exit;
    }

    // Directory to save the uploaded files
    $upload_dir = "Berkas/";

    // Set a flag for upload success
    $upload_success = true;

    // Move uploaded files to the specified directory
    if (!move_uploaded_file($lokasi1, $upload_dir . $cv)) $upload_success = false;
    if (!move_uploaded_file($lokasi2, $upload_dir . $surat)) $upload_success = false;
    if (!move_uploaded_file($lokasi3, $upload_dir . $skck)) $upload_success = false;

    // Check if all files were uploaded successfully
    if (!$upload_success) {
        echo "<script>alert('Gagal mengupload berkas!')</script>";
        echo "<meta http-equiv='refresh' content='0; url=lowongan.php'>";
        exit;
    }

    // Prepare the SQL for insertion with sanitized data
    $sql_simpan = "INSERT INTO lamarans (id_pelamar, id_lowongan, tgl_lamaran, CV, surat_lamaran, SKCK, keputusan) VALUES (
        '" . mysqli_real_escape_string($koneksi, $_POST['txtidpelamar']) . "',
        '" . mysqli_real_escape_string($koneksi, $_POST['txtidlowongan']) . "',
        '" . mysqli_real_escape_string($koneksi, $_POST['txttgllamar']) . "',
        '" . mysqli_real_escape_string($koneksi, $cv) . "',
        '" . mysqli_real_escape_string($koneksi, $surat) . "',
        '" . mysqli_real_escape_string($koneksi, $skck) . "',
        '0')"; // Default decision is '0'

    // Execute the insert query
    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    if ($query_simpan) {
        echo "<script>alert('Simpan Berhasil')</script>";
        echo "<meta http-equiv='refresh' content='0; url=lamaran.php'>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "')</script>";
        echo "<meta http-equiv='refresh' content='0; url=lowongan.php'>";
    }
}
?>
