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
<!DOCTYPE html>
<html lang="en">
<?php
include "../boot.php";
include "../config/koneksi.php";
$tampil = $koneksi->query("SELECT * FROM pendaftar");
?>

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Pendaftaran Siswa</title>
    <!-- Gambar Tittle -->
    <link rel="icon" type="image/png" href="../assets/img/LOGO_SMKN_1_RONGGA.png">

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
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
                ADMIN
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="pendaftaran.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Data Pendaftaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="laporan.php">
                    <i class="fas fa-fw fa-solid fa-clipboard-list"></i>
                    <span>Laporan</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">ADMIN</span>
                                <img class="img-profile rounded-circle" src="../assets/img/girl.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
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
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Data Pendaftar</h1>
                    <div class="row">
                        <form class="d-flex align-items-center" role="search" method="POST" action="search.php">
                            <!-- Grup form untuk input tanggal -->
                            <div class="form-group mr-3 text-center d-flex align-items-stretch">
                                <label for="tanggal1">Dari Tanggal
                                    <input class="form-control mr-3" type="date" id="tanggal1" name="tanggal1" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d') ?>" required>
                                </label>
                            </div>
                            <!-- Grup form untuk input tanggal -->
                            <div class="form-group text-center d-flex align-items-stretch ml-3">
                                <label for="tanggal2">Sampai Tanggal
                                    <input class="form-control mr-3" type="date" id="tanggal2" name="tanggal2" value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d') ?>" required>
                                </label>
                            </div>
                            <!-- Tombol pencarian dengan font size 14px dan setinggi form input -->
                            <button class="btn btn-outline-success align-items-stretch ml-3" type="submit" name="cari_tanggal" style="font-size: 14px;">Search</button>
                            <!-- Grup form untuk input pencarian berdasarkan nama -->
                            <div class="form-group ml-auto text-center">
                                <!-- Input search untuk pencarian nama -->
                                <input class="form-control me-2 mt-3" type="search" id="search" aria-label="Search" name="search" style="width: 200px;">
                            </div>
                            <!-- Tombol pencarian dengan font size 14px dan setinggi form input -->
                            <button class="btn btn-outline-success align-items-stretch ml-2" type="submit" name="cari_nama" value="cari" style="font-size: 14px;">Search</button>
                            <input type="hidden" name="waktu_pendaftaran" value="<?= $s['waktu'] ?>">
                        </form>


                        <div class="col-md-12">
                            <br>
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Alamat</td>
                                    <td>Nilai UN</td>
                                    <td>Nilai US</td>
                                    <td>Waktu</td>
                                    <td>Status</td>
                                    <td>Actions</td>
                                </tr>

                                <?php
                                while ($s = $tampil->fetch_array()) {
                                    @$no++;
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>$s[nama]</td>";
                                    echo "<td>$s[alamat]</td>";
                                    echo "<td>$s[nilai_un]</td>";
                                    echo "<td>$s[nilai_us]</td>";
                                    echo "<td>$s[waktu]</td>";
                                    echo "<td>$s[status]</td>";
                                ?>
                                    <td>
                                        <a href="detailpendaftar.php?id=<?= $s['id'] ?>" class="btn btn-primary btn-sm">Detail</a>
                                        <a href="delete.php?id=<?= $s['users_id'] ?>" onclick="return confirm('apakah anda yakin')" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>

                                <?php
                                    echo "</tr>";
                                }
                                ?>
                            </table>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>