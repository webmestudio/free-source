<?php
//panggil jembatan koneksi ke database
include 'db_connection.php';

// definisi sql tampil semua users
$sql = "SELECT * FROM users";

// tampil data users 
$query = $db->query($sql); // perintah SQL

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
		// jika data tidak kosong
		if($recordCount != 0) : // true
	
			// tampil data users 
			$query = $db->query($sql); // perintah SQL
			
			// looping data
			while($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				// tampung data di $row ke dalam $data_array as array
				$data_array[] = $row;
			}
			
			/* pecah array yang ada di dalam $data_array yang hanya mengambil data dari $field */
			foreach($data_array as $field) : 
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
							<tr>
								<td style="margin-top: 40px; display: block;">
									<a href="<?= $field['username']; ?>">Lihat Profile Saya</a>
								</td>
							</tr>
						</tbody>
					</table>
				</aside>
			</div>
			<hr />
			<?php endforeach; ?>
		<?php else : ?>
			<div style="text-align: center; color: red; border: 1px solid #ddd; padding: 20px;">
				<h3>MAAF ! DATA BELUM TERSEDIA DI DATABASE SILAHKAN ISI DATA KE DATABASE SECARA MANUAL</h3>
			</div>
		<?php endif; ?>
	</div>

</body>
</html>