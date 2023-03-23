<?php

//handle halaman jika pengguna sudah melakukan register atau login
session_start();
if(@$_SESSION['logged_in'] == true)
{
    header('location: home.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Regiter Form</title>

	<style type="text/css">
		.wadah-form {
			margin-top: 80px;
			text-align: center;
		}
	</style>

</head>
<body>

<div class="wadah-form">
	<h1>Contoh Login, Logout, Register dan Installer Database</h1> <br /> <br />
	<form method="post" action="proses_register.php">
		<label>Masukan Username</label> <br /> <br />
		<input type="text" name="username"> <br /> <br />
		<label>Masukan Password</label> <br /> <br />
		<input type="password" name="password"> <br /> <br />
		<label>Pilih Jurusan Universitas</label> <br /> <br />
		<select name="jurusan">
			<option value="null">Pilih Jurusan</option>
			<option>Sistem Informasi</option>
			<option>Teknik Informatika</option>
		</select> <br /> <br />
		<label>Masukan Nama Lengkap</label> <br /> <br />
		<input type="text" name="name"> <br /> <br />
		<button type="submit" name="register">Mendaftar</button> | atau <a href="index.php">Login</a> <br /> <br />
		<a href="install.php">Install Database Automatis</a>
	</form>
</div>

</body>
</html>