<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';
error_reporting(0);

if (!isset($_SESSION["Pelamar"])) {
  echo "<script>alert('silahkan login');</script>";
  echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <?php
    include 'menu.php';
    ?>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!--  -->
      <!--  -->

      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> Profil </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Profil</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">

              <div class="card card-primary card-outline">

                <div class="card-body">
                  <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-3">

                       <!-- Profile Image -->
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <?php
            // Query untuk mengambil data pengguna berdasarkan session user ID
            $sql_tampil = "
                SELECT users.*, pelamars.*
                FROM users
                JOIN pelamars ON pelamars.id_user = users.id_user
                WHERE users.id_user = '$_SESSION[id_user]'";

            $query_tampil = mysqli_query($koneksi, $sql_tampil);
            $data = mysqli_fetch_array($query_tampil, MYSQLI_BOTH);

            // Cek apakah foto ada di database
            if (!empty($data['foto'])) {
                // Jika foto disimpan sebagai BLOB, konversi ke base64 untuk ditampilkan
                $foto = 'data:image/jpeg;base64,' . base64_encode($data['foto']);
            } else {
                // Gunakan gambar default jika tidak ada foto
                $foto = 'assets/default-profile-picture.jpg'; // Sesuaikan path ke gambar default Anda
            }
            ?>
            <!-- Tampilkan gambar -->
            <img class="profile-user-img img-fluid img-circle" 
                src="<?php echo $foto; ?>" 
                alt="User profile picture">
        </div>

        <!-- Tampilkan Nama dan Informasi Lainnya -->
        <h3 class="profile-username text-center"><?php echo $data['nama']; ?></h3>
        <p class="text-muted text-center"><?php echo $data['pekerjaan'] ?? 'Pelamar'; ?></p>

        <!-- Informasi Tambahan -->
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Email</b> <a class="float-right"><?php echo $data['email']; ?></a>
            </li>
            <li class="list-group-item">
                <b>No HP</b> <a class="float-right"><?php echo $data['no_hp']; ?></a>
            </li>
            <li class="list-group-item">
                <b>Alamat</b> <a class="float-right"><?php echo $data['alamat']; ?></a>
            </li>
            <li class="list-group-item">
                <b>Jenis Kelamin</b> <a class="float-right"><?php echo $data['kelamin']; ?></a>
            </li>
            <li class="list-group-item">
                <b>Tanggal Lahir</b> <a class="float-right"><?php echo $data['tanggal_lhr']; ?></a>
            </li>
        </ul>

        <!-- Tombol Edit Profil -->
        <a href="edit_profil.php" class="btn btn-primary btn-block"><b>Edit Profil</b></a>
    </div>
    <!-- /.card-body -->
</div>

                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                          <?php
                          $sql_cek = "SELECT * FROM pelamars WHERE id_user='$_SESSION[id_user]'";
                          $query_cek = mysqli_query($koneksi, $sql_cek);
                          if (mysqli_num_rows($query_cek) > 0) : ?>
                            <div class="card">
                              <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                  <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Profil</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#ubahp" data-toggle="tab">Ubah Profil</a></li>
                                </ul>
                              </div><!-- /.card-header -->
                              <div class="card-body">
                                <div class="tab-content">
                                  <div class="active tab-pane" id="profil">
                                    <?php
                                    $sql_tampil_profil = "SELECT users.*, pelamars.*
                      FROM users
                      JOIN pelamars ON pelamars.id_user = users.id_user
                      WHERE users.id_user = '$_SESSION[id_user]'";
                                    $query_tampil_profil = mysqli_query($koneksi, $sql_tampil_profil);
                                    $data_profil = mysqli_fetch_array($query_tampil_profil, MYSQLI_BOTH);

                                    // Tambahkan pengecekan apakah data ditemukan
                                    if (!$data_profil) {
                                      echo "Data profil tidak ditemukan.";
                                      exit;
                                    }
                                    ?>
                                    <table>
                                      <tr>
                                        <td width="200px">Tempat Tanggal Lahir</td>
                                        <td width="20px">:</td>
                                        <td><?php echo $data_profil['tempat_lhr'] ?>, <?php echo $data_profil['tanggal_lhr'] ?></td>
                                      </tr>
                                      <tr>
                                        <td width="200px">Alamat</td>
                                        <td width="20px">:</td>
                                        <td><?php echo $data_profil['alamat'] ?>, <?php echo $data_profil['desa'] ?>, <?php echo $data_profil['kecamatan'] ?>, <?php echo $data_profil['kabupaten'] ?></td>
                                      </tr>
                                      <tr>
                                        <td width="200px">Kelamin</td>
                                        <td width="20px">:</td>
                                        <td><?php echo $data_profil['kelamin'] ?></td>
                                      </tr>
                                      <tr>
                                        <td width="200px">Agama</td>
                                        <td width="20px">:</td>
                                        <td><?php echo $data_profil['agama'] ?></td>
                                      </tr>
                                      <tr>
                                        <td width="200px">Status</td>
                                        <td width="20px">:</td>
                                        <td><?php echo $data_profil['status'] ?></td>
                                      </tr>
                                      <tr>
                                        <td width="200px">No HP</td>
                                        <td width="20px">:</td>
                                        <td><?php echo $data_profil['no_hp'] ?></td>
                                      </tr>
                                    </table>
                                    <!-- /.card-body -->
                                    </form>
                                    <!-- /.post -->
                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="ubahp">
                                    <form action="profil_aksi.php" method="POST">
                                      <!-- The timeline -->
                                      <!-- Post -->
                                      <?php
                                      $sql_tampil_profil = "SELECT users.*, pelamars.*
                                      FROM users
                                      JOIN pelamars
                                      ON pelamars.id_user=users.id_user
                                      JOIN lamarans
                                      WHERE users.id_user='$_SESSION[id_user]'";
                                      $query_tampil_profil = mysqli_query($koneksi, $sql_tampil_profil);
                                      $data_profil = mysqli_fetch_array($query_tampil_profil, MYSQLI_BOTH);
                                      ?>

                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="exampleInputEmail1">Tempat Lahir</label>
                                            <input type="text" name="txttempat" class="form-control" id="exampleInputEmail1" value="<?php echo $data_profil['tempat_lhr'] ?>">
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="exampleInputPassword1">Tanggal Lahir</label>
                                            <input type="date" name="txttanggal" class="form-control" id="exampleInputPassword1" value="<?php echo $data_profil['tanggal_lhr'] ?>">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-3">
                                          <div class="form-group">
                                            <label for="exampleInputPassword1">Provinsi</label>
                                            <select class="custom-select form-control" name="nama_provinsi" required>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Kabupaten/Kota</label>
                                          <select class="custom-select form-control" name="nama_kabupaten" required>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Kecamatan</label>
                                          <select class="custom-select form-control" name="nama_kecamatan" required>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Desa</label>
                                          <select class="custom-select form-control" name="nama_desa" required>
                                          </select>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Alamat</label>
                                    <textarea class="form-control" name="txtalamat" placeholder="Masukkan Alamat (Jalan, nomor rumah, keterangan)"><?php echo $data_profil['alamat'] ?></textarea>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleSelectBorder">Kelamin</label>
                                        <select class="custom-select form-control" name="txtkelamin" id="exampleSelectBorder">
                                          <option <?php if ($data_profil['kelamin'] == 'Pria') {
                                                    echo "selected";
                                                  } ?> value='Pria'>Pria</option>
                                          <option <?php if ($data_profil['kelamin'] == 'Wanita') {
                                                    echo "selected";
                                                  } ?> value='Wanita'>Wanita</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleSelectBorder">Agama</label>
                                        <select class="custom-select form-control" name="txtagama" id="exampleSelectBorder">
                                          <option <?php if ($data_profil['agama'] == 'Islam') {
                                                    echo "selected";
                                                  } ?> value='Islam'>Islam</option>
                                          <option <?php if ($data_profil['agama'] == 'Kristen') {
                                                    echo "selected";
                                                  } ?> value='Kristen'>Kristen</option>
                                          <option <?php if ($data_profil['agama'] == 'Katolik') {
                                                    echo "selected";
                                                  } ?> value='Katolik'>Katolik</option>
                                          <option <?php if ($data_profil['agama'] == 'Hindu') {
                                                    echo "selected";
                                                  } ?> value='Hindu'>Hindu</option>
                                          <option <?php if ($data_profil['agama'] == 'Budha') {
                                                    echo "selected";
                                                  } ?> value='Budha'>Budha</option>
                                          <option <?php if ($data_profil['agama'] == 'Konghuchu') {
                                                    echo "selected";
                                                  } ?> value='Konghuchu'>Konghuchu</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleSelectBorder">Status</label>
                                        <select class="custom-select form-control" name="txtstatus" id="exampleSelectBorder">
                                          <option <?php if ($data_profil['status'] == 'Belum Kawin') {
                                                    echo "selected";
                                                  } ?> value='Belum Kawin'>Belum Kawin</option>
                                          <option <?php if ($data_profil['status'] == 'Kawin') {
                                                    echo "selected";
                                                  } ?> value='Kawin'>Kawin</option>
                                          <option <?php if ($data_profil['status'] == 'Cerai Hidup') {
                                                    echo "selected";
                                                  } ?> value='Cerai Hidup'>Cerai Hidup</option>
                                          <option <?php if ($data_profil['status'] == 'Cerai Mati') {
                                                    echo "selected";
                                                  } ?> value='Cerai Mati'>Cerai Mati</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Nomor HP</label>
                                        <input type="tel" class="form-control" name="txthp" id="exampleInputPassword1" value="<?php echo $data_profil['no_hp'] ?>">
                                      </div>
                                    </div>
                                  </div>
                                  <input type="hidden" name="txtid" value="<?php echo $data_profil['id_pelamar']; ?>">
                                  <button type="submit" name="btnUbah" class="btn btn-warning">Ubah</button>
                                  <!-- /.card-body -->
                                  </form>
                                  <!-- /.post -->
                                </div>
                              </div>
                              <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                      <?php else : ?>
                        <div class="card">
                          <div class="card-header p-2">
                            <ul class="nav nav-pills">
                              <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Buat Profil</a></li>
                            </ul>
                          </div><!-- /.card-header -->
                          <form action="profil_aksi.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                              <input type="hidden" name="txtiduser" value="<?php echo $_SESSION['id_user']; ?>">

                              <!-- Tempat dan Tanggal Lahir -->
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="tempatLahir">Tempat Lahir</label>
                                    <input type="text" name="txttempat" class="form-control" id="tempatLahir" placeholder="Masukkan Tempat Lahir" required>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="tanggalLahir">Tanggal Lahir</label>
                                    <input type="date" name="txttanggal" class="form-control" id="tanggalLahir" required>
                                  </div>
                                </div>
                              </div>

                              <!-- Lokasi: Provinsi, Kabupaten, Kecamatan, Desa -->
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="provinsi">Provinsi</label>
                                    <select class="custom-select form-control" name="nama_provinsi" id="provinsi" required>
                                      <option value="" selected disabled>Pilih Provinsi</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <select class="custom-select form-control" name="nama_kabupaten" id="kabupaten" required>
                                      <option value="" selected disabled>Pilih Kabupaten/Kota</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="custom-select form-control" name="nama_kecamatan" id="kecamatan" required>
                                      <option value="" selected disabled>Pilih Kecamatan</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="desa">Desa</label>
                                    <select class="custom-select form-control" name="nama_desa" id="desa" required>
                                      <option value="" selected disabled>Pilih Desa</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <!-- Alamat -->
                              <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" name="txtalamat" id="alamat" placeholder="Masukkan Alamat (Jalan, nomor rumah, keterangan)" required></textarea>
                              </div>

                              <!-- Kelamin dan Agama -->
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="kelamin">Kelamin</label>
                                    <select class="custom-select form-control" name="txtkelamin" id="kelamin" required>
                                      <option value="" selected disabled>Pilih Kelamin</option>
                                      <option>Pria</option>
                                      <option>Wanita</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" name="txtagama" id="agama" required>
                                      <option value="" selected disabled>Pilih Agama</option>
                                      <option>Islam</option>
                                      <option>Kristen</option>
                                      <option>Katolik</option>
                                      <option>Hindu</option>
                                      <option>Budha</option>
                                      <option>Konghucu</option>
                                      <option>Yahudi</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <!-- Status dan Nomor HP -->
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="custom-select form-control" name="txtstatus" id="status" required>
                                      <option value="" selected disabled>Pilih Status</option>
                                      <option>Belum Kawin</option>
                                      <option>Kawin</option>
                                      <option>Cerai Hidup</option>
                                      <option>Cerai Mati</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="noHp">Nomor HP</label>
                                    <input type="tel" class="form-control" name="txthp" id="noHp" placeholder="Masukkan Nomor HP" pattern="^\+62\d{9,13}$" required>
                                    <small class="form-text text-muted">Format: +62xxxxxxxxxxx</small>
                                  </div>
                                </div>
                              </div>

                              <!-- Upload Foto -->
                              <div class="form-group">
                                <label for="foto">Unggah Foto</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="txtfile" id="foto" accept="image/*">
                                    <label class="custom-file-label" for="foto">Pilih Foto</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                                <img id="previewFoto" src="#" alt="Pratinjau Foto" class="mt-2" style="max-width: 200px; display: none;">
                              </div>

                              <!-- Tombol Submit -->
                              <button type="submit" name="btnSimpan" class="btn btn-primary">Submit</button>
                            </div>
                          </form>

                          <script>
                            // Pratinjau foto
                            document.getElementById('foto').addEventListener('change', function(event) {
                              const [file] = event.target.files;
                              if (file) {
                                const preview = document.getElementById('previewFoto');
                                preview.src = URL.createObjectURL(file);
                                preview.style.display = 'block';
                              }
                            });
                          </script>

                        </div>
                      <?php endif ?>
                      <!-- /.card -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                </section>
                <!-- /.container-fluid -->
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


    <!--  -->
    <!--  -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script>
    $(function() {
      $('.select2').select2()
    })
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  </script>
  <script>
    $(document).ready(function() {
      // Fetch provinces on page load
      $.ajax({
        type: 'POST',
        url: 'dataprovinsi.php',
        success: function(hasil_provinsi) {
          // Populate the dropdown
          $("select[name=nama_provinsi]").html('<option value="">Pilih Provinsi</option>' + hasil_provinsi);
        },
        error: function(xhr, status, error) {
          console.error("Error fetching provinces: ", error);
          alert("Gagal memuat data provinsi.");
        },
      });


      // When a province is selected, fetch data for districts
      $("select[name=nama_provinsi]").on("change", function() {
        var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");

        if (id_provinsi_terpilih) {
          $.ajax({
            type: 'POST',
            url: 'datakabupaten.php',
            data: {
              id_provinsi: id_provinsi_terpilih
            },
            success: function(hasil_kabupaten) {
              $("select[name=nama_kabupaten]").html(hasil_kabupaten);
            },
            error: function(xhr, status, error) {
              console.error("Error fetching districts: ", error);
              alert("Gagal memuat data kabupaten.");
            },
          });
        } else {
          $("select[name=nama_kabupaten]").html('<option value="">Pilih Kabupaten</option>');
        }
      });

      // When a district is selected, fetch data for sub-districts
      $("select[name=nama_kabupaten]").on("change", function() {
        var id_kabupaten_terpilih = $("option:selected", this).attr("id_kabupaten");

        if (id_kabupaten_terpilih) {
          $.ajax({
            type: 'POST',
            url: 'datakecamatan.php',
            data: {
              id_kabupaten: id_kabupaten_terpilih
            },
            success: function(hasil_kecamatan) {
              $("select[name=nama_kecamatan]").html(hasil_kecamatan);
            },
            error: function(xhr, status, error) {
              console.error("Error fetching sub-districts: ", error);
              alert("Gagal memuat data kecamatan.");
            },
          });
        } else {
          $("select[name=nama_kecamatan]").html('<option value="">Pilih Kecamatan</option>');
        }
      });

      // When a sub-district is selected, fetch data for villages
      $("select[name=nama_kecamatan]").on("change", function() {
        var id_kecamatan_terpilih = $("option:selected", this).attr("id_kecamatan");

        if (id_kecamatan_terpilih) {
          $.ajax({
            type: 'POST',
            url: 'datadesa.php',
            data: {
              id_kecamatan: id_kecamatan_terpilih
            },
            success: function(hasil_desa) {
              $("select[name=nama_desa]").html(hasil_desa);
            },
            error: function(xhr, status, error) {
              console.error("Error fetching villages: ", error);
              alert("Gagal memuat data desa.");
            },
          });
        } else {
          $("select[name=nama_desa]").html('<option value="">Pilih Desa</option>');
        }
      });
    });
  </script>



</body>

</html>