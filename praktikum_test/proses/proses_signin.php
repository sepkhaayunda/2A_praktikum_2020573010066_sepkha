<?php

require "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
$hasil =mysqli_query($conn, "select * from tb_user WHERE username = '$username' AND password ='$password'");

$row =mysqli_fetch_array($hasil);
if ($hasil) {
    if (isset($row['username']) && isset($row['password']) && $row['username'] == $username && $row['password'] == $password) {
        echo "username ada";
    } else {
        echo "<script> 
        alert ('Mohon maaf username atau password yang anda masukkan salah')
        </script>";
        header("Location: ../project.php");       
    }
} else {
    echo "terjadi kesalahan";
}
?>