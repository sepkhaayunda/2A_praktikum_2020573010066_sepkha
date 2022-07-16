<?php
require "session.php";

if (isset($_POST['hapus'])) {
    require "koneksi.php";

    $id_user = $_POST['id_user'];
    $gambar = $_POST['gambar'];

    $delete_mahasiswa = mysqli_query($conn, "DELETE FROM tb_mahasiswa WHERE id_user = '$id_user'");
    $delete_user = mysqli_query($conn, "DELETE FROM tb_user WHERE id = '$id_user'");

    if ($delete_user and $delete_mahasiswa) {
        if ($gambar != '') {
            unlink('../images/mahasiswa/' . $gambar);
        }
        echo '<script>alert("Penghapusan data berhasil");</script>';
        echo '<script>window.location="../mahasiswa";</script>';
    } else {
        echo '<script>alert("Penghapusan data gagal, data ini sudah dipakai di halaman lain");</script>';
        echo '<script>window.location="../mahasiswa";</script>';
    }
} else {
    echo '<script>alert("Penghapusan data gagal, mohon kontak admin");</script>';
    echo '<script>window.location="../mahasiswa";</script>';
}