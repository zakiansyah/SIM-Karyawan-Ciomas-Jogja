<?php
include 'koneksi.php';

// Fungsi untuk mengamankan input
function amankan_input($koneksi, $nilai) {
    return mysqli_real_escape_string($koneksi, trim($nilai));
}

// PROSES SIMPAN DATA BARU / UBAH DATA / HAPUS DATA
if (isset($_POST['btnSimpan']) || isset($_POST['btnUbah']) || isset($_GET['kode'])) {
    // PROSES SIMPAN DATA BARU
    if (isset($_POST['btnSimpan'])) {
        // Proses upload foto
        $foto = null;
        if (isset($_FILES['txtfile']) && $_FILES['txtfile']['error'] == 0) {
            // Mendapatkan nama file dan path tujuan untuk menyimpan gambar
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['txtfile']['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validasi format file (hanya gambar)
            if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Cek apakah file sudah ada
                if (!file_exists($target_file)) {
                    // Cek ukuran file (maksimal 5MB)
                    if ($_FILES['txtfile']['size'] <= 5 * 1024 * 1024) {
                        // Upload file ke server
                        if (move_uploaded_file($_FILES['txtfile']['tmp_name'], $target_file)) {
                            // Simpan path foto ke dalam database
                            $foto = $target_file;
                        } else {
                            echo "<script>alert('Gagal mengupload gambar!');</script>";
                        }
                    } else {
                        echo "<script>alert('Ukuran file terlalu besar. Maksimal 5MB.');</script>";
                    }
                } else {
                    echo "<script>alert('File sudah ada!');</script>";
                }
            } else {
                echo "<script>alert('Format file tidak didukung. Hanya JPG, JPEG, PNG, dan GIF yang diterima.');</script>";
            }
        }

        // Query untuk menyimpan data baru
        $sql_simpan = "INSERT INTO pelamars (
            id_user, tempat_lhr, tanggal_lhr, provinsi, kabupaten, kecamatan,
            desa, alamat, kelamin, agama, status, no_hp, foto
        ) VALUES (
            '" . amankan_input($koneksi, $_POST['txtiduser']) . "',
            '" . amankan_input($koneksi, $_POST['txttempat']) . "',
            '" . amankan_input($koneksi, $_POST['txttanggal']) . "',
            '" . amankan_input($koneksi, $_POST['nama_provinsi']) . "',
            '" . amankan_input($koneksi, $_POST['nama_kabupaten']) . "',
            '" . amankan_input($koneksi, $_POST['nama_kecamatan']) . "',
            '" . amankan_input($koneksi, $_POST['nama_desa']) . "',
            '" . amankan_input($koneksi, $_POST['txtalamat']) . "',
            '" . amankan_input($koneksi, $_POST['txtkelamin']) . "',
            '" . amankan_input($koneksi, $_POST['txtagama']) . "',
            '" . amankan_input($koneksi, $_POST['txtstatus']) . "',
            '" . amankan_input($koneksi, $_POST['txthp']) . "',
            '$foto'
        )";

        if (mysqli_query($koneksi, $sql_simpan)) {
            echo "<script>alert('Data berhasil disimpan!');</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');</script>";
        }
        echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
    }

    // PROSES UBAH DATA
    else if (isset($_POST['btnUbah'])) {
        $field_diubah = array();
        $daftar_field = array(
            'tempat_lhr' => 'txttempat', 'tanggal_lhr' => 'txttanggal',
            'provinsi' => 'nama_provinsi', 'kabupaten' => 'nama_kabupaten',
            'kecamatan' => 'nama_kecamatan', 'desa' => 'nama_desa',
            'alamat' => 'txtalamat', 'kelamin' => 'txtkelamin',
            'agama' => 'txtagama', 'status' => 'txtstatus', 'no_hp' => 'txthp'
        );

        foreach ($daftar_field as $nama_db => $nama_form) {
            if (isset($_POST[$nama_form]) && !empty($_POST[$nama_form])) {
                $field_diubah[] = $nama_db . "='" . amankan_input($koneksi, $_POST[$nama_form]) . "'"; 
            }
        }

        if (isset($_FILES['txtfile']) && $_FILES['txtfile']['error'] == 0) {
            // Mendapatkan nama file dan path tujuan untuk menyimpan gambar
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['txtfile']['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validasi format file
            if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                // Cek apakah file sudah ada
                if (!file_exists($target_file)) {
                    // Cek ukuran file (maksimal 5MB)
                    if ($_FILES['txtfile']['size'] <= 5 * 1024 * 1024) {
                        // Upload file ke server
                        if (move_uploaded_file($_FILES['txtfile']['tmp_name'], $target_file)) {
                            $foto = $target_file;
                            $field_diubah[] = "foto='$foto'";
                        } else {
                            echo "<script>alert('Gagal mengupload gambar!');</script>";
                        }
                    } else {
                        echo "<script>alert('Ukuran file terlalu besar. Maksimal 5MB.');</script>";
                    }
                } else {
                    echo "<script>alert('File sudah ada!');</script>";
                }
            } else {
                echo "<script>alert('Format file tidak didukung. Hanya JPG, JPEG, PNG, dan GIF yang diterima.');</script>";
            }
        }

        if (!empty($field_diubah)) {
            $sql_ubah = "UPDATE pelamars SET " . implode(', ', $field_diubah) . 
                        " WHERE id_pelamar='" . amankan_input($koneksi, $_POST['txtid']) . "'";

            if (mysqli_query($koneksi, $sql_ubah)) {
                echo "<script>alert('Data berhasil diperbarui!');</script>";
            } else {
                echo "<script>alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');</script>";
            }
        } else {
            echo "<script>alert('Tidak ada data yang diubah!');</script>";
        }
        echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
    }

    // PROSES HAPUS DATA
    else if (isset($_GET['kode'])) {
        $sql_hapus = "DELETE FROM pelamars WHERE id_pelamar='" . amankan_input($koneksi, $_GET['kode']) . "'";

        if (mysqli_query($koneksi, $sql_hapus)) {
            echo "<script>alert('Data berhasil dihapus!');</script>";
        } else {
            echo "<script>alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');</script>";
        }
        echo "<meta http-equiv='refresh' content='0; url=profil_aksi.php'>";
    }
}

// MENAMPILKAN GAMBAR DARI DATABASE
if (isset($_GET['tampilkanFoto'])) {
    $id_pelamar = amankan_input($koneksi, $_GET['id']);
    $sql_tampilkan = "SELECT foto FROM pelamars WHERE id_pelamar='$id_pelamar'";
    $result = mysqli_query($koneksi, $sql_tampilkan);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        // Gambar diambil dari folder 'uploads/'
        $foto = $data['foto'];
        echo "<img src='$foto' alt='Foto Pelamar' />";
    } else {
        echo "Gambar tidak ditemukan!";
    }
}
?>
