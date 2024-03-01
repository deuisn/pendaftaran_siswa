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

// Periksa apakah parameter id tersedia dan valid
if (isset($_GET['id'])) {
    $id_pendaftar = $_GET['id'];

    // Periksa koneksi database
    if ($koneksi->connect_error) {
        die("Koneksi database gagal: " . $koneksi->connect_error);
    }

    // Query untuk mendapatkan data pendaftar berdasarkan ID
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

if (isset($_POST['btnsimpan'])) {
    // htmlspecialchars agar inputan lebih aman dari injection
    $nilai_un = $koneksi->real_escape_string($_POST['nilai_un']);
    $nilai_us = $koneksi->real_escape_string($_POST['nilai_us']);

    // Persiapan query untuk memperbarui data
    $query = "UPDATE pendaftar SET nilai_un = '$nilai_un', nilai_us = '$nilai_us' WHERE users_id = '$id_pendaftar'";

    if ($koneksi->query($query) === TRUE) {
        // Memperoleh nilai dari database setelah disimpan
        $query_select_status = "SELECT * FROM pendaftar WHERE users_id = '$id_pendaftar'";
        $result = $koneksi->query($query_select_status);
        $row = $result->fetch_assoc();

        // Memeriksa apakah nilai telah tersimpan dan menampilkan kartu "Proses Penilaian" jika ya
        if ($row['nilai_un'] != null && $row['nilai_us'] != null) {
?>

<?php
        }

        echo "<script>alert('Simpan nilai Sukses, Terimakasih..!');
        window.location.href = 'index.php?id=$id_pendaftar';</script>";
    } else {
        echo "<script>alert('Simpan nilai GAGAL!!!');
        window.location.href = 'index.php?id=$id_pendaftar';</script>";
    }

    // Tutup koneksi database
    $koneksi->close();
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

    <style>
        /* CSS untuk kartu status */
        .card-status {
            margin-bottom: 20px;
        }

        /* CSS untuk kartu data diri */
        .card-data-diri {
            margin-bottom: 20px;
        }
    </style>


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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

                    <div class="row">
                        <!-- Data Nilai -->
                        <?php if ($status == 'Baru' && $nilai_un == 0 && $nilai_us == 0) : ?>
                            <div class="col-md-6">
                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">MASUKKAN DATA NILAI</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-danger mt-1">* Masukkan nilai anda untuk menyelesaikan proses pendaftaran!</p>
                                        <form class="user" action="" method="POST">
                                            <div class="form-group">
                                                <label for="nilai_un">Nilai Ujian Nasional</label>
                                                <input type="text" name="nilai_un" class="form-control" id="nilai_un" placeholder="Masukkan Nilai Ujian Nasional">
                                            </div>
                                            <div class="form-group">
                                                <label for="nilai_us">Nilai Ujian Sekolah</label>
                                                <input type="text" name="nilai_us" class="form-control" id="nilai_us" placeholder="Masukkan Nilai Ujian Sekolah">
                                            </div>
                                            <hr>
                                            <div class="text-right">
                                                <button type="submit" name="btnsimpan" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        <?php endif; ?>
                        <!-- Data Diri -->
                        <div class="col-md-6 order-md-2">
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
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Kartu Status -->
                        <?php if ($status == 'Baru' && $nilai_un > 0  && $nilai_us > 0) : ?>
                            <div class="col-md-6 order-md-1">
                                <!-- Hasil Penilaian -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">PENGUMUMAN HASIL SELEKSI</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3 mt-3">Proses Penilaian</h5>
                                                <div class="col-auto">
                                                    <i class="fas fa-spinner text-warning" style="font-size: 90px;"></i>
                                                </div>
                                                <p class="card-text mt-2">Terimakasih telah melakukan pendaftaran di SMKN 1 RONGGA. Pengumuman pada tanggal :</p>
                                                <span class="badge badge-danger" style="font-size: 18px;">10 Juni 2024</span>
                                            </div>
                                            <div class="card-footer">
                                                <marquee style="margin-bottom: -5px;">SMK NEGERI 1 RONGGA - BANDUNG BARAT</marquee>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($status == 'LOLOS') : ?>
                            <div class="col-md-6 order-md-1">
                                <!-- Anda Lolos -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">PENGUMUMAN HASIL SELEKSI</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3 mt-3">ANDA LOLOS</h5>
                                                <div class="col-auto">
                                                    <i class="fas fa-check-circle text-success" style="font-size: 90px;"></i>
                                                </div>
                                                <p class="card-text mt-2">Selamat anda lolos seleksi di SMKN 1 RONGGA. Lakukan daftar ulang pada tanggal :</p>
                                                <span class="badge badge-danger" style="font-size: 18px;">12 Juni 2024</span>
                                                <!-- Tombol untuk mencetak bukti -->
                                                <button class="btn btn-outline-primary align-items-stretch btn-sm" onclick="window.location.href='cetakbukti.php?id=<?php echo $id_pendaftar; ?>';">Cetak Bukti</button>

                                            </div>
                                            <div class="card-footer">
                                                <marquee style="margin-bottom: -5px;">SMK NEGERI 1 RONGGA - BANDUNG BARAT</marquee>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif ($status == 'TIDAK LOLOS') : ?>
                            <div class="col-md-6 order-md-1">
                                <!-- Tidak Lolos -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">PENGUMUMAN HASIL SELEKSI</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card text-center">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3 mt-3">ANDA TIDAK LOLOS</h5>
                                                <div class="col-auto">
                                                    <i class="fas fa-times text-danger" style="font-size: 90px;"></i>
                                                </div>
                                                <p class="card-text mt-2">Anda belum lolos. Terimakasih telah mengikuti seleksi dengan baik.</p>
                                            </div>
                                            <div class="card-footer">
                                                <marquee style="margin-bottom: -5px;">SMK NEGERI 1 RONGGA - BANDUNG BARAT</marquee>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Persyaratan Daftar Ulang -->
                        <?php if ($status == 'LOLOS') : ?>
                            <div class="col-md-6 order-md-1">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">PERSYARATAN DAFTAR ULANG</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Siswa yang lolos seleksi wajib melakukan daftar ulang dengan membawa berkas sebagai berikut:</p>
                                        <ol class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">1. Bukti Pendaftaran Lolos <span class="badge badge-info badge-pill">1 lembar</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">2. FC Akta <span class="badge badge-info badge-pill">1 lembar</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">3. FC Kartu Keluarga <span class="badge badge-info badge-pill">1 lembar</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">4. FC Nilai Ujian Nasional <span class="badge badge-info badge-pill">2 lembar</span></li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">5. FC Nilai Ujian Sekolah <span class="badge badge-info badge-pill">2 lembar</span></li>
                                        </ol>
                                        <p class="text-danger mt-3">* Wajib melakukan daftar ulang pada tanggal: 12 Juni 2024</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
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