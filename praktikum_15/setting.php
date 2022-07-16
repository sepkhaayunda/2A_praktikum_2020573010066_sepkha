<?php
require "proses/session.php";
require "proses/koneksi.php";

$sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username]'");
$data = mysqli_fetch_array($sql);

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
    <div class="container-fluid bg-light">

        <!-- Navbar header -->
        <?php require "header.php"; ?>
        <!-- akhir header -->
    </div>

    <div class="container-fluid bg-light">
        <div class="row me-3">
            <div class="col-3">
                <!-- sidebar -->
                <?php require "sidebar.php"; ?>
                <!-- akhir sidebar -->
            </div>

            <!-- isi konten -->
            <div class="col-9">
                <div class="card">
                    <h5 class="card-header">Profile</h5>
                    <div class="card-body">
                        <form action="proses/proses_password.php" method="POST">
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Password
                                                    Lama</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                    name="ulangpasswordlama" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword2" class="form-label">Password
                                                    Baru</label>
                                                <input type="password" class="form-control" id="exampleInputPassword2"
                                                    name="passwordbaru" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword3" class="form-label">Ulang Password
                                                    Baru</label>
                                                <input type="password" class="form-control" id="exampleInputPassword3"
                                                    name="ulangpasswordbaru" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                            <input type="submit" class="btn btn-primary" value="Ganti" name="ganti">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir modal -->

                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleInputUsername1"
                                    aria-describedby="emailHelp" name="username" value="<?= $data['username'] ?>"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword4" class="form-label">Password</label>
                                <input type="password" name="passwordlama" class="form-control"
                                    id="exampleInputPassword4" value="<?= $data['password']; ?>" readonly>
                            </div>
                        </form>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Ganti Password
                        </button>
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