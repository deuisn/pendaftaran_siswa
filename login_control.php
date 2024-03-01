<?php
include "config/koneksi.php";
if (isset($_POST['btn_login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $kueri = "SELECT * from users where username='$username' and password=md5'$password'";
    $users = $koneksi->query($kueri);
    $cek = $users->num_rows;
    $tampil = $koneksi->query("select*from users where username='$username'");
    $level = $tampil->fetch_array();

    if ($cek > 0) {
        if ($level['level'] == 'admin') {
            $_SESSION['username'] = $username;
?>
            <script type="text/javascript">
                document.location.href = 'admin/index.php';
            </script>
        <?php
        } elseif ($level['$level'] == 'siswa') {
            $_SESSION['username'] = $username;
        ?>
            <script type="text/javascript">
                document.location.href = 'siswa/index.php';
            </script>
<?php
        }
    } else {

        echo "<script>
    alert('Maaf, Login Gagal, Pastikan Email dan Password anda Benar...!');
    document.location='index.php';
    </script>";
    }
}
?>