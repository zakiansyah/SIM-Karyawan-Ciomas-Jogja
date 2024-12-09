<?php
// Mengaktifkan session pada PHP
session_start();

// Menghubungkan PHP dengan koneksi database
include 'koneksi.php';

// Perintah untuk menampilkan data dari tb_buku ke komponen input form dengan acuan kode yang didapat dari halaman buku_tampil
if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM lowongans WHERE id_lowongan='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="https://kompaskerja.com/wp-content/uploads/2019/09/logo-japfa-630x380.jpg">
    <title>PT. Ciomas Adisatwa | Profil</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php include 'menu.php'; ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Lowongan </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Lowongan Detail</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Lowongan Pekerjaan</h5>
                                </div>
                                <div class="card-body">
                                    <form action="mendaftar_aksi.php" method="post">
                                        <?php
                                        $sql_id = "SELECT * FROM pelamars WHERE id_user='" . $_SESSION['id_user'] . "'";
                                        $query_id = mysqli_query($koneksi, $sql_id);
                                        $data_id = mysqli_fetch_array($query_id, MYSQLI_BOTH);
                                        ?>
                                        <input type="hidden" name="txtidpelamar" value="<?php echo $data_id['id_pelamar']; ?>">
                                        <input type="hidden" name="txtidlowongan" value="<?php echo $data_cek['id_lowongan']; ?>">
                                        <input type="hidden" name="txttgllamar" value="<?php echo date('Y-m-d'); ?>">

                                        <div class="form-group row">
                                            <label for="namaLowongan" class="col-sm-2 col-form-label">Nama Lowongan</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="namaLowongan" value="<?php echo $data_cek['nama_lowongan']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="kategori" value="<?php echo $data_cek['kategori']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                            <div class="col-sm-6">
                                                <textarea class="form-control" id="deskripsi" rows="5" readonly><?php echo $data_cek['deskripsi']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tglPost" class="col-sm-2 col-form-label">Tanggal Post</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="tglPost" value="<?php echo date('d F Y', strtotime($data_cek['tgl_post'])); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tglDeadline" class="col-sm-2 col-form-label">Tanggal Deadline</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="tglDeadline" value="<?php echo date('d F Y', strtotime($data_cek['tgl_deadline'])); ?>" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-md-3">
                                                <a href="lowongan.php" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                                                <button type="submit" name="btnDAFTAR" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Daftar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
</body>
</html>