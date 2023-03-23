<?php

// sesi start
session_start();

// handle halaman jika sudah melakukan login atau register
if(@$_SESSION['logged_in'] == true)
{   
    // membutuhkan file jembatan koneksi ke database
    if(file_exists('connection.php'))
    {
        include 'connection.php';
    }
    else // pemeberituah kesalahan (false)
    {
        ?>
        <script>
        alert('Maaf Anda Belum Terkoneksi Ke Database, Silahkan Untuk Menginstall Database');
        window.location.href = "install.php";
        </script>
        <?php
        exit;
    }

    // mengambil data dari dalam database dengan mengacukan data sesi yang telah di buat sebelumnya
    $command = mysqli_query($con, "select * from user where username = '".$_SESSION['username']."' ");
    $data    = mysqli_fetch_array($command);
}
else
{
    ?>
    <script>
    alert('Ooopsss! Sepertinya anda melakukan akses langsung ke halaman ini, silahkan anda melakukan login atau register sebelum mengakses halaman ini.');
    window.location.href = "index.php";
    </script>
    <?php
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>

	<style type="text/css">
		.wadah-output {
			margin-top: 80px;
			text-align: center;
		}
	</style>

</head>
<body>

<div class="wadah-output">
    <h1>Contoh Login, Logout, Register dan Installer Database</h1> <br /> <br />

    <h3>Ini Hasil Output Inputan Yang Tadi</h3> <br />
    <div>Logged_in  : <?= $_SESSION['logged_in']; ?></div>
    <div>User_ID  : <?= $data['user_id']; ?></div>
    <div>Username : <?= $data['username']; ?></div>
    <div>Password : <?= $data['password']; ?></div>
    <div>Jurusan Universitas : <?= $data['jurusan']; ?></div>
    <div>Nama Lengkap : <?= $data['nama_lengkap']; ?></div> <br />

    <div><a href="logout.php">Logout</a></div>
</div>

</body>
</html>