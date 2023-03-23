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
	<title>Login Form</title>

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
	<form method="post" action="proses_login.php">
		<label>Masukan Username</label> <br /> <br />
		<input type="text" name="username"> <br /> <br />
		<label>Masukan Password</label> <br /> <br />
		<input type="password" name="password"> <br /> <br />
		<button type="submit" name="login">Login</button> | atau <a href="register.php">Mendaftar</a> <br /> <br />
        <a href="install.php">Install Database Automatis</a>
	</form>
</div>

</body>
</html>