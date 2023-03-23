<!DOCTYPE html>
<html>
<head>
	<title>Inventori</title>
    <meta name="author" content="Muaz Ramdany" />
    
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #eee;
}
</style>
</head>
<body>

<?php
    include 'db.php';
	session_start();
?>

<h1> Inventori CRUD System  </h1>

<nav>
    <a href="./">Home</a> | 
    <a href="tambah.php">Tambah</a> | 
    <a href="update.php">Update</a> | 
    <a href="hapus.php">Delete</a>
</nav>

<hr />

<h2>Tambah Inventori Barang</h2>

<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
    <label>Kode Barang</label> <br />
    <input type="text" name="kode" /> <br />
    
    <br />
    
    <label>Nama Barang</label> <br />
    <input type="text" name="nama" /> <br />
    
    <br />
    
    <label>Kategori Barang</label> <br />
    <input type="text" name="kat" /> <br />
    
    <br />
    
    <label>Harga Barang</label> <br />
    <input type="text" name="harga" /> <br />
    
    <br />
    
    <label>Stok Barang</label> <br />
    <input type="text" name="stok" /> <br />
    
    <br />
    
    <button type="submit" name="tambah" value="true">Simpan</button>
</form>

<br />  
<hr />

<table>
    <thead>
        <tr>
            <td>Kode barang</td>
            <td>Nama barang</td>
            <td>Kategori barang</td>
            <td>Harga barang</td>
            <td>Stok barang</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sql = mysqli_query($con, 'select * from barang') or die(mysqli_error($con));
        while($row = mysqli_fetch_object($sql)) {
            echo '<tr>';
            echo '<td>'.$row->kode.'</td>';
            echo '<td>'.$row->nama.'</td>';
            echo '<td>'.$row->kategori.'</td>';
            echo '<td>'.$row->harga.'</td>';
            echo '<td>'.$row->stok.'</td>';
            echo '<td><a href=/inventori/update.php?item='.$row->kode.'>Edit</a></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

</body>
</html>


<?php 
/* PROSES INSERT KE DATABASE */
if(isset($_POST['tambah'])) {
    
    $kode_brg = $_POST['kode'];
    $nama_brg = $_POST['nama'];
    $kate_brg = $_POST['kat'];
    $harga_brg = $_POST['harga'];
    $stok_brg = $_POST['stok'];
    
    if($kode_brg == '' || $nama_brg == '' || $kate_brg == '' || $harga_brg == '' || $stok_brg == '' ) {
    ?>
    <script>alert('maaf inputan tidak boleh kosong');</script>
    <?php
    }
    else {
        mysqli_query($con, "insert into barang (kode, nama, kategori, harga, stok) values ('".$kode_brg."', '".$nama_brg."', '".$kate_brg."', '".$harga_brg."', '".$stok_brg."') ");
        ?>
        <script>
        alert('Data Telah Berhasil Di Simpan'); 
        window.location.href = '/inventori/tambah.php';
        </script>
        <?php
    }
}
?>