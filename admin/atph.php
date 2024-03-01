<?php

include "../config/koneksi.php";

$tampil = $koneksi->query("select*from pendaftar where jurusan like 'ATPH'");
?>

<div class="container">
  <button class="btn btn-outline-primary align-items-stretch btn-sm" onclick="window.history.back();">Kembali</button>
  <!DOCTYPE html>
  <html lang="en">


  <button class="btn" onclick="printDiv('div1')"><i class="bi bi-printer-fill fs-1"></i></button>
  <div id="div1">

    <h4 class="text-gray-800">Agribisnis Tanaman Pangan Dan Hortikultura (ATPH)</h3>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered border-success">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Tempat Lahir</th>
              <th scope="col">Tanggal Lahir</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">Agama</th>
              <th scope="col">Jurusan</th>
              <th scope="col">Alamat</th>
              <th scope="col">Email</th>
              <th scope="col">Telepon</th>
              <th scope="col">Status</th>
            </tr>


            <?php
            while ($s = $tampil->fetch_array()) {
              @$no++;
              echo "<tr>";
              echo "<td>$no</td>";
              echo "<td>$s[nama]</td>";
              echo "<td>$s[tmpt_lahir]</td>";
              echo "<td>$s[tgl_lahir]</td>";
              echo "<td>$s[jns_kelamin]</td>";
              echo "<td>$s[agama]</td>";
              echo "<td>$s[jurusan]</td>";
              echo "<td>$s[alamat]</td>";
              echo "<td>$s[email]</td>";
              echo "<td>$s[telepon]</td>";
              echo "<td>$s[status]</td>";
            ?>

            <?php
              echo "</tr>";
            }
            ?>
          </table>

        </div>
        <script>
          function printDiv(el) {
            var a = document.body.innerHTML;
            var b = document.getElementById(el).innerHTML;
            document.body.innerHTML = b;
            window.print();
            document.body.innerHTML = b;
            window.print();
            document.body.innerHTML = a;

          }
        </script>