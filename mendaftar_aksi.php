<?php
    include 'koneksi.php';
    
    if (isset($_POST['btnDAFTAR'])) {
        // First check if the pelamar exists
        $check_pelamar = "SELECT id_pelamar FROM pelamars WHERE id_pelamar = '".mysqli_real_escape_string($koneksi, $_POST['txtidpelamar'])."'";
        $pelamar_result = mysqli_query($koneksi, $check_pelamar);
        
        if (mysqli_num_rows($pelamar_result) == 0) {
            echo "<script>alert('Data diri tidak ditemukan. Silakan lengkapi profil Anda terlebih dahulu.')</script>";
            echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
            exit;
        }

        // Then check if application already exists
        $sql_cek = "SELECT * FROM lamarans WHERE id_pelamar = '".mysqli_real_escape_string($koneksi, $_POST['txtidpelamar'])."' 
                    AND id_lowongan = '".mysqli_real_escape_string($koneksi, $_POST['txtidlowongan'])."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        
        if (mysqli_num_rows($query_cek) > 0) {
            echo "<script>alert('Anda sudah mendaftar lowongan ini!')</script>";
            echo "<meta http-equiv='refresh' content='0; url=lamaran.php'>";
        } else {
            $keputusan = '0';

            // Prepare the SQL without file uploads
            $sql_simpan = "INSERT INTO lamarans (id_pelamar, id_lowongan, tgl_lamaran, keputusan) VALUES (
                '".mysqli_real_escape_string($koneksi, $_POST['txtidpelamar'])."',
                '".mysqli_real_escape_string($koneksi, $_POST['txtidlowongan'])."',
                '".mysqli_real_escape_string($koneksi, $_POST['txttgllamar'])."',
                '".$keputusan."')";

            // Execute the insert query
            $query_simpan = mysqli_query($koneksi, $sql_simpan);

            if ($query_simpan) {
                echo "<script>alert('Simpan Berhasil')</script>";
                echo "<meta http-equiv='refresh' content='0; url=https://forms.gle/Mfcnzqnnib8r6eNo9'>";
            } else {
                echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "')</script>";
                echo "<meta http-equiv='refresh' content='0; url=lowongan.php'>";
            }
        }
    }
?>