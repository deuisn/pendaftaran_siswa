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
$noti = mysqli_query($koneksi, "SELECT*FROM pendaftar WHERE status = 'Baru'");
$count = mysqli_num_rows($noti);
$tampil = $koneksi->query("SELECT * FROM pendaftar");

$query = "SELECT COUNT(*) AS total_pendaftar FROM pendaftar";
$result = $koneksi->query($query);

// Periksa apakah query berhasil dijalankan
if ($result) {
    $row = $result->fetch_assoc();
    $total_pendaftar = $row['total_pendaftar'];
} else {
    $total_pendaftar = 0; // Atur ke 0 jika terjadi kesalahan
}
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

                    <!-- Page Heading -->
                    <div class="alert alert-success">Jumlah pendaftar baru <?php echo $count ?></div>

                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h4 font-weight-bold text-info text-uppercase mb-1">Pendaftar Lolos</div>
                                            <div class="h5 mt-3 font-weight-bold" id="pendaftar-lolos"></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2" id="progress-bar">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300" style="font-size: 90px"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h4 font-weight-bold text-warning text-uppercase mb-1">Pendaftar Tidak Lolos</div>
                                            <div class="h5 mt-3 font-weight-bold" id="pendaftar-tidak-lolos"></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2" id="progress-bar-tidak-lolos">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300" style="font-size: 90px"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-3 mt-3">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Agribisnis Tanaman Pangan Dan Hortikultura (ATPH)</div>
                                            <div class="font-weight-bold mb-1" id="atph"></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2" id="progress-bar-atph">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4 col-md-6 mb-3 mt-3">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Rekayasa Perangkat Lunak (RPL)</div>
                                            <div class="font-weight-bold mb-1" id="rpl"></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2" id="progress-bar-rpl">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3 mt-3">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Teknik Bisnis Sepeda Motor (TBSM)</div>
                                            <div class="font-weight-bold mb-1" id="tbsm"></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2" id="progress-bar-tbsm">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3">
                    <h3 class="text-gray-800">Data Pendaftar</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover">
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Alamat</td>
                                    <td>Nilai UN</td>
                                    <td>Nilai US</td>
                                    <td>Waktu</td>
                                    <td>Status</td>
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

    <script>
        function updateData() {
            var totalPendaftar = <?php echo $total_pendaftar; ?>;
            var kuotaPendaftarLolos = 250;

            var pendaftarLolos = <?php
                                    $query_lolos = "SELECT COUNT(*) AS total_lolos FROM pendaftar WHERE status = 'Lolos'";
                                    $result_lolos = $koneksi->query($query_lolos);
                                    $row_lolos = $result_lolos->fetch_assoc();
                                    echo $row_lolos['total_lolos'];
                                    ?>;

            var persentase = (pendaftarLolos / kuotaPendaftarLolos) * 100;

            document.getElementById('pendaftar-lolos').textContent = pendaftarLolos + ' orang';

            document.querySelector('.progress-bar').style.width = persentase + '%';
            document.querySelector('.progress-bar').setAttribute('aria-valuenow', persentase);
        }

        setInterval(updateData);
    </script>

    <script>
        function updateDataTidakLolos() {
            var totalPendaftar = <?php echo $total_pendaftar; ?>;
            var kuotaPendaftarTidakLolos = 250;

            var pendaftarTidakLolos = <?php
                                        $query_tidak_lolos = "SELECT COUNT(*) AS total_tidak_lolos FROM pendaftar WHERE status = 'Tidak Lolos'";
                                        $result_tidak_lolos = $koneksi->query($query_tidak_lolos);
                                        $row_tidak_lolos = $result_tidak_lolos->fetch_assoc();
                                        echo $row_tidak_lolos['total_tidak_lolos'];
                                        ?>;

            var persentaseTidakLolos = (pendaftarTidakLolos / totalPendaftar) * 100;

            document.getElementById('pendaftar-tidak-lolos').textContent = pendaftarTidakLolos + ' orang';

            document.querySelector('.progress-bar-tidak-lolos').style.width = persentaseTidakLolos + '%';
            document.querySelector('.progress-bar-tidak-lolos').setAttribute('aria-valuenow', persentaseTidakLolos);
        }
        setInterval(updateDataTidakLolos);
    </script>

    <!-- atph -->
    <script>
        function updateDataATPH() {
            var kuotaATPH = 50;
            var pendaftarATPH = <?php
                                $query_atph = "SELECT COUNT(*) AS total_atph FROM pendaftar WHERE jurusan = 'ATPH'";
                                $result_atph = $koneksi->query($query_atph);
                                $row_atph = $result_atph->fetch_assoc();
                                echo $row_atph['total_atph'];
                                ?>;

            var persentaseATPH = (pendaftarATPH / kuotaATPH) * 100;

            document.getElementById('atph').textContent = pendaftarATPH + ' orang';

            // Mengubah warna progress bar menjadi hijau yang lebih muda
            document.getElementById('progress-bar-atph').style.backgroundColor = 'lightgreen';

            document.getElementById('progress-bar-atph').style.width = persentaseATPH + '%';
            document.getElementById('progress-bar-atph').setAttribute('aria-valuenow', persentaseATPH);
        }

        setInterval(updateDataATPH);
    </script>

    <!-- rpl -->
    <script>
        function updateDataRPL() {
            var kuotaRPL = 140;
            var pendaftarRPL = <?php
                                $query_rpl = "SELECT COUNT(*) AS total_rpl FROM pendaftar WHERE jurusan = 'RPL'";
                                $result_rpl = $koneksi->query($query_rpl);
                                $row_rpl = $result_rpl->fetch_assoc();
                                echo $row_rpl['total_rpl'];
                                ?>;

            var persentaseRPL = (pendaftarRPL / kuotaRPL) * 100;

            document.getElementById('rpl').textContent = pendaftarRPL + ' orang';

            // Mengubah warna progress bar menjadi merah
            document.getElementById('progress-bar-rpl').style.backgroundColor = 'salmon';

            document.getElementById('progress-bar-rpl').style.width = persentaseRPL + '%';
            document.getElementById('progress-bar-rpl').setAttribute('aria-valuenow', persentaseRPL);
        }

        setInterval(updateDataRPL);
    </script>

    <!-- tbsm -->
    <script>
        function updateDataTBSM() {
            var kuotaTBSM = 60;
            var pendaftarTBSM = <?php
                                $query_tbsm = "SELECT COUNT(*) AS total_tbsm FROM pendaftar WHERE jurusan = 'TBSM'";
                                $result_tbsm = $koneksi->query($query_tbsm);
                                $row_tbsm = $result_tbsm->fetch_assoc();
                                echo $row_tbsm['total_tbsm'];
                                ?>;

            var persentaseTBSM = (pendaftarTBSM / kuotaTBSM) * 100;

            document.getElementById('tbsm').textContent = pendaftarTBSM + ' orang';

            // Mengubah warna progress bar menjadi biru
            document.getElementById('progress-bar-tbsm').style.backgroundColor = '#4169E1';

            document.getElementById('progress-bar-tbsm').style.width = persentaseTBSM + '%';
            document.getElementById('progress-bar-tbsm').setAttribute('aria-valuenow', persentaseTBSM);
        }

        setInterval(updateDataTBSM);
    </script>


</body>

</html>