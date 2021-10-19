<html>
    <head>
        <title>Koneksi Database MysQL</title>
    </head>
    <body>
        <h1>Demo koneksi database MysQL</h1>
    <?php
        $conn=mysqli_connect ("localhost","root", "") ;
        if ($conn){
        echo "server terkoneksi";
        } else{
        echo "Server tidak terkoneksi" ;
        }
    ?>
    </body>
</html>