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

    $ubah = $koneksi->query("SELECT * FROM pendaftar WHERE users_id ='$id_pendaftar'");
    $s = $ubah->fetch_array();
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
                    <i class="fas fa-th-list"></i>
                    <span>Nilai</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="editprofil.php?id=<?= $id_pendaftar ?>">
                    <i class="fas fa-user-edit"></i>
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
                                <a class="dropdown-item" href="editprofil.php?id=<?= $id_pendaftar ?>">
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
                    <?php
                    if (isset($_POST['simpan'])) {
                        $nama = $koneksi->real_escape_string($_POST['nama']);
                        $tempat_lahir = $koneksi->real_escape_string($_POST['tempat_lahir']);
                        $tanggal_lahir = $koneksi->real_escape_string($_POST['tanggal_lahir']);
                        $jenis_kelamin = $koneksi->real_escape_string($_POST['jenis_kelamin']);
                        $agama = $koneksi->real_escape_string($_POST['agama']);
                        $jurusan = $koneksi->real_escape_string($_POST['jurusan']);
                        $alamat = $koneksi->real_escape_string($_POST['alamat']);
                        $email = $koneksi->real_escape_string($_POST['email']);
                        $telepon = $koneksi->real_escape_string($_POST['telepon']);

                        if (empty($nama) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($agama) || empty($jurusan) || empty($alamat) || empty($email) || empty($telepon)) {
                            echo "Silahkan lengkapi semua field.";
                        } else {
                            // Periksa apakah status masih "Baru"
                            if ($s['status'] == 'Baru') {

                                // Lakukan proses penyimpanan data ke database
                                $edit = $koneksi->query("UPDATE pendaftar SET Nama='$nama', tmpt_lahir='$tempat_lahir', tgl_lahir='$tanggal_lahir', jns_kelamin='$jenis_kelamin', agama='$agama', jurusan='$jurusan', alamat='$alamat', email='$email', telepon='$telepon' WHERE id='$id_pendaftar'");

                                if ($edit) {
                                    echo "<script>alert('Data berhasil diubah'); window.location='editprofil.php?id=$id_pendaftar';</script>";
                                } else {
                                    echo "<script>alert('Gagal mengubah data.');</script>";
                                }
                            } else {
                                echo "<script>alert('Data tidak dapat diubah karena sudah divalidasi !!!');</script>";
                            }
                        }
                    }
                    ?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">EDIT PROFIL</h1>
                    <div class="row">
                        <div class="col-md-8">
                            <form class="user" action="" method="POST">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anda" value="<?= $s['nama'] ?>" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= $s['tmpt_lahir'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= $s['tgl_lahir'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Jenis Kelamin</label>
                                        <div class="form-check">
                                            <input type="radio" name="jenis_kelamin" class="form-check-input" id="laki" value="Laki-Laki" <?php if (isset($s['jns_kelamin']) && $s['jns_kelamin'] == 'Laki-Laki') echo 'checked="checked"'; ?>>
                                            <label for="laki" class="form-check-label">Laki-Laki</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="jenis_kelamin" class="form-check-input" id="perempuan" value="Perempuan" <?php if (isset($s['jns_kelamin']) && $s['jns_kelamin'] == 'Perempuan') echo 'checked="checked"'; ?>>
                                            <label for="perempuan" class="form-check-label">Perempuan</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="agama">Agama</label>
                                        <select name="agama" id="agama" class="form-control" required>
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" <?php if ($s['agama'] == 'Islam') echo 'selected'; ?>>Islam</option>
                                            <option value="Kristen" <?php if ($s['agama'] == 'Kristen') echo 'selected'; ?>>Kristen</option>
                                            <option value="Katolik" <?php if ($s['agama'] == 'Katolik') echo 'selected'; ?>>Katolik</option>
                                            <option value="Hindu" <?php if ($s['agama'] == 'Hindu') echo 'selected'; ?>>Hindu</option>
                                            <option value="Buddha" <?php if ($s['agama'] == 'Buddha') echo 'selected'; ?>>Buddha</option>
                                            <option value="Konghucu" <?php if ($s['agama'] == 'Konghucu') echo 'selected'; ?>>Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <select name="jurusan" id="jurusan" class="form-control" required>
                                        <option value="">Pilih Jurusan</option>
                                        <option value="ATPH" <?php if ($s['jurusan'] == 'ATPH') echo 'selected'; ?>>Agribisnis Tanaman Pangan dan Hortikultura (ATPH)</option>
                                        <option value="RPL" <?php if ($s['jurusan'] == 'RPL') echo 'selected'; ?>>Rekayasa Perangkat Lunak (RPL)</option>
                                        <option value="TBSM" <?php if ($s['jurusan'] == 'TBSM') echo 'selected'; ?>>Teknik Bisnis Sepeda Motor (TBSM)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control" required><?= $s['alamat'] ?></textarea>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email aktif" value="<?= $s['email'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telepon">Telepon</label>
                                        <input type="number" name="telepon" class="form-control" id="telepon" placeholder="Telepon" value="<?= $s['telepon'] ?>" required>
                                    </div>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary mb-5">Ubah</button>
                                <a href="index.php?id=<?= $id_pendaftar ?>" class="btn btn-danger mb-5">Kembali</a>
                            </form>
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