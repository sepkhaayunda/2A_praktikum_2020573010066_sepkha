<?php

//include koneksi database
require "proses/koneksi.php";

//get data dari form
$kodebarang = $_POST['kodebarang'];
$nama = $_POST['nama'];
$keterangan = $_POST['keterangan'];
$gambar = $_POST['gambar'];

//query insert data ke dalam database
$query = "UPDATE `tb_barang` SET `nama` = '$nama', `keterangan` = '$keterangan', `gambar` = '$gambar' WHERE `tb_barang`.`kodebarang` = $kodebarang";

//kondisi pengecekan apakah data berhasil dimasukkan atau tidak
if($conn->query($query)) {

    //redirect ke halaman index.php 
    header("location: barang");

} else {

    //pesan error gagal insert data
    echo "Data Gagal Disimpan!";

}

?>