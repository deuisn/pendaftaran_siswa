<?php
session_start();
@$user = $_SESSION['username'];
if ($user == "") {
?>
    <script>
        document.location = '../index.php';
    </script>
<?php
} else {
}
?>
<?php
include "../boot.php";
include "../config/koneksi.php";

if (isset($_GET['id'])) {
    $id_pendaftar = $_GET['id'];

    // Periksa koneksi database
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    $query = "SELECT * FROM pendaftar WHERE users_id = '$id_pendaftar'";

    $result = $koneksi->query($query);

    // Periksa apakah data ditemukan
    if ($result->num_rows) {
        $row = $result->fetch_assoc();

        // Mengisi variabel dengan data dari database
        $nama = $row['nama'];
        $tempat_lahir = $row['tmpt_lahir'];
        $tanggal_lahir = $row['tgl_lahir'];
        $jenis_kelamin = $row['jns_kelamin'];
        $agama = $row['agama'];
        $jurusan = $row['jurusan'];
        $alamat = $row['alamat'];
        $email = $row['email'];
        $telepon = $row['telepon'];
        $nilai_un = $row['nilai_un'];
        $nilai_us = $row['nilai_us'];
        $status = $row['status'];
    } else {
        // Jika data tidak ditemukan, redirect ke halaman lain atau tampilkan pesan error
        echo "Data tidak ditemukan";
        exit(); // Menghentikan eksekusi script selanjutnya
    }
} else {
    // Jika parameter id tidak tersedia, redirect ke halaman lain atau tampilkan pesan error
    echo "ID tidak valid";
    exit(); // Menghentikan eksekusi script selanjutnya
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Aplikasi Pendaftaran Siswa</title>
    <link rel="icon" type="image/png" href="../assets/img/LOGO_SMKN_1_RONGGA.png">
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">APS - Sistem</div>
            </a>

            <!-- Heading -->
            <div class="sidebar-heading">
                SISWA
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?id=<?= $id_pendaftar ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="nilai.php?id=<?= $id_pendaftar ?>">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Nilai</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="editprofil.php?id=<?= $id_pendaftar ?>">
                    <i class="fas fa-fw fa-user-edit"></i>
                    <span>Edit Profile</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>




            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user ?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/avatar.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="editprofil?id=<?= $id_pendaftar ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <button class="btn btn-outline-primary align-items-stretch btn-sm" onclick="window.history.back();">Kembali</button>
                    <button class="btn" onclick="printDiv('div1')"><i class="bi bi-printer-fill fs-1"></i></button>
                    <div id="div1">
                        <style>
                            .card {
                                width: 100%;
                                /* Sesuaikan dengan lebar yang diinginkan */
                                height: auto;
                                /* Sesuaikan dengan tinggi yang diinginkan */
                            }
                        </style>

                        <div class="container">
                            <div class="col-md-6 order-md-2 container">
                                <div class="card shadow mb-4" style="border-radius: 20px;">
                                    <div class="card-header py-3" style="background-color: #4e73df; color: white; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                                        <h6 class="m-0 font-weight-bold">BUKTI PENDAFTAR LOLOS</h6>
                                    </div>
                                    <div class="card-body" style="padding: 20px;">
                                        <div class="text-center mb-4">
                                            <img id="logoImage" src="../assets/img/LOGO_SMKN_1_RONGGA.png" alt="logo" style="width: 100px; border-radius: 10px;">
                                        </div>
                                        <h5 class="text-center card-title mt-3">SMK NEGERI 1 RONGGA</h5>
                                        <ul class="list-group">
                                            <!-- Tambahkan gaya yang sesuai untuk list-group -->
                                            <li class="list-group-item" style="background-color: #f8f9fc;">
                                                <!-- Tambahkan gaya untuk konten dalam list-group -->
                                                <h6 class="mb-0" style="color:black;">Nama</h6>
                                                <small><?= $nama ?></small>
                                            </li>
                                            <li class="list-group-item" style="background-color: #f8f9fc;">
                                                <h6 class="mb-0" style="color:black;">Tempat, Tanggal Lahir</h6>
                                                <small><?= $tempat_lahir . ', ' . date('d F Y', strtotime($tanggal_lahir)); ?></small>
                                            </li>
                                            <li class="list-group-item" style="background-color: #f8f9fc;">
                                                <h6 class="mb-0" style="color:black;">Jenis Kelamin</h6>
                                                <small><?= $jenis_kelamin; ?></small>
                                            </li>
                                            <li class="list-group-item" style="background-color: #f8f9fc;">
                                                <h6 class="mb-0" style="color:black;">Agama</h6>
                                                <small><?= $agama; ?></small>
                                            </li>
                                            <li class="list-group-item" style="background-color: #f8f9fc;">
                                                <h6 class="mb-0" style="color:black;">Jurusan</h6>
                                                <small><?= $jurusan; ?></small>
                                            </li>
                                            <li class="list-group-item" style="background-color: #f8f9fc;">
                                                <h6 class="mb-0" style="color:black;">Alamat</h6>
                                                <small><?= $alamat; ?></small>
                                            </li>
                                            <li class="list-group-item" style="background-color: #f8f9fc;">
                                                <h6 class="mb-0" style="color:black;">Email</h6>
                                                <small><?= $email; ?></small>
                                            </li>
                                            <li class="list-group-item" style="background-color: #f8f9fc;">
                                                <h6 class="mb-0" style="color:black;">Telepon</h6>
                                                <small><?= $telepon; ?></small>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Aplikasi Pendaftaran Siswa - 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda akan keluar dari Aplikasi!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script>
        function printDiv(el) {
            var a = document.body.innerHTML;
            var b = document.getElementById(el).innerHTML;
            document.body.innerHTML = b;
            window.print();
            document.body.innerHTML = a;
        }
    </script>

</body>

</html>