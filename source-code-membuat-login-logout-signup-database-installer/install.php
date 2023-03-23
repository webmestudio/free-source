<?php

// membutuhkan file jembatan koneksi ke database
if(!file_exists('connection.php'))
{
    include 'connection.php';
}
else // pemeberituah kesalahan (false)
{
    ?>
    <script>
    alert('Oppss ! Sepetinya anda sudah melakukan penginstallan database');
    window.location.href = "index.php";
    </script>
    <?php
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Installer Database Automated</title>
	<meta charset="UTF-8">
	
	<style type="text/css">
		.wadah-form {
			margin-top: 80px;
			text-align: center;
		}
	</style>

</head>
<body>

<div class="wadah-form">
	<h1>Install Database Secara Automatis</h1> <br /> <br />
	<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
		<label>DB Host</label> <br /> <br />
		<input type="text" name="db_host" value="127.0.0.1"> <br /> <br />
        <label>DB Port</label> <br /> <br />
		<input type="text" name="db_port" value="3306"> <br /> <br />
		<label>DB User</label> <br /> <br />
		<input type="text" name="db_user" value="root"> <br /> <br />
		<label>DB Pass</label> <br /> <br />
		<input type="password" name="db_pass"> <br /> <br />
		<label>DB Name</label> <br /> <br />
		<input type="text" name="db_name"> <br /> <br />
		<button type="submit" name="install">Buat Database</button> <br /> <br />
        <a href="index.php">Kembali Ke Halaman Sebelumnya</a>
	</form>
</div>

</body>
</html>

<?php

// proses install database
if(isset($_POST['install']))
{
    // deklarasi
    $dbhost = $_POST['db_host'];
    $dbport = $_POST['db_port'];
    $dbuser = $_POST['db_user'];
    $dbpass = $_POST['db_pass'];
    $dbname = $_POST['db_name'];
    
    if(!empty($dbname))
    {
        // koneksi ke database
    	$con1 = mysqli_connect($dbhost, $dbuser, $dbpass, '', $dbport);
    	if(mysqli_connect_errno()) 
    	{
    		?>
            <script>
            alert('Maaf Anda Tidak Terhubung Dengan MySQL');
            window.location.href = "install.php";
            </script>
            <?php
            exit;
    	}
        
        // buat database
    	$sql  = " CREATE DATABASE IF NOT EXISTS $dbname";
        $buatdb = mysqli_query($con1, $sql);
        if($buatdb === false) 
        {
            ?>
            <script>
            alert('Maaf Anda Gagal Membuat Database');
            window.location.href = "install.php";
            </script>
            <?php
            exit;
        }
        
        mysqli_close($con1);
        
        $con2 = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);
        $sql = "CREATE TABLE `user` (
		`user_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
		`username` VARCHAR(100) NULL DEFAULT NULL,
		`password` VARCHAR(250) NULL DEFAULT NULL,
		`nama_lengkap` VARCHAR(100) NULL DEFAULT NULL,
		`jurusan` VARCHAR(100) NULL DEFAULT NULL,
		PRIMARY KEY (`user_id`)
		)COLLATE='utf8_general_ci'ENGINE=MyISAM;";
        $buattable = mysqli_query($con2, $sql);
        if($buattable === false) 
        {
            ?>
            <script>
            alert('Maaf Anda Gagal Membuat Table Untuk Database');
            window.location.href = "install.php";
            </script>
            <?php
            exit;
        }
        
        //buat file untuk koneksi ke database secara otomatis
        $file =  'connection.php';
        $filewrite = fopen($file, "w") or die("Unable to open file!");
        $text = '
        <?php
            $dbhost = '."'$dbhost'".';
            $dbuser = '."'$dbuser'".';
            $dbpass = '."'$dbpass'".';
            $dbname = '."'$dbname'".';
            
            $con = @mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            
            if(mysqli_connect_errno()) {
                echo '."'tidak terkoneksi ke database'".';
            }
        ?>
        ';
        fwrite($filewrite, $text);
        fclose($filewrite);

        // Keberhasilan
        ?>
        <script>
            alert('Anda Telah Berhasil Membuat Database Dan Membuat Table, Anda Akan Di Alihkan Ke Halaman Pendaftaran');
            window.location.href = "register.php";
        </script>
        <?php
        exit;
    }
	else
    {
        ?>
        <script>
        alert('Maaf Inputan Nama Database Tidak Boleh Kosong');
        window.location.href = "install.php";
        </script>
        <?php
        exit;
    }
}

?>