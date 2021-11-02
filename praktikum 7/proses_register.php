<!DOCTYPE html>
<html>
<head>
    <title>Data user</title>
</head>
<body>
    <h1>Data user</h1>
    <?php
        $username     = $_POST["username"];
        $password     = $_POST["password"];
        $upassword    = $_POST["upassword"];
        $nama         = $_POST["nama"];
        $tempat_lahir = $_POST["tempat_lahir"];
        $tgl_lahir    = $_POST["tgl_lahir"];
        $alamat       = $_POST["alamat"];
        $conn=mysqli_connect("localhost", "root", "", "db_praktikum_7")
        or die ("Koneksi gagal");
        if ($password != $upassword){
            echo "Password tidak sama";
        }
        else {
            echo "Username        : $username <br>";
            echo "password        : $password <br>";
            echo "Ulangi password : $upassword <br>";
            echo "Nama            : $nama <br>";
            echo "Tempat lahir    : $tempat_lahir <br>";
            echo "Tanggal lahir   : $tgl_lahir <br>";
            echo "Alamat          : $alamat <br>";
        
        $sqlstr="insert into user(username,password,nama,tempat_lahir,tgl_lahir,alamat)
        values ('$username', '$password', '$nama', '$tempat_lahir', '$tgl_lahir', '$alamat')";
        $hasil = mysqli_query($conn,$sqlstr);
        echo "Simpan data user berhasil dilakukan";
        }
    ?>
</body>
</html>