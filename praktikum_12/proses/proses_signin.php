<?php
require "koneksi.php";
session_start();
$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM tb_user WHERE username = '$username' and password ='$password'";
$hasil = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($hasil);
if ($hasil) {
    if (isset($row['username']) && isset($row['password']) && $row['username'] == $username && $row['password'] == $password) {
        $_SESSION['username'] = $username;
        // header("refresh:0;url=../home.php");
        echo '<script>window.location="../home.php";</script>';
    } else {
        // header("refresh:0;url=../sign-in/home.php");
        echo '<script>alert("Mohon maaf username atau password yang anda masukkan salah");</script>';
        echo '<script>window.location="../sign-in";</script>';
    }
}
