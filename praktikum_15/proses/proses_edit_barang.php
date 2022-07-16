<?php
require "session.php";

if (isset($_POST['edit'])) {
    require "koneksi.php";
    $kd_brg = $_POST['kd-brg'];
    $nm_brg = $_POST['nm-brg'];
    $ket = $_POST['ket'];
    $stok = $_POST['stok'];
    $nama_gambar = $_FILES['gambar']['name'];

    if ($nama_gambar == '') {
        $update = mysqli_query($conn, "UPDATE tb_barang SET kode_barang = '$kd_brg', nama_barang = '$nm_brg', keterangan = '$ket', stok = $stok WHERE kode_barang = '$kd_brg'");
    } else {
        $ukuran_gambar = $_FILES['gambar']['size'];
        if ($ukuran_gambar < 2044070) {
            $file_tmp = $_FILES['gambar']['tmp_name'];
            $sql = mysqli_query($conn, "SELECT gambar FROM tb_barang WHERE kode_barang = '$kd_brg'");
            $update = mysqli_query($conn, "UPDATE tb_barang SET kode_barang = '$kd_brg', nama_barang = '$nm_brg', keterangan = '$ket', gambar = '$nama_gambar', stok = $stok WHERE kode_barang = '$kd_brg'");
        } else {
            echo '<script>alert("Ukuran gambar melebihi 1Mb, tolong kecilkan ukurannya");</script>';
            echo '<script>window.location="../barang.php";</script>';
        }
    }

    if ($update) {
        if (isset($sql)) {
            $hasil = mysqli_fetch_array($sql);

            if ($hasil['gambar'] != '') {
                unlink('../images/barang/' . $hasil['gambar']);
            }
            move_uploaded_file($file_tmp, '../images/barang/' . $nama_gambar);
        }
        echo '<script>alert("EDIT data berhasil");</script>';
        echo '<script>window.location="../barang";</script>';
    } else {
        echo '<script>alert("Edit data tidak berhasil, mohon kontak admin");</script>';
        echo '<script>window.location="../barang";</script>';
    }
} else {
    echo '<script>alert("Edit data tidak berhasil, mohon kontak admin");</script>';
    echo '<script>window.location="../barang";</script>';
}