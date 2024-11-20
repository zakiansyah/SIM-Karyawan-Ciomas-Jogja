<?php
    include 'koneksi.php';
    
    if (isset($_POST['btnDAFTAR'])) {
        // First check if the pelamar exists
        $check_pelamar = "SELECT id_pelamar FROM pelamars WHERE id_pelamar = '".$_POST['txtidpelamar']."'";
        $pelamar_result = mysqli_query($koneksi, $check_pelamar);
        
        if (mysqli_num_rows($pelamar_result) == 0) {
            echo "<script>alert('Data diri tidak ditemukan. Silakan lengkapi profil Anda terlebih dahulu.')</script>";
            echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
            exit;
        }

        // Then check if application already exists
        $sql_cek = "SELECT * FROM lamarans WHERE id_pelamar = '".$_POST['txtidpelamar']."' AND id_lowongan = '".$_POST['txtidlowongan']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        
        if (mysqli_num_rows($query_cek) > 0) {
            echo "<script>alert('Anda sudah mendaftar lowongan ini!')</script>";
            echo "<meta http-equiv='refresh' content='0; url=lamaran.php'>";
        } else {
            // Process file uploads
            $cv = mysqli_real_escape_string($koneksi, $_FILES['cv']['name']);
            $surat = mysqli_real_escape_string($koneksi, $_FILES['surat']['name']);
            $skck = mysqli_real_escape_string($koneksi, $_FILES['skck']['name']);
            
            $lokasi1 = $_FILES['cv']['tmp_name'];
            $lokasi2 = $_FILES['surat']['tmp_name'];
            $lokasi3 = $_FILES['skck']['tmp_name'];
            
            $keputusan = '0';

            // Prepare the SQL with escaped values
            $sql_simpan = "INSERT INTO lamarans (id_pelamar, id_lowongan, tgl_lamaran, CV, surat_lamaran, SKCK, keputusan) VALUES (
                '".mysqli_real_escape_string($koneksi, $_POST['txtidpelamar'])."',
                '".mysqli_real_escape_string($koneksi, $_POST['txtidlowongan'])."',
                '".mysqli_real_escape_string($koneksi, $_POST['txttgllamar'])."',
                '".$cv."',
                '".$surat."',
                '".$skck."',
                '".$keputusan."')";

            // Try to move uploaded files
            $upload_success = true;
            if (!move_uploaded_file($lokasi1, "Berkas/".$cv)) $upload_success = false;
            if (!move_uploaded_file($lokasi2, "Berkas/".$surat)) $upload_success = false;
            if (!move_uploaded_file($lokasi3, "Berkas/".$skck)) $upload_success = false;

            if (!$upload_success) {
                echo "<script>alert('Gagal mengupload berkas!')</script>";
                echo "<meta http-equiv='refresh' content='0; url=lowongan.php'>";
                exit;
            }

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
    }
?>