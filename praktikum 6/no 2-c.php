<!DOCTYPE html>
<html>
<head>
    <title>Koneksi Database MySQL</title>
</head>
<body>
    <h1>Koneksi database dengan MySQL_fetch_array</h1>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "tabel_praktikum6")
                or die ("Koneksi gagal");
        $hasil = mysqli_query($conn, "select * from liga");
        while ($row = mysqli_fetch_array($hasil)){
            echo "Liga " . $row["negara"]; //array asosiatif
            echo " mempunyai " . $row[2]; //array numeris
            echo " wakil di liga champion <br>";
        }
    ?>
</body>
</html>