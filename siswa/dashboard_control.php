<?php
session_start();
@$user = $_SESSION['username'];
if ($user == "") {
?>
    <script>
        document.location = '../login.php';
    </script>
<?php
} else {
}
?>
<?php

include "../config/koneksi.php";
session_start();

if (isset($_SESSION['id_users'])) {
    $id_user = $_SESSION['id_users'];
    $result_pendaftar = $koneksi->query("SELECT * FROM pendaftar WHERE users_id = '$id_user'");

    if (mysqli_num_rows($result_pendaftar) > 0) {
        $data_pendaftar = $result_pendaftar->fetch_array();
        $id_pendaftar = $data_pendaftar['id'];
    }

    if (isset($_POST['btn_simpan']) && $_POST['btn_simpan'] == 'simpan_nilai') {
        $nilai_un = $_POST['nilai_un'];
        $nilai_us = $_POST['nilai_us'];

        $insert_nilai = $koneksi->query("INSERT INTO pendaftar (nilai_un, nilai_us) VALUES ('$nilai_un', '$nilai_us')");
    }
    if ($koneksi->query($sql) === TRUE) {
        header('location:index.php');
    } else {
        echo "Error deleting record: " . $koneksi->error;
    }

    $koneksi->close();
}



die;
