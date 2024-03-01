<?php
include "boot.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Pendaftaran Siswa Online SMK Negeri 1 Rongga">
    <meta name="author" content="deuisnurhalizah">

    <title>Registrasi - Aplikasi Pendaftaran Siswa</title>
    <!-- Gambar Tittle -->
    <link rel="icon" type="image/png" href="assets/img/LOGO_SMKN_1_RONGGA.png">

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .img-logo {
            max-height: 150px;
            margin-bottom: 20px;
        }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrasi Siswa Baru</h1>
                                    </div>
                                    <form class="user" action="registrasi_control.php" method="POST" onsubmit="return validateForm();">
                                        <input type="hidden" name="status" value="pendaftar">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anda">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <div class="form-check">
                                                    <input type="radio" name="jenis_kelamin" value="Laki-Laki" class="form-check-input" id="laki">
                                                    <label for="laki" class="form-check-label">Laki-Laki</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="form-check-input" id="perempuan">
                                                    <label for="perempuan" class="form-check-label">Perempuan</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="agama">Agama</label>
                                                <select name="agama" id="agama" class="form-control">
                                                    <option value="">Pilih Agama</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Katolik">Katolik</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Buddha">Buddha</option>
                                                    <option value="Konghucu">Konghucu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jurusan">Jurusan</label>
                                            <select name="jurusan" id="jurusan" class="form-control">
                                                <option value="">Pilih Jurusan</option>
                                                <option value="ATPH">Agribisnis Tanaman Pangan dan Hortikultura (ATPH)</option>
                                                <option value="RPL">Rekayasa Perangkat Lunak (RPL)</option>
                                                <option value="TBSM">Teknik Bisnis Sepeda Motor (TBSM)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" id="email" placeholder="Email aktif">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="telepon">Telepon</label>
                                                <input type="number" name="telepon" class="form-control" id="telepon" placeholder="Telepon">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ulangi_password">Ulangi Password</label>
                                                <input type="password" name="ulangi_password" class="form-control" id="ulangi_password" placeholder="Ulangi Password">
                                            </div>
                                        </div>


                                        <input type="hidden" name="level" value="siswa">
                                        <input type="hidden" name="status" value="Baru">
                                        <button name="btn_registrasi" value="simpan" class="btn btn-primary btn-user btn-block">
                                            Registrasi
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Sudah punya akun? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        function validateForm() {
            var nama = document.getElementById("nama").value;
            var tempat_lahir = document.getElementById("tempat_lahir").value;
            var tanggal_lahir = document.getElementById("tanggal_lahir").value;
            var jenis_kelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
            var agama = document.getElementById("agama").value;
            var jurusan = document.getElementById("jurusan").value;
            var alamat = document.getElementById("alamat").value;
            var email = document.getElementById("email").value;
            var telepon = document.getElementById("telepon").value;
            var password = document.getElementById("password").value;
            var ulangi_password = document.getElementById("ulangi_password").value;

            if (nama == "" || tempat_lahir == "" || tanggal_lahir == "" || !jenis_kelamin || agama == "" || jurusan == "" || alamat == "" || email == "" || telepon == "" || password == "" || ulangi_password == "") {
                alert("Silakan lengkapi semua data sebelum melanjutkan!");
                return false;
            }
        }
    </script>

</body>

</html>