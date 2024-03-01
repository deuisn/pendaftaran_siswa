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
// Mengambil data pendaftar dari database berdasarkan id atau parameter lain yang diperlukan
$id_pendaftar = $_GET['id']; // Misalnya id pendaftar diambil dari parameter GET
$query = "SELECT * FROM pendaftar WHERE id = $id_pendaftar";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();

$waktu_pendaftaran = $row['waktu'];


// Mengisi data pendaftar ke dalam variabel
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
$rata_rata = ($nilai_un + $nilai_us) / 2;
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
                                <a class="dropdown-item" href="editprofile.php">
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
                    <h1 class="h3 mb-4 text-gray-800">Detail Pendaftar</h1>
                    <!-- Element untuk menampilkan notifikasi -->
                    <div id="statusNotification"></div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DATA DIRI</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="../assets/img/girl.png" alt="fotoprofil" class="img-fluid rounded-circle" style="width: 200px">
                                    </div>
                                    <h5 class="text-center card-title mt-3"><?php echo $nama; ?></h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Tempat, Tanggal Lahir</h6>
                                            <small><?php echo $tempat_lahir . ', ' . date('d F Y', strtotime($tanggal_lahir)); ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Jenis Kelamin</h6>
                                            <small><?php echo $jenis_kelamin; ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Agama</h6>
                                            <small><?php echo $agama; ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Jurusan</h6>
                                            <small><?php echo $jurusan; ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Alamat</h6>
                                            <small><?php echo $alamat; ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Email</h6>
                                            <small><?php echo $email; ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Telepon</h6>
                                            <small><?php echo $telepon; ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Status</h6>
                                            <small id="status_pendaftar"><?php echo $row['status']; ?></small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DATA NILAI PENDAFTAR</h6>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info" id="alert-info">
                                        Data pendaftar belum divalidasi
                                    </div>

                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Nilai UJian Nasional</h6>
                                            <small><?php echo $nilai_un; ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Nilai UJian Sekolah</h6>
                                            <small><?php echo $nilai_us; ?></small>
                                        </li>
                                        <li class="list-group-item">
                                            <h6 class="mb-0" style="color:black;">Nilai Rata-Rata</h6>
                                            <small><?php echo $rata_rata; ?></small>
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary mt-3 btn-block" data-toggle="modal" data-target="#modalvalidasi"> Validasi Data Pendaftar
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalvalidasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Penilaian data pendaftar</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <a href="#" class="btn btn-success mr-3 modal-action" data-action="LOLOS" data-id="<?php echo $id_pendaftar; ?>">LOLOS</a>
                                                    <a href="#" class="btn btn-danger modal-action" data-action="TIDAK LOLOS" data-id="<?php echo $id_pendaftar; ?>">TIDAK LOLOS</a>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-lg-4 text-lg-end">
                                    <button class="btn btn-outline-success btn-block align-items-stretch" onclick="window.history.back();">Kembali</button>
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
        $(document).ready(function() {
            $('.modal-action').click(function() {
                var action = $(this).data('action');
                var id = $(this).data('id');

                // Kirim permintaan AJAX ke file PHP untuk mengubah status pendaftar
                $.ajax({
                    url: 'ubah_status_pendaftar.php',
                    method: 'POST',
                    data: {
                        action: action,
                        id: id,
                        waktu_pendaftaran: '<?php echo $waktu_pendaftaran; ?>'
                    },
                    success: function(response) {
                        // Jika berhasil, sembunyikan modal-dialog
                        $('#modalvalidasi').modal('hide');

                        // Ubah teks alert menjadi "Data sudah divalidasi"
                        $('#alert-info').html('<div class="alert alert-info" role="alert">Data sudah divalidasi!</div>');

                        // Perbarui teks status pada halaman
                        if (action == 'LOLOS') {
                            $('#status_pendaftar').text('LOLOS');
                        } else if (action == 'TIDAK LOLOS') {
                            $('#status_pendaftar').text('TIDAK LOLOS');
                        }

                        // Tampilkan notifikasi bahwa status berhasil diubah
                        $('#statusNotification').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Status berhasil diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    },

                    error: function(xhr, status, error) {
                        // Jika terjadi kesalahan, tampilkan pesan kesalahan
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            });
        });
    </script>

</body>

</html>