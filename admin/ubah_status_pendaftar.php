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
include "../config/koneksi.php";

// Pastikan request datang dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui AJAX
    $action = $_POST['action'];
    $id_pendaftar = $_POST['id'];
    $waktu_pendaftaran = $_POST['waktu_pendaftaran']; // Ambil waktu pendaftaran dari permintaan POST

    // Perbarui status pendaftar berdasarkan tindakan yang dipilih
    $status_pendaftar = ($action == 'LOLOS') ? 'LOLOS' : 'TIDAK LOLOS';

    // Update status pendaftar di database dan gunakan waktu pendaftaran yang diterima dari AJAX
    $query_update = "UPDATE pendaftar SET status = '$status_pendaftar', waktu = '$waktu_pendaftaran' WHERE id = $id_pendaftar";
    $result_update = $koneksi->query($query_update);

    // Periksa apakah query berhasil dijalankan
    if ($result_update) {
        // Kirimkan respons berhasil ke JavaScript
        echo "Success";
    } else {
        // Kirimkan respons gagal ke JavaScript
        echo "Error";
    }
}
