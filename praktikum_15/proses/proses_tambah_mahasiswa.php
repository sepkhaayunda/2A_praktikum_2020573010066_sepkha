<?php
require "session.php";

if (isset($_POST['tambah'])) {
    require "koneksi.php";
    $ukuran_gambar = $_FILES['gambar']['size'];

    if ($ukuran_gambar < 2044070) {
        $nim = $_POST["nim"];
        $level = $_POST["level"];

        if ($nim != "" and $level != "") {
            $cek = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE nim = '$nim'");
            $hasil = mysqli_fetch_array($cek);

            if (isset($hasil['nim'])) {
                echo '<script>alert("Data NIM yang anda masukkan sudah ada");</script>';
                echo '<script>window.location="../mahasiswa ";</script>';
            } else {
                $nim_md5 = md5($nim);
                $tambah_user = mysqli_query($conn, "INSERT INTO tb_user (username, password, level) VALUES ('$nim', '$nim_md5', '$level')");

                if ($tambah_user) {
                    $cek_id = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$nim'");

                    if ($cek_id) {
                        $hasil = mysqli_fetch_array($cek_id);
                        $id_user = $hasil['id'];

                        $nama = $_POST["nama"];
                        $kelas = $_POST["kelas"];
                        $prodi = $_POST["prodi"];
                        $alamat = $_POST["alamat"];
                        $tanggal_lahir = $_POST["tanggal_lahir"];
                        $tempat_lahir = $_POST["tempat_lahir"];
                        $nama_gambar = $_FILES['gambar']['name'];
                        $file_tmp = $_FILES['gambar']['tmp_name'];

                        $tambah_mahasiswa = mysqli_query($conn, "INSERT INTO tb_mahasiswa (nim, id_user, nama_mahasiswa, kelas, prodi, alamat, tgl_lahir, tempat_lahir, gambar) VALUES ('$nim', '$id_user', '$nama', '$kelas', '$prodi', '$alamat', " . ($tanggal_lahir == NULL ? "NULL" : "'$tanggal_lahir'") . ", '$tempat_lahir', '$nama_gambar')");

                        if ($tambah_mahasiswa) {
                            move_uploaded_file($file_tmp, '../images/mahasiswa/' . $nama_gambar);
                            echo '<script>alert("Penambahan data berhasil");</script>';
                            echo '<script>window.location="../mahasiswa";</script>';
                        } else {
                            echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
                            echo '<script>window.location="../mahasiswa";</script>';
                        }
                    } else {
                        echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
                        echo '<script>window.location="../mahasiswa";</script>';
                    }
                } else {
                    echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
                    echo '<script>window.location="../mahasiswa";</script>';
                }
            }
        } else {
            echo '<script>alert("NIM dan Level harus diisi");</script>';
            echo '<script>window.location="../mahasiswa";</script>';
        }
    } else {
        echo '<script>alert("Ukuran gambar melebihi 1MB, mohon kecilkan ukuran gambar dan mengulangi proses tambah data barang");</script>';
        echo '<script>window.location="../mahasiswa";</script>';
    }
} else {
    echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
    echo '<script>window.location="../mahasiswa";</script>';
}