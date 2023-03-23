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
    require 'db.php';
	session_start();
    
    $getitem = isset($_GET['item']) ? $_GET['item'] : '';
?>

<h1> Inventori CRUD System  </h1>

<nav>
    <a href="./">Home</a> | 
    <a href="tambah.php">Tambah</a> | 
    <a href="update.php">Update</a> | 
    <a href="hapus.php">Delete</a>
</nav>

<hr />


<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
    <label>Pilih Kode Barang</label> <br />
    <select name="kode" style="width: 200px;">
        <option value="">-- Pilih --</option>
        <?php 
        $sql = mysqli_query($con, 'select * from barang') or die(mysqli_error($con));
        while($row = mysqli_fetch_object($sql)) {
            echo '<option>'.$row->kode.'</option>';
        }
        ?>
    </select>
    
    <br />
    <br />
    
    <button type="submit" name="hapus">Hapus</button>
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
            echo '<td><a href=update.php?item='.$row->kode.'>Edit</a></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php 
/* PROSES Update Data KE DATABASE */
if(isset($_POST['hapus'])) {
    
    $kode_brg = $_POST['kode'];
    mysqli_query($con, " delete from barang where kode = '".$kode_brg."' ");
    ?>
    <script>
    alert('Data Telah Berhasil Di Hapus'); 
    window.location.href = '/inventori/hapus.php';
    </script>
    <?php
}
?>