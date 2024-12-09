<?php
include 'koneksi.php';

// Fungsi untuk mengamankan input
function amankan_input($koneksi, $nilai)
{
    return mysqli_real_escape_string($koneksi, trim($nilai));
}

// PROSES SIMPAN DATA BARU
if (isset($_POST['btnSimpan'])) {
    // Proses upload foto
    $foto = '';
    if (isset($_FILES['txtfile']) && $_FILES['txtfile']['error'] == 0) {
        $foto = amankan_input($koneksi, $_FILES['txtfile']['name']);
        $foto_sementara = $_FILES['txtfile']['tmp_name'];

        // Pindahkan foto ke folder uploads/profile
        if (move_uploaded_file($foto_sementara, "uploads/profile/" . $foto)) {
            // Foto berhasil diupload
        } else {
            echo "<script>alert('Gagal mengupload foto!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
            exit;
        }
    }

    // Query untuk menyimpan data baru
    $sql_simpan = "INSERT INTO pelamars (
        id_user,
        nama,
        tempat_lhr,
        tanggal_lhr,
        provinsi,
        kabupaten,
        kecamatan,
        desa,
        alamat,
        kelamin,
        agama,
        status,
        no_hp,
        foto
    ) VALUES (
        '" . amankan_input($koneksi, $_POST['txtiduser']) . "',
        '" . amankan_input($koneksi, $_POST['txtnama']) . "',
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
        '" . $foto . "'
    )";

    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    if ($query_simpan) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
        echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
    } else {
        echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');</script>";
        echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
    }
}

// PROSES UBAH DATA
else if (isset($_POST['btnUbah'])) {
    $field_diubah = array();

    // Daftar field yang bisa diubah
    $daftar_field = array(
        'nama' => 'txtnama',
        'tempat_lhr' => 'txttempat',
        'tanggal_lhr' => 'txttanggal',
        'provinsi' => 'nama_provinsi',
        'kabupaten' => 'nama_kabupaten',
        'kecamatan' => 'nama_kecamatan',
        'desa' => 'nama_desa',
        'alamat' => 'txtalamat',
        'kelamin' => 'txtkelamin',
        'agama' => 'txtagama',
        'status' => 'txtstatus',
        'no_hp' => 'txthp'
    );

    // Proses setiap field yang ada
    foreach ($daftar_field as $nama_db => $nama_form) {
        if (isset($_POST[$nama_form]) && !empty($_POST[$nama_form])) {
            $field_diubah[] = $nama_db . "='" . amankan_input($koneksi, $_POST[$nama_form]) . "'";
        }
    }

    // Proses jika ada foto baru
    if (isset($_FILES['txtfile']) && $_FILES['txtfile']['error'] == 0) {
        $foto = amankan_input($koneksi, $_FILES['txtfile']['name']);
        $foto_sementara = $_FILES['txtfile']['tmp_name'];

        // Upload foto baru
        if (move_uploaded_file($foto_sementara, "uploads/profile/" . $foto)) {
            $field_diubah[] = "foto='" . $foto . "'";

            // Hapus foto lama jika ada
            $sql_foto_lama = "SELECT foto FROM pelamars WHERE id_pelamar = '" . amankan_input($koneksi, $_POST['txtid']) . "'";
            $query_foto_lama = mysqli_query($koneksi, $sql_foto_lama);
            if ($data = mysqli_fetch_assoc($query_foto_lama)) {
                if (!empty($data['foto'])) {
                    @unlink("uploads/profile/" . $data['foto']);
                }
            }
        }
    }

    // Jalankan query update jika ada data yang diubah
    if (!empty($field_diubah)) {
        $sql_ubah = "UPDATE pelamars SET " . implode(', ', $field_diubah) .
            " WHERE id_pelamar='" . amankan_input($koneksi, $_POST['txtid']) . "'";

        $query_ubah = mysqli_query($koneksi, $sql_ubah);

        if ($query_ubah) {
            echo "<script>alert('Data berhasil diperbarui!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
        } else {
            echo "<script>alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');</script>";
            echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
        }
    } else {
        echo "<script>alert('Tidak ada data yang diubah!');</script>";
        echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
    }
}

// PROSES HAPUS DATA
else if (isset($_GET['kode'])) {
    // Ambil informasi foto sebelum menghapus data
    $sql_cek_foto = "SELECT foto FROM pelamars WHERE id_pelamar='" . amankan_input($koneksi, $_GET['kode']) . "'";
    $query_cek_foto = mysqli_query($koneksi, $sql_cek_foto);
    $data_foto = mysqli_fetch_assoc($query_cek_foto);

    // Proses hapus data dari database
    $sql_hapus = "DELETE FROM pelamars WHERE id_pelamar='" . amankan_input($koneksi, $_GET['kode']) . "'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);

    if ($query_hapus) {
        // Hapus file foto jika ada
        if (!empty($data_foto['foto'])) {
            @unlink("uploads/profile/" . $data_foto['foto']);
        }
        echo "<script>alert('Data berhasil dihapus!');</script>";
        echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
    } else {
        echo "<script>alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');</script>";
        echo "<meta http-equiv='refresh' content='0; url=profil.php'>";
    }
}
