<?php

//panggil jembatan koneksi ke database
include 'db_connection.php';

// dapatkan data username yang telah di rewrite oleh htaccess
// yang tadi url belum di rewrite yaitu : profile.php?username=nama
$username = isset($_GET['username']) ? $_GET['username'] : null;

// sql tampil data users dengan mengacu pada $username
$sql = "SELECT * FROM users WHERE username = :username";

// excute sql
$query = $db->prepare($sql); // perintah SQL
$query->bindParam(":username", $username);
$query->execute();

// hitung data
$recordCount = $query->fetchColumn();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Teknik URL Friendly</title>
	<style type="text/css">
		.clearfix {
			content: " ";
    		display: table;
		}
		.container {
			width: 450px;
			margin: 40px auto;
			border: 1px solid #ddd;
			*min-height: 400px;
			padding: 20px;
		}
		.aside {
			float: left;
			margin-top: 20px;
		}
		.asideleft {
			margin-right: 10px;
		}
		.asideright {
			margin-top: 50px;
		}
	</style>
</head>
<body>

	<div class="container">
		<header align="center">
			<h1>Teknik Membuat URL SEO Friendly PHP dan HTACCESS</h1>
		</header>
		<hr />

		<?php 
		// pernyataan jika data di database kosong atau belum ada isi
		// fungsi mysqli_num_rows() ini untuk menghitung semua data kolom di database return int
		if($recordCount != 0) : // true
			
			// excute sql
			$query = $db->prepare($sql); // perintah SQL
			$query->bindParam(":username", $username);
			$query->execute();
			
			// buat variable data object
			// cara pakai : $field['nama_field_yg_ada_di_database'];
			$field = $query->fetch(PDO::FETCH_ASSOC);
		?>
			<div style="text-align: center;">Table Users Tersedia <?= $recordCount; ?> Baris</div>
			<hr />
			<div class="content clearfix">
				<aside class="aside asideleft">
					<a href="#!">
						<img src="<?= $field['photo_profile']; ?>" height="200" width="200" />
					</a>
				</aside>
				<aside class="aside asideright">
					<table>
						<tbody>
							<tr>
								<td>User ID</td>
								<td>:</td>
								<td><?= $field['user_id']; ?></td>
							</tr>
							<tr>
								<td>Username</td>
								<td>:</td>
								<td><?= $field['username']; ?></td>
							</tr>
							<tr>
								<td>Nama Lengkap</td>
								<td>:</td>
								<td><?= $field['fullname']; ?></td>
							</tr>
							<tr>
								<td>Foto Profile</td>
								<td>:</td>
								<td><?= $field['photo_profile']; ?></td>
							</tr>
						</tbody>
					</table>
				</aside>
			</div>
			<hr />
			<div style="text-align: center;">Hai <?= $field['fullname']; ?> Ini Halaman Profil Anda, <br/> <a href="./index.php">Kembali ke Halaman Rumah</a>.</div>
			<hr />
		<?php else : ?>
			<div style="text-align: center; color: red; border: 1px solid #ddd; padding: 20px;">
				<h3>MAAF ! DATA BELUM TERSEDIA DI DATABASE SILAHKAN ISI DATA KE DATABASE SECARA MANUAL</h3>
			</div>
		<?php endif; ?>
	</div>

</body>
</html>