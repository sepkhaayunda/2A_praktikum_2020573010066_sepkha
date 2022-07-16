<?php
require "session.php";

if (isset($_POST['tambah'])) {
    require "koneksi.php";
    $ukuran_gambar = $_FILES['gambar']['size'];

    if ($ukuran_gambar < 2044070) {
        $nip = $_POST["nip"];
        $level = $_POST["level"];

        if ($nip != "" and $level != "") {
            $cek = mysqli_query($conn, "SELECT * FROM tb_dosen WHERE nip = '$nip'");
            $hasil = mysqli_fetch_array($cek);

            if (isset($hasil['nip'])) {
                echo '<script>alert("Data nip yang anda masukkan sudah ada");</script>';
                echo '<script>window.location="../dosen ";</script>';
            } else {
                $nip_md5 = md5($nip);
                $tambah_user = mysqli_query($conn, "INSERT INTO tb_user (username, password, level) VALUES ('$nip', '$nip_md5', '$level')");

                if ($tambah_user) {
                    $cek_id = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$nip'");

                    if ($cek_id) {
                        $hasil = mysqli_fetch_array($cek_id);
                        $id_user = $hasil['id'];

                        $nama = $_POST["nama"];
                        $jurusan = $_POST["jurusan"];
                        $prodi = $_POST["prodi"];
                        $alamat = $_POST["alamat"];
                        $tanggal_lahir = $_POST["tanggal_lahir"];
                        $tempat_lahir = $_POST["tempat_lahir"];
                        $nama_gambar = $_FILES['gambar']['name'];
                        $file_tmp = $_FILES['gambar']['tmp_name'];

                        $tambah_dosen = mysqli_query($conn, "INSERT INTO `tb_dosen` (`nip`, `id_user`, `nama_dosen`, `jurusan`, `prodi`, `alamat`, `tgl_lahir`, `tempat_lahir`, `gambar`) VALUES ('$nip', '$id_user', '$nama', '$jurusan', '$prodi', '$alamat', " . ($tanggal_lahir == NULL ? "NULL" : "'$tanggal_lahir'") . ", '$tempat_lahir', '$nama_gambar')");

                        if ($tambah_dosen) {
                            move_uploaded_file($file_tmp, '../images/dosen/' . $nama_gambar);
                            echo '<script>alert("Penambahan data berhasil");</script>';
                            echo '<script>window.location="../dosen";</script>';
                        } else {
                            echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
                            echo '<script>window.location="../dosen";</script>';
                        }
                    } else {
                        echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
                        echo '<script>window.location="../dosen";</script>';
                    }
                } else {
                    echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
                    echo '<script>window.location="../dosen";</script>';
                }
            }
        } else {
            echo '<script>alert("nip dan Level harus diisi");</script>';
            echo '<script>window.location="../dosen";</script>';
        }
    } else {
        echo '<script>alert("Ukuran gambar melebihi 1MB, mohon kecilkan ukuran gambar dan mengulangi proses tambah data barang");</script>';
        echo '<script>window.location="../dosen";</script>';
    }
} else {
    echo '<script>alert("Penambahan data gagal, mohon kontak admin");</script>';
    echo '<script>window.location="../dosen";</script>';
}