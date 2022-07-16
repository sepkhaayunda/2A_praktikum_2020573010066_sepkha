<?php
require "proses/session.php";
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">

    <title>SIPBAR - Sistem Informasi Peminjaman Barang Jurusan TIK</title>
</head>

<body>
    <div class="container-fluid bg-light" >

        <!-- Navbar header -->
        <?php require "header.php"; ?>
        <!-- akhir header -->
    </div>

    <div class="container-fluid bg-light" >
        <div class="row me-3">
            <div class="col-3">
                <!-- sidebar -->
                <?php require "sidebar.php"; ?>
                <!-- akhir sidebar -->
            </div>

            <!-- isi konten -->
            <div class="col-9" >
                <div class="card ms-1 mt-4" style="background-color:#ECD4FF;">
                    <h5 class="card-header">Sistem Informasi Peminjaman Barang Jurusan TIK</h5>
                    <div class="card-body">
                        <h5 class="card-title">Selamat Datang!</h5>
                        <p class="card-text">Lakukan Peminjaman Barang dengan cara yang lebih cepat.</p>
                        <a href="#" class="btn btn-primary" style="background-color:#D8BFD8;">Click here!</a>
                        <?= $_SESSION['username']; ?>
                    </div>
                </div>
            </div>
            <!-- akhir isi konten -->
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebars.js"></script>
</body>

</html>