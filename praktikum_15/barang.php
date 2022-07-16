<?php
require "proses/session.php";
require "proses/koneksi.php";

$select = mysqli_query($conn, "SELECT * FROM tb_barang");

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
        <div class="row">
            <div class="col-3">
                <!-- sidebar -->
                <?php require "sidebar.php"; ?>
                <!-- akhir sidebar -->
            </div>

            <!-- isi konten -->
            <div class="col-9">
                <div class="card">
                    <h5 class="card-header">Data Barang</h5>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-3 mt-2" data-bs-toggle="modal"
                            data-bs-target="#ModalTambah">Tambah Data Barang</button>
                        <!-- modal tambah -->
                        <div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="proses/proses_tambah_barang.php" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" name="kode_barang"
                                                    id="floatingInput" autofocus>
                                                <label for="floatingInput">Kode Barang</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nm-brg" id="floatingInput"
                                                    autofocus>
                                                <label for="floatingInput">Nama Barang</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="ket"
                                                    id="floatingPassword">
                                                <label for="floatingPassword">Keterangan</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" name="stok"
                                                    id="floatingPassword">
                                                <label for="floatingPassword">Stok</label>
                                            </div>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="inputGroupFile02"
                                                    name="gambar">
                                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary" name="tambah" value="Tambah">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- akhir modal tambah -->

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                while ($query = mysqli_fetch_array($select)) {
                                    $no++;
                                ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><?= $query['kode_barang'] ?></td>
                                    <td><img src="<?= "images/barang/" . $query['gambar_barang']; ?>" width="100"
                                            height="100" class="rounded mb-1" alt="..."></td>
                                    <td><?= $query['nama_barang'] ?></td>
                                    <td><?= $query['keterangan'] ?></td>
                                    <td><?= $query['stok'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" name="edit" data-bs-toggle="modal"
                                            data-bs-target="#ModalEdit<?= $query['kode_barang']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                        </button>
                                        <button type="button" class="btn btn-danger" name="delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ModalDelete<?= $query['kode_barang']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-file-earmark-x" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146z" />
                                                <path
                                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                            </svg>
                                        </button>
                                    </td>
                                    <!-- modal edit -->
                                    <div class="modal fade" id="ModalEdit<?= $query['kode_barang']; ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="proses/proses_edit_barang.php" method="POST"
                                                        enctype="multipart/form-data">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="kd-brg"
                                                                id="floatingInput" value="<?= $query['kode_barang'] ?>"
                                                                readonly>
                                                            <label for="floatingInput">Kode Barang</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="nm-brg"
                                                                id="floatingInput" value="<?= $query['nama_barang'] ?>"
                                                                autofocus>
                                                            <label for="floatingInput">Nama Barang</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" name="ket"
                                                                id="floatingPassword"
                                                                value="<?= $query['keterangan'] ?>">
                                                            <label for="floatingPassword">Keterangan</label>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="number" class="form-control" name="stok"
                                                                id="floatingPassword" value="<?= $query['stok'] ?>">
                                                            <label for="floatingPassword">Stok</label>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <input type="file" class="form-control"
                                                                id="inputGroupFile02" name="gambar">
                                                            <label class="input-group-text"
                                                                for="inputGroupFile02">Upload</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <input type="submit" class="btn btn-primary" name="edit"
                                                                value="EDIT">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- akhir modal edit -->

                                    <!-- modal hapus -->
                                    <div class="modal fade" id="ModalDelete<?= $query['kode_barang']; ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="proses/proses_hapus_barang.php" method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="kode_barang"
                                                            value="<?= $query['kode_barang'] ?>">
                                                        <input type="hidden" name="gambar"
                                                            value="<?= $query['gambar_barang'] ?>">
                                                        <p style="color: red;">Apakah anda akan menghapus data
                                                            "<?= $query['nama_barang']; ?>" ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-secondary" name="hapus"
                                                            value="Delete">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- akhir modal hapus -->
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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