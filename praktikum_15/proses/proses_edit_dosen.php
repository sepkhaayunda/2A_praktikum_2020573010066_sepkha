<?php
require "session.php";

if (isset($_POST['edit'])) {
    require "koneksi.php";
    $niplama = $_POST['niplama'];
    $nipbaru = $_POST['nipbaru'];
    if ($niplama == $nipbaru) {
        $nip = $niplama;
    } else {
        $nip = $nipbaru;
    }
    $nama = $_POST["nama"];
    $jurusan = $_POST["jurusan"];
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
            echo '<script>window.location="../dosen";</script>';
        }
    }

    if ($nama_gambar == '') {
        $tgl_lahir =  ($tanggal_lahir == NULL ? "NULL" : "'$tanggal_lahir'");
        $update = mysqli_query($conn, "UPDATE tb_dosen SET nip='$nip', nama_dosen='$nama', jurusan = '$jurusan', prodi='$prodi', alamat='$alamat', tgl_lahir=" . ($tanggal_lahir == NULL ? "NULL" : "'$tanggal_lahir'") . ", tempat_lahir='$tempat_lahir' WHERE nip = '$niplama'");
    } else {
        $ukuran_gambar = $_FILES['gambar']['size'];
        if ($ukuran_gambar < 2044070) {
            $file_tmp = $_FILES['gambar']['tmp_name'];
            $sql = mysqli_query($conn, "SELECT gambar FROM tb_dosen WHERE nip = '$niplama'");
            $update = mysqli_query($conn, "UPDATE tb_dosen SET nip='$nip', nama_dosen='$nama', jurusan='$jurusan', prodi='$prodi', alamat='$alamat', tgl_lahir=" . ($tanggal_lahir == NULL ? "NULL" : "'$tanggal_lahir'") . ", tempat_lahir='$tempat_lahir', gambar = '$nama_gambar' WHERE nip = '$niplama'");
        } else {
            echo '<script>alert("Ukuran gambar melebihi 2Mb, tolong kecilkan ukurannya");</script>';
            echo '<script>window.location="../dosen";</script>';
        }
    }

    if ($update) {
        if (isset($sql)) {
            $hasil = mysqli_fetch_array($sql);

            if ($hasil['gambar'] != '') {
                unlink('../images/dosen/' . $hasil['gambar']);
            }
            move_uploaded_file($file_tmp, '../images/dosen/' . $nama_gambar);
        }
        echo '<script>alert("EDIT data berhasil");</script>';
        echo '<script>window.location="../dosen";</script>';
    } else {
        echo '<script>alert("Edit data tidak berhasil, mohon kontak admin");</script>';
        echo '<script>window.location="../dosen";</script>';
    }
} else {
    echo '<script>alert("Edit data tidak berhasil, mohon kontak admin");</script>';
    echo '<script>window.location="../dosen";</script>';
}