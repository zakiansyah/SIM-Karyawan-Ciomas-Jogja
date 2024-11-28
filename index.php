<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';
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
  <title>PT. Ciomas Adisatwa | Home</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
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
  <style>
        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            line-height: 1.6;
            color: #333;
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 5%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1a5f7a;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #1a5f7a;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                        url('/api/placeholder/1920/1080') center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 0 5%;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        /* Sections */
        section {
            padding: 5rem 5%;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #1a5f7a;
        }

        /* About Section */
        .timeline {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .timeline-item {
            background: #f9f9f9;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        /* Products Section */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 1.5rem;
        }

        /* Quality Section */
        .quality-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        /* Testimonials Section */
        .testimonials-slider {
            display: flex;
            overflow-x: hidden;
            scroll-snap-type: x mandatory;
        }

        .testimonial-card {
            min-width: 100%;
            scroll-snap-align: start;
            padding: 2rem;
            background: #f9f9f9;
            border-radius: 10px;
            margin-right: 1rem;
        }

        /* CTA Buttons */
        .cta-button {
            display: inline-block;
            padding: 1rem 2rem;
            background: #1a5f7a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .cta-button:hover {
            background: #134b61;
        }

        /* Footer */
        footer {
            background: #1a5f7a;
            color: white;
            padding: 3rem 5%;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-icons a {
            color: white;
            font-size: 1.5rem;
            transition: opacity 0.3s;
        }

        .social-icons a:hover {
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .quality-content {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>
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

      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> Home </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="./assets/img/tampak depan pt.jpg" alt="First slide">
                      <div class="carousel-caption d-none d-md-block">
                      </div>
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="./assets/img/luar depan.jpg" alt="Second slide">
                      <div class="carousel-caption d-none d-md-block">

                      </div>
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="./assets/img/gambar jalan.jpg" alt="Second slide">
                      <div class="carousel-caption d-none d-md-block">

                      </div>
                    </div>

                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <section id="about">
      <h2 class="section-title" data-aos="fade-up">Siapa Kami?</h2>
      <div class="timeline">
        <div class="timeline-item" data-aos="fade-right">
          <h3>Visi Kami</h3>
          <p>Menjadi Perusahaan Interrated Poultry Processing terbesar di Indonesia, Serta menghasilkan protein hewani yang Halal, Aman, Utuh, Sehat, dan Berkualitas</p>
        </div>
        <div class="timeline-item" data-aos="fade-left">
          <h3>Misi Kami</h3>
          <p>Meningkatkan gizi masyarakat melalui penyediaan protein hewani asal daging ayam yang Halal, Aman, utuh, Sehat, dan Berkualitas</p>
          <p>Memberikan kontribusi laba yang optimal kepada JAPFA Group</p>
          <p>Meningkatkan kesejahteraan karyawan, Mitra Usaha, dan Masyarakat Sekitar</p>
        </div>
      </div>
    </section>

    <section id="products">
      <h2 class="section-title" data-aos="fade-up">Produk Berkualitas Kami</h2>
      <div class="products-grid">
        <div class="product-card" data-aos="fade-up">
          <img src="./assets/img/Ayam Segar.jpg" alt="Ayam Segar" class="product-img">
          <div class="product-info">
            <h3>Ayam Segar</h3>
            <p>Unggas segar dengan proses higienis yang terjamin.</p>
          </div>
        </div>
        <div class="product-card" data-aos="fade-up" data-aos-delay="100">
          <img src="./assets/img/Olahan Ayam.png" alt="Olahan Ayam" class="product-img">
          <div class="product-info">
            <h3>Olahan Ayam</h3>
            <p>Berbagai produk olahan seperti nugget dan sosis.</p>
          </div>
        </div>
        <div class="product-card" data-aos="fade-up" data-aos-delay="200">
          <img src="./assets/img/Pakan Ayam.png" style="width: 400px; height: 200px; object-fit: cover;" alt="Pakan Ternak" class="product-img">
          <div class="product-info">
            <h3>Pakan Ternak</h3>
            <p>Pakan berstandar tinggi untuk hasil terbaik.</p>
          </div>
        </div>
      </div>
    </section>

    <section id="quality">
      <h2 class="section-title" data-aos="fade-up">Kualitas Adalah Prioritas Kami</h2>
      <div class="quality-content">
        <div data-aos="fade-right">
          <h3>Sertifikat</h3>
          <ul>
            <li>Sertifikat NKV</li>
            <li>HACCP Certified</li>
          </ul>
        </div>
        <div data-aos="fade-left">
          <img src="./assets/img/Proses Produksi.jpg
          " alt="Proses Produksi" style="width: 100%; border-radius: 10px;">
        </div>
      </div>
    </section>

    <section id="sustainability">
      <h2 class="section-title" data-aos="fade-up">Bergerak untuk Masa Depan yang Berkelanjutan</h2>
      <div class="timeline">
        <div class="timeline-item" data-aos="fade-up">
          <h3>Manajemen Limbah</h3>
          <p>Implementasi sistem pengolahan limbah ramah lingkungan.</p>
        </div>
        <div class="timeline-item" data-aos="fade-up" data-aos-delay="100">
          <h3>Program CSR</h3>
          <p>Pemberdayaan masyarakat lokal melalui berbagai program sosial.</p>
        </div>
      </div>
    </section>

    <section id="testimonials">
      <h2 class="section-title" data-aos="fade-up">Apa Kata Mereka?</h2>
      <div class="testimonials-slider" id="testimonialsSlider">
        <div class="testimonial-card">
          <p>"PT Ciomas Adisatwa selalu menjaga kualitas produk mereka. Sangat memuaskan!"</p>
          <strong>- Ahmad Suryanto, Distributor</strong>
        </div>
        <div class="testimonial-card">
          <p>"Kemitraan yang sangat menguntungkan dan profesional."</p>
          <strong>- Budi Santoso, Peternak Mitra</strong>
        </div>
      </div>
    </section>

    <footer id="contact">
      <div class="footer-grid">
        <div>
          <h3>PT Ciomas Adisatwa</h3>
          <p>Bagian dari Grup Japfa</p>
        </div>
        <div>
          <h3>Kontak</h3>
          <p>Email: info@ciomas-adisatwa.com</p>
          <p>Telepon: (021) XXX-XXXX</p>
        </div>
        <div>
          <h3>Ikuti Kami</h3>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
      // Initialize AOS
      AOS.init({
        duration: 1000,
        once: true
      });

      // Testimonials Slider
      const slider = document.getElementById('testimonialsSlider');
      let isDown = false;
      let startX;
      let scrollLeft;

      slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
      });

      slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
      });

      slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
      });

      slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
      });

      // Navbar Scroll Effect
      window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
          navbar.style.background = 'rgba(255, 255, 255, 0.95)';
          navbar.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
        } else {
          navbar.style.background = 'rgba(255, 255, 255, 0.95)';
          navbar.style.boxShadow = 'none';
        }
      });

      // Auto Scroll Testimonials
      setInterval(() => {
        if (!isDown) {
          if (slider.scrollLeft + slider.offsetWidth >= slider.scrollWidth) {
            slider.scrollLeft = 0;
          } else {
            slider.scrollLeft += slider.offsetWidth;
          }
        }
      }, 5000);
    </script>
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
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
</body>

</html>