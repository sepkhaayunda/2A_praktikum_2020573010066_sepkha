<?php
if (empty($_GET['x'])) {
    echo "<script>window.location='home';</script>";
} else if (isset($_GET['x'])) {
    $link = array("home", "peminjaman", "mahasiswa", "data_peminjaman", "barang", "dosen", "tdm", "profile");

    foreach ($link as $value) {
        if ($value == $_GET['x']) {
            require "$value" . ".php";
        }
    }
} else {
    require "home.php";
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
