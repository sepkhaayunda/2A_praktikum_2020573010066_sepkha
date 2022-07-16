<?php
require "proses/session.php";
require "proses/koneksi.php";

$sql = mysqli_query(
    $conn,
    "SELECT * 
    FROM tb_user usr
    LEFT JOIN tb_mahasiswa mhs ON usr.id = mhs.id_user
    WHERE username = '$_SESSION[username]'"
);

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
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="<?= $data['username'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nim</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    value="<?= $data['nim'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">id_user</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    value="<?= $data['id_user'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    value="<?= $data['nama_mahasiswa'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    value="<?= $data['kelas'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Prodi</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    value="<?= $data['prodi'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    value="<?= $data['alamat'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    value="<?= $data['tgl_lahir'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="exampleInputPassword1"
                                    value="<?= $data['tempat_lahir'] ?>" disabled>
                            </div>
                            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                        </form>
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