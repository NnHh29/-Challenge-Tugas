<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="icon" type="image/png" href="logooo.png">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<title>Barang</title>
<body>
    <nav class="navbar navbar-expand navbar-dark sticky-top" style="background-color: <?php echo '#424242';?>;">
        <span class="navbar-brand mb-0 h1 typing-text">Toko Nabil Huda</span>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="insert.php" style="margin-right: 12px; margin-top: 5px; margin-bottom: 5px; border-radius: 10px; padding: 10px 20px; font-size: 14px; font-weight: bold; background-color: #424242; color: #ffffff; border: 1px solid #777777; cursor: pointer; transition: background-image 0.3s ease-in-out;" class="btn" role="button">Input Data</a>
            </li>
        </ul>
    </nav>
<div class="container" style="margin-bottom: 20px;">
    <br>
    <?php
    echo '<h4 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); font-size: 33px;"><center>Tabel Barang</center></h4>';
    ?>
<?php

    include "koneksi.php";

    if (isset($_GET['kode_barang'])) {
        $kode_barang=htmlspecialchars($_GET["kode_barang"]);

        $sql="delete from toko where kode_barang='$kode_barang' ";
        $hasil=mysqli_query($kon,$sql);

            if ($hasil) {
                header("Location:index.php");
            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>

<style>
  #mahasiswa-table {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
  }
</style>
    
     <tr class="table-danger">
            <br>
        <thead>
        <tr>
        <table id="mahasiswa-table" class="my- table table-bordered text-center" style="border-width: 2px; animation: fadeIn 1s;">
            <tr style="background-image: linear-gradient(to bottom, <?php echo '#525252';?>, <?php echo '#050505';?>); color: white;">      
                <th style="<?php echo 'padding: 10px;'?>">Kode Barang</th>
                <th style="<?php echo 'padding: 10px;'?>">Nama Barang</th>
                <th style="<?php echo 'padding: 10px;'?>">Persediaan</th>
                <th style="<?php echo 'padding: 10px;'?>">Harga Awal</th>
                <th style="<?php echo 'padding: 10px;'?>">Jumlah</th>
                <th colspan='2' style="<?php echo 'padding: 10px;'?>">Tindakan</th>

            </tr>
        </thead>

        <?php
        include "koneksi.php";
        $sql="select * from toko order by kode_barang asc";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $data["kode_barang"]; ?></td>
                <td><?php echo $data["nama_barang"];   ?></td>
                <td><?php echo $data["persediaan"];   ?></td>
                <td><?php echo 'Rp   ' .  $data["harga_awal"];   ?></td>
                <td><?php echo 'Rp   ' .  $data["jumlah"];   ?></td>
                <td>
                    <a href="update.php?kode_barang=<?php echo htmlspecialchars($data['kode_barang']);?>" style="width: 60px; height: 26px; border-radius: 10px; padding: 0 5px 20px; font-size: 15px; background-color: #777777; color: #ffffff; border: 1px solid #4ebad4; cursor: pointer; transition: background-image 0.3s ease-in-out;" class="btn btn-warning" role="button">Update</a>
                    <a href="#" onclick="return confirmDelete(<?php echo $data['kode_barang'];?>)" style="width: 60px; height: 26px; border-radius: 10px; padding: 0 5px 20px; font-size: 15px; background-color: #AD0000; color: #ffffff; border: 1px solid #4ebad4; cursor: pointer; transition: background-image 0.3s ease-in-out;" class="btn btn-danger" role="button">Delete</a>
                </td>

                <script>    
                    function confirmDelete(id) {
                        if (confirm("Anda ingin menghapus data ini? Pilih OK")) {
                            window.location.href = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?kode_barang=" + id;
                                }
                        return false;
                    }
                </script>
            </tr>
            </tbody>
            <?php
        }
        ?>
        <tr>
        <td colspan="7" class="text-center"></td>
    </tr>
    </table>
</div>
</body>
</html>
