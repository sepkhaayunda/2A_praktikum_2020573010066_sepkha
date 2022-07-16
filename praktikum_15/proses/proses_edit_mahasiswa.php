<?php
require "session.php";

if (isset($_POST['edit'])) {
    require "koneksi.php";
    $nimlama = $_POST['nimlama'];
    $nimbaru = $_POST['nimbaru'];
    if ($nimlama == $nimbaru) {
        $nim = $nimlama;
    } else {
        $nim = $nimbaru;
    }
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $prodi = $_POST["prodi"];
    $alamat = $_POST["alamat"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $tempat_lahir = $_POST["tempat_lahir"];
    $nama_gambar = $_FILES['gambar']['name'];
    $level = $_POST["level"];
    $id_user = $_POST["id_user"];

    $level_lama = mysqli_query($conn, "SELECT level FROM tb_user WHERE id = '$id_user'");
    $hasil = mysqli_fetch_array($level_lama);

    if ($level != $hasil['level']) {
        $update_user = mysqli_query($conn, "UPDATE tb_user SET level = '$level' WHERE id = '$id_user'");

        if (!$update_user) {
            echo '<script>alert("Edit data tidak berhasil, mohon kontak admin");</script>';
            echo '<script>window.location="../mahasiswa";</script>';
        }
    }

    if ($nama_gambar == '') {
        $tgl_lahir =  ($tanggal_lahir == NULL ? "NULL" : "'$tanggal_lahir'");
        $update = mysqli_query($conn, "UPDATE tb_mahasiswa SET nim='$nim', nama_dosen='$nama', kelas='$kelas', prodi='$prodi', alamat='$alamat', tgl_lahir=" . ($tanggal_lahir == NULL ? "NULL" : "'$tanggal_lahir'") . ", tempat_lahir='$tempat_lahir' WHERE nim = '$nimlama'");
    } else {
        $ukuran_gambar = $_FILES['gambar']['size'];
        if ($ukuran_gambar < 2044070) {
            $file_tmp = $_FILES['gambar']['tmp_name'];
            $sql = mysqli_query($conn, "SELECT gambar FROM tb_mahasiswa WHERE nim = '$nimlama'");
            $update = mysqli_query($conn, "UPDATE tb_mahasiswa SET nim='$nim', nama_dosen='$nama', kelas='$kelas', prodi='$prodi', alamat='$alamat', tgl_lahir=" . ($tanggal_lahir == NULL ? "NULL" : "'$tanggal_lahir'") . ", tempat_lahir='$tempat_lahir', gambar = '$nama_gambar' WHERE nim = '$nimlama'");
        } else {
            echo '<script>alert("Ukuran gambar melebihi 1Mb, tolong kecilkan ukurannya");</script>';
            echo '<script>window.location="../mahasiswa";</script>';
        }
    }

    if ($update) {
        if (isset($sql)) {
            $hasil = mysqli_fetch_array($sql);

            if ($hasil['gambar'] != '') {
                unlink('../images/mahasiswa/' . $hasil['gambar']);
            }
            move_uploaded_file($file_tmp, '../images/mahasiswa/' . $nama_gambar);
        }
        echo '<script>alert("EDIT data berhasil");</script>';
        echo '<script>window.location="../mahasiswa";</script>';
    } else {
        echo '<script>alert("Edit data tidak berhasil, mohon kontak admin");</script>';
        echo '<script>window.location="../mahasiswa";</script>';
    }
} else {
    echo '<script>alert("Edit data tidak berhasil, mohon kontak admin");</script>';
    echo '<script>window.location="../mahasiswa";</script>';
}