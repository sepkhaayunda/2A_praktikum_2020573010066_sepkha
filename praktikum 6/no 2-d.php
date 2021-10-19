<!DOCTYPE html>
<html>
<head>
    <title>koneksi Database MySQL</title>
</head>
<body>
    <h1>Koneksi database dengan mysql_fetch_assoc</h1>
    <?php
          $conn = mysqli_connect("localhost", "root", "", "tabel_praktikum6")
          or die ("Koneksi gagal");
    $hasil = mysqli_query($conn, "select * from liga");
    while ($row = mysqli_fetch_array($hasil)){
      echo "Liga " . $row["negara"]; 
      echo " mempunyai " .$row["champion"]; 
      echo " wakil di liga champion <br>";
  }
    ?>
</body>
</html> 