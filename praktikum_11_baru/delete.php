<?php
    require "proses/koneksi.php";

    $id = $_GET['kodebarang'];

    $query = "DELETE FROM tb_barang WHERE kodebarang= '$id'";
    
    if($conn->query($query)) {
        header("location: barang");
    } else {
        echo "DATA GAGAL DIHAPUS!";
    }
?>