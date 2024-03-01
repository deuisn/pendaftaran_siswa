<?php
include "boot.php";
?>
<?php
include('config/koneksi.php');
session_start();
if (isset($_POST['btn_registrasi'])) {

    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $status = $_POST['status'];
    $level = $_POST['level'];
    $password = md5($_POST['password']);
    $ulangi_password = md5($_POST['ulangi_password']);

    if ($password != $ulangi_password) {
        echo "Error: Password tidak sama";
        echo "<br><br> <button type='button' onclick='history.back();'> Kembali </button>";
        die;
    }
    // Cek apakah email sudah terdaftar sebelumnya
    $cek_email = $koneksi->query("SELECT * FROM users WHERE username = '$email'");
    if ($cek_email->num_rows > 0) {
        echo "Error: Email sudah terdaftar";
        echo "<br><br> <button type='button' onclick='history.back();'> Kembali </button>";
        die;
    }


    //insert table user
    $sql_user = $koneksi->query("insert into users (username,password,level) values ('$email','$password','$level')");



    if ($sql_user) {
        $data_user = $koneksi->query("SELECT LAST_INSERT_ID()");
        while ($u = $data_user->fetch_array()) {
            $id_user = $u[0];
        }
        // insert table pendaftar
        $sql_pendaftar = $koneksi->query("insert into pendaftar (nama, tmpt_lahir, tgl_lahir, jns_kelamin, agama, jurusan, alamat, email, telepon, users_id, status) values('$nama','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$agama','$jurusan','$alamat','$email','$telepon','$id_user','$status')");


        if ($sql_pendaftar) {
            $email_pengirim = $_POST['email'];

            // Kirim email pemberitahuan ke admin
            $admin_email = "admin@gmail.com";
            $subject = "New Registration";
            $message = "A new user with email: $email_pengirim has registered. Please check the admin dashboard for details.";
            $headers = "From: $email_pengirim"; // Gunakan alamat email pengirim dari formulir pendaftaran
            mail($admin_email, $subject, $message, $headers);

            // Set pesan registrasi
            $_SESSION['pesan_login'] = "Registrasi Berhasil, Login Menggunakan Email dan Password anda!";
            header('location:index.php?notif=regis');
        } else {
            //jika gagal
            echo "Error insert pendaftar: " . mysqli_error($koneksi);
            echo "<br><br> <button type='button' onclick='history.back();'> Kembali </button>";
            die;
        }
    } else {
        //jika gagal
        echo "Error insert users: " . mysqli_error($koneksi);
        echo "<br><br> <button type='button' onclick='history.back();'> Kembali </button>";
        die;
    }
} else {
    echo "tidak ada";
}
