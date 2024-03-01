<?php
session_start();

include "boot.php";
include "config/koneksi.php";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Validasi input
    if (empty($email) || empty($password)) {
        $error = "Email dan password harus diisi.";
    } else {
        $query = "SELECT * FROM users WHERE username='$email' AND password=md5('$password')";
        $result = $koneksi->query($query);

        if ($result === false) {
            $error = "Query error: " . $koneksi->error;
        } else {
            $user = $result->fetch_assoc();
            if ($user) {
                $level = $user['level'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['pesan_login'] = "Login berhasil! Selamat datang, " . $user['username'] . ".";
                if ($level == 'admin') {
                    header("Location: admin/index.php");
                    exit();
                } elseif ($level == 'siswa') {
                    header("Location: siswa/index.php?id=$user[id]");
                    exit();
                }
            } else {
                $error = "Email atau password salah.";
            }
        }
    }
}

// Membersihkan pesan registrasi setelah digunakan
unset($_SESSION['pesan_login']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Pendaftaran Siswa Online SMK Negeri 1 Rongga">
    <meta name="author" content="deuisnurhalizah">
    <title>Login - Aplikasi Pendaftaran Siswa</title>
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
                                        <img src="assets/img/LOGO_SMKN_1_RONGGA.png" alt="logo aplikasi" class="img-logo">
                                        <h1 class="h4 text-gray-900">Login Aplikasi Pendaftaran Siswa</h1>
                                        <h1 class="h4 text-gray-900 mb-4"><b>SMK NEGERI 1 RONGGA</b></h1>

                                        <?php
                                        if (isset($error)) {
                                            echo '<div class="alert alert-danger">' . $error . '</div>';
                                        }
                                        if (isset($_GET['notif'])) {
                                            echo '<div class="alert alert-success">Registrasi Berhasil, Login Menggunakan Email dan Password anda!</div>';
                                        }
                                        ?>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Masukkan email anda...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login" value="login" class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="registrasi.php">Registrasi Siswa Baru!</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>