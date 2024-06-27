<!DOCTYPE html>
<html>
<head>
    <title>Update Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="logooo.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .form-box {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            width: 50%;
            border-radius: 25px;
        }
    </style>
</head>
<body>
<div class="container">

    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if (isset($_GET['kode_barang'])) {
        $kode_barang=input($_GET["kode_barang"]);

        $sql="select * from toko where kode_barang=$kode_barang";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);

        $kode_barang = $data['kode_barang'];
        $nama_barang = $data['nama_barang'];
        $persediaan = $data['persediaan'];
        $harga_awal = $data['harga_awal'];
        $jumlah = $data['jumlah'];

    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $kode_barang=htmlspecialchars($_POST["kode_barang"]);
        $nama_barang=input($_POST["nama_barang"]);
        $persediaan=input($_POST["persediaan"]);
        $harga_awal=input($_POST["harga_awal"]);
        $jumlah=input($_POST["jumlah"]);


        $sql="update mahasiswa set
			kode_barang='$kode_barang',
			nama_barang='$nama_barang',
			persediaan='$persediaan',
			harga_awal='$harga_awal',
			jumlah='$jumlah'
			where kode_barang=$kode_barang";

        $hasil=mysqli_query($kon,$sql);

        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>"; 

        }

    }

    ?>

    <div style="margin-top: 100px; animation: fadeIn 1s;" class="form-box">
        <h2 style="text-align:center" class="my-4">Update Data</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
                <label for="kode_barang" class="form-label"><font size="4">Kode Barang :</font></label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?php echo $kode_barang; ?>" placeholder="Masukan Kode Barang" required>
            </div>
            <div class="form-group">
                <label for="nama_barang" class="form-label"><font size="4">Nama Barang :</font></label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $nama_barang; ?>" placeholder="Masukan Nama Barang" required>
            </div>
            <div class="form-group">
                <label for="persediaan" class="form-label"><font size="4">Persediaan :</font></label>
                <input type="text" class="form-control" id="persediaan" name="persediaan" value="<?php echo $persediaan; ?>" placeholder="Jumlah Persediaan" required>
            </div>
            <div class="form-group">
                <label for="harga_awal" class="form-label"><font size="4">Harga Awal :</font></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control" id="harga_awal" name="harga_awal" value="<?php echo $harga_awal; ?>" placeholder="Masukan Harga Barang" required>
                </div>
            </div>
            <div class="form-group">
                <label for="jumlah" class="form-label"><font size="4">Jumlah :</font></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah; ?>" placeholder="Masukan Keseluruhan Harga" required>
                </div>
            </div>

        <input type="hidden" name="kode_barang" value="<?php echo $data['kode_barang']; ?>" />

        <button type="submit" name="submit" style="margin-top: 12px; margin-right: 10px; border-radius: 12px;" class="btn btn-primary">Update</button>
        <a href="index.php" style="margin-top: 12px; border-radius: 12px;" class="btn btn-primary" role="button">Cancel</a>
    </form>
    </div>
</div>
</body>
</html>