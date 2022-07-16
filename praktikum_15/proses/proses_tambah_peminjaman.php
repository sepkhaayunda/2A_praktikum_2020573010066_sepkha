<?php
if (isset($_POST['pinjam'])) {

    if ($_POST['waktu_pengembalian'] != "") {
        require "koneksi.php";
        require "session.php";
        $brg = $_POST['brg'];

        // cek apakah barang apakah sudah di pinjam atau belum, status 2 menandakan barang tersebut sudah dipinjam
        $select_id_barang = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE barang = '$brg' && (status = '2')");
        $hasil_barang = mysqli_fetch_array($select_id_barang);

        if (isset($hasil_barang['barang'])) {
            echo '<script>alert("Peminjaman barang gagal, barang sudah di pinjam");</script>';
            echo '<script>window.location="../pinjam";</script>';
        } else {
            $mk = $_POST['mk'];
            $username = $_SESSION['username'];

            //ambil id_user dari tabel tb_user
            $select_id_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

            if ($select_id_user) {
                $hasil_id = mysqli_fetch_array($select_id_user);
                $id = $hasil_id['id'];
                $waktu_pengembalian = $_POST['waktu_pengembalian'];

                $pinjam = mysqli_query($conn, "INSERT INTO tb_peminjaman(barang, user, status, waktu_pengembalian, mata_kuliah) VALUES ('$brg', '$id', '1', '$waktu_pengembalian', '$mk')");

                if ($pinjam) {
                    echo '<script>alert("Peminjaman barang berhasil");</script>';
                    echo '<script>window.location="../pinjam";</script>';
                } else {
                    echo '<script>alert("Peminjaman barang gagal, mohon kontak admin");</script>';
                    echo '<script>window.location="../pinjam";</script>';
                }
            } else {
                echo '<script>alert("Peminjaman barang gagal, mohon kontak admin");</script>';
                echo '<script>window.location="../pinjam";</script>';
            }
        }
    } else {
        echo '<script>alert("Waktu Pengembalian harus diisi");</script>';
        echo '<script>window.location="../pinjam";</script>';
    }
} else {
    echo '<script>alert("Peminjaman barang gagal, mohon kontak admin");</script>';
    echo '<script>window.location="../pinjam";</script>';
}