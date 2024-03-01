<?php
// Assuming you want to delete a file
$id = $_GET['id'];
include "../config/koneksi.php";

// Assuming you have a table named "records" with an ID column

$sql = "DELETE FROM pendaftar WHERE users_id = $id";

if ($koneksi->query($sql) === TRUE) {
    $user = "DELETE FROM users where id = $id";
    $koneksi->query($user   );
    header('location:pendaftaran.php');
} else {
    echo "Error deleting record: " . $koneksi->error;
}

$koneksi->close();
