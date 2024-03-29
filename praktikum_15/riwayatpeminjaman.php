<?php
require "proses/session.php";
require "proses/koneksi.php";

//query untuk tabel data peminjaman user
$select = mysqli_query(
    $conn,
    "SELECT *
    FROM tb_peminjaman PEM
    LEFT JOIN tb_barang BRG ON PEM.barang = BRG.kode_barang
    LEFT JOIN tb_matakuliah MK ON PEM.mata_kuliah = MK.kode_matakuliah
    LEFT JOIN tb_dosen DSN ON MK.dosen = DSN.nip
    LEFT JOIN tb_user USR ON USR.id = PEM.user
    WHERE PEM.status = 3 || status = 4
    ORDER BY PEM.waktu_peminjaman
    "
);

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
                    <h5 class="card-header">Data Peminjaman</h5>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Waktu Peminjaman</th>
                                    <th scope="col">Waktu Pengembalian</th>
                                    <th scope="col">Mata Kuliah</th>
                                    <th scope="col">Status</th>
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
                                    <td><?= date("d-m-Y H:i:s", strtotime($query['waktu_peminjaman'])) ?>
                                    </td>
                                    <td><?= date("d-m-Y H:i:s", strtotime($query['waktu_pengembalian'])) ?>
                                    </td>
                                    <td><?= $query['nm_matakuliah'] . "-" . $query['nama_dosen'] ?></td>
                                    <td>
                                        <?php
                                            if ($query['status'] == 1) echo "<span class='badge bg-secondary'>Pending</span>";
                                            elseif ($query['status'] == 2) echo "<span class='badge bg-success'>Disetujui</span>";
                                            elseif ($query['status'] == 3) echo "<span class='badge bg-danger'>Ditolak</span>";
                                            elseif ($query['status'] == 4) echo "<span class='badge bg-primary'>Telah</span><span class='badge bg-primary'> dikembalikan</span>";
                                            elseif ($query['status'] == 5) echo "<span class='badge bg-warning'>Proses</span><span class='badge bg-warning'> dikembalikan</span>";
                                            ?>
                                    </td>
                                    <td>
                                        <?php if ($query['status'] == 1) { ?>
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
                                        <?php } elseif ($query['status'] == 2) { ?>
                                        <button type="button" class="btn btn-success" name="kembalikan"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ModalKembalikan<?= $query['kode_barang']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-shift" viewBox="0 0 16 16">
                                                <path
                                                    d="M7.27 2.047a1 1 0 0 1 1.46 0l6.345 6.77c.6.638.146 1.683-.73 1.683H11.5v3a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-3H1.654C.78 10.5.326 9.455.924 8.816L7.27 2.047zM14.346 9.5 8 2.731 1.654 9.5H4.5a1 1 0 0 1 1 1v3h5v-3a1 1 0 0 1 1-1h2.846z" />
                                            </svg>
                                        </button>
                                        <?php } elseif ($query['status'] == 3) { ?>
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
                                        <?php } elseif ($query['status'] == 5) { ?>
                                        <button type="button" class="btn btn-danger" name="proses_kembalikan"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ModalProsesKembalikan<?= $query['kode_barang']; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                            </svg>
                                        </button>
                                        <?php } ?>
                                    </td>

                                    <!-- modal edit -->
                                    <div class="modal fade" id="ModalEdit<?= $query['kode_barang']; ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Peminjaman</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="proses/proses_edit_peminjaman.php" method="POST"
                                                        enctype="multipart/form-data">
                                                        <div class="barang">
                                                            <label for="level" class="form-label">Nama Barang</label>
                                                            <select class="form-select mb-3"
                                                                aria-label="Default select example" id="barang"
                                                                name="brg" required>
                                                                <?php
                                                                    $barang = mysqli_query($conn, "SELECT * FROM tb_barang");
                                                                    while ($hasil = mysqli_fetch_array($barang)) {
                                                                    ?>
                                                                <option value="<?= $hasil['kode_barang'] ?>">
                                                                    <?= $hasil['kode_barang'] . " " . $hasil['nama_barang'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="matakuliah">
                                                            <label for="matakuliah" class="form-label">Mata
                                                                Kuliah</label>
                                                            <select class="form-select mb-3"
                                                                aria-label="Default select example" id="matakuliah"
                                                                name="mk" required>
                                                                <?php
                                                                    $matakuliah = mysqli_query(
                                                                        $conn,
                                                                        "SELECT * FROM tb_matakuliah MTK
                                                        LEFT JOIN tb_dosen DSN ON MTK.dosen = DSN.nip"
                                                                    );
                                                                    while ($hasil = mysqli_fetch_array($matakuliah)) {
                                                                    ?>
                                                                <option value="<?= $hasil['kode_matakuliah'] ?>">
                                                                    <?= $hasil['kode_matakuliah'] . " " . $hasil['nm_matakuliah'] . " - " . $hasil['nama_dosen'] ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="datetime-local" class="form-control"
                                                                name="wkt_kembali" id="floatingInput"
                                                                value="<?= date("Y-m-d\TH:i:s", strtotime($query['waktu_pengembalian'])) ?>">
                                                            <label for="floatingInput">Waktu Pengembalian</label>
                                                        </div>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Penghapusan Peminjaman</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="proses/proses_hapus_peminjaman.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="kode_barang" value="<?= $query['kode_barang'] ?>">
                                        <input type="hidden" name="gambar" value="<?= $query['gambar_barang'] ?>">
                                        <p style="color: red;">Apakah anda akan menghapus data
                                            "<?= $query['nama_barang']; ?>" ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-secondary" name="hapus" value="Delete">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- akhir modal hapus -->

                    <!-- modal setujui -->
                    <div class="modal fade" id="ModalSetujui<?= $query['kode_barang']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Persetujuan Peminjaman Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="proses/proses_setujui_peminjaman.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" value="<?= $query['id_peminjaman'] ?>"
                                            name="id_peminjaman">
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="nama_barang"
                                                id="floatingInput"
                                                value="<?= $query['kode_barang'] . " - " . $query['nama_barang'] ?>"
                                                disabled>
                                            <label for="floatingInput">Kode - Nama Barang</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="text" class="form-control" name="kode_barang"
                                                id="floatingInput"
                                                value="<?= $query['nm_matakuliah'] . " - " . $query['nama_dosen'] ?>"
                                                disabled>
                                            <label for="floatingInput">Mata Kuliah - Nama Dosen</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="datetime-local" class="form-control" name="wkt_kembali"
                                                id="floatingInput"
                                                value="<?= date("Y-m-d\TH:i:s", strtotime($query['waktu_peminjaman'])) ?>"
                                                disabled>
                                            <label for="floatingInput">Waktu Peminjaman</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <input type="datetime-local" class="form-control" name="wkt_kembali"
                                                id="floatingInput"
                                                value="<?= date("Y-m-d\TH:i:s", strtotime($query['waktu_pengembalian'])) ?>"
                                                disabled>
                                            <label for="floatingInput">Waktu Pengembalian</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <select class="form-select mb-3" aria-label="Default select example"
                                                id="aksi" name="aksi">
                                                <option value="2">Setujui</option>
                                                <option value="3">Tolak</option>
                                            </select>
                                            <label for="aksi" class="form-label">Aksi</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-danger" name="setuju/tolak" value="Simpan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- akhir modal setujui -->

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