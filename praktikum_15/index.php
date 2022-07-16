<?php
if (empty($_GET['x'])) {
    echo "<script>window.location='home';</script>";
} elseif (isset($_GET['x'])) {
    $link = array("home" => "home.php", "pinjam" => "pinjam.php", "mahasiswa" => "mahasiswa.php", "datapeminjaman" => "data_peminjaman.php", "barang" => "barang.php", "dosen" => "dosen.php", "profile" => "profile.php", "setting" => "setting.php", "riwayatpeminjaman" => "riwayatpeminjaman.php");

    foreach ($link as $value => $key) {
        if ($value == $_GET['x']) {
            require "$key";
        }
    }
} else {
    echo "<script>window.location='home';</script>";
}

// if(empty($_GET['x'])) {
//     echo "<script>window.location='home';</script>";
// } else if ($_GET['x'] == 'home') {
//     require "home.php";
// } else if ($_GET['x'] == 'peminjaman') {
//     require "peminjaman.php";
// } else if ($_GET['x'] == 'mahasiswa') {
//     require "mahasiswa.php";
// } else if ($_GET['x'] == 'data_peminjaman') {
//     require "data_peminjaman.php";
// } else if ($_GET['x'] == 'barang') {
//     require "barang.php";
// } else if ($_GET['x'] == 'dosen') {
//     require "dosen.php";
// } else if ($_GET['x'] == 'tdm') {
//     require "tambah_data_mahasiswa.php";
// }