<!DOCTYPE html>
<html>
<head>
    <title>Simpan buku tamu</title>
</head>
<body>
    <h1>Simpan Buku Tamu MySQL</h1>
    <?php 
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $komentar = $_POST["komentar"];
        $conn=mysqli_connect("localhost", "root", "", "tabel_praktikum6")
        or die ("Koneksi gagal");
        echo "Nama     : $nama <br>";
        echo "Email    : $email <br>";
        echo "Komentar : $komentar <br>";
        $sqlstr="insert into bukutamu(nama,email,komentar)
        values ('$nama', '$email', '$komentar')";
        $hasil = mysqli_query($conn,$sqlstr);
        echo "Simpan bukutamu berhasil dilakukan";
    ?>
</body>
</html>