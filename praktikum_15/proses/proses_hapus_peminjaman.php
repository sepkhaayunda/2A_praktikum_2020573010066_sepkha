<?php

if (isset($_POST['hapus'])) {
    require "koneksi.php";

    $id_peminjaman = $_POST['id_peminjaman'];

    //melihat apakah data id_peminjaman yang dikirim ada di tabel tb_peminjaman
    $select = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE id_peminjaman = '$id_peminjaman'");
    $hasil = mysqli_fetch_array($select);

    if ($hasil['id_peminjaman'] == $id_peminjaman) {
        //menghapus data peminjaman sesuai id_peminjaman yang dikirim
        $hapus = mysqli_query($conn, "DELETE FROM tb_peminjaman WHERE id_peminjaman = '$id_peminjaman'");

        if ($hapus) {
            echo '<script>alert("Proses penghapusan berhasil");</script>';
            echo '<script>window.location="../pinjam";</script>';
        } else {
            echo '<script>alert("Proses penghapusan gagal, mohon kontak admin");</script>';
            echo '<script>window.location="../pinjam";</script>';
        }
    } else {
        echo '<script>alert("ID peminjaman yang dikirim tidak ditemukan, mohon kontak admin");</script>';
        echo '<script>window.location="../pinjam";</script>';
    }
} else {
    echo '<script>alert("Tombol hapus belum ditekan");</script>';
    echo '<script>window.location="../pinjam";</script>';
}