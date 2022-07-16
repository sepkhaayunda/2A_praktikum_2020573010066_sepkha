<?php
require "session.php";
if (isset($_POST['ganti'])) {
    require "koneksi.php";
    $passwordLama = $_POST['passwordlama'];
    $ulangPasswordLama = md5($_POST['ulangpasswordlama']);

    if ($passwordLama == $ulangPasswordLama) {
        $passwordBaru = md5($_POST['passwordbaru']);
        $ulangPasswordBaru = md5($_POST['ulangpasswordbaru']);

        if ($passwordBaru == $ulangPasswordBaru) {
            $username = $_POST['username'];
            $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
            $hasil = mysqli_fetch_array($sql);

            if ($passwordBaru == $hasil['password']) {
                echo '<script>alert("Password baru yang anda masukkan sama dengan password lama, mohon masukkan password yang berbeda");</script>';
                echo '<script>window.location="../setting";</script>';
            } else {
                if ($hasil['username'] == $username) {
                    $update = mysqli_query($conn, "UPDATE tb_user SET password = '$passwordBaru' WHERE username = '$username'");
                }

                if ($update) {
                    echo '<script>alert("Penggantian password berhasil");</script>';
                    echo '<script>window.location="../setting";</script>';
                } else {
                    echo '<script>alert("Pengantian password gagal, mohon kontak admin");</script>';
                    echo '<script>window.location="../setting";</script>';
                }
            }
        } else {
            echo '<script>alert("Password baru tidak sama dengan ulang password baru");</script>';
            echo '<script>window.location="../setting";</script>';
        }
    } else {
        echo '<script>alert("Password lama yang anda masukkan salah");</script>';
        echo '<script>window.location="../setting";</script>';
    }
} else {
    echo '<script>window.location="../setting";</script>';
}