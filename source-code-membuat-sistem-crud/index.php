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

<br />

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