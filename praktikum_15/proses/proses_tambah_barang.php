<?php
require "session.php";

if (isset($_POST['tambah'])) {
    require "koneksi.php";
    $ukuran_gambar = $_FILES['gambar']['size'];

    if ($ukuran_gambar < 2044070) {
        $kode_barang = $_POST['kode_barang'];
        $nm_brg = $_POST['nm-brg'];
        $ket = $_POST['ket'];

        // operator ternary
        ($_POST['stok'] > 0) ? $stok = $_POST['stok'] : $stok = 0;

        $nama_gambar = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];

        if ($kode_barang != "") {
            $cek = mysqli_query($conn, "SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'");
            $hasil = mysqli_fetch_array($cek);

            if (isset($hasil['kode_barang'])) {
                echo '<script>alert("Data kode barang sudah ada");</script>';
                echo '<script>window.location="../barang";</script>';
            } else {
                $tambah = mysqli_query($conn, "INSERT INTO tb_barang VALUES ('$kode_barang', '$nm_brg', '$ket', '$nama_gambar', $stok)");

                if ($tambah) {
                    move_uploaded_file($file_tmp, '../images/barang/' . $nama_gambar);
                    echo '<script>alert("Penambahan data berhasil");</script>';
                    echo '<script>window.location="../barang";</script>';
                } else {
                    echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
                    echo '<script>window.location="../barang";</script>';
                }
            }
        } else {
            echo '<script>alert("Kode barang harus diisi");</script>';
            echo '<script>window.location="../barang";</script>';
        }
    } else {
        echo '<script>alert("Ukuran gambar melebihi 1MB, mohon kecilkan ukuran gambar dan mengulangi proses tambah data barang");</script>';
        echo '<script>window.location="../barang";</script>';
    }
} else {
    echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
    echo '<script>window.location="../barang";</script>';
}