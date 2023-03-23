<?php

if(isset($_POST['login']))
{
    // sesi start
    session_start();
    
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
    
    // deklarasi data dari inputan yang di simpan ke dalam variable
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    
    // validasi kesalahan jika inputan kosong
    if(empty($username) || empty($password))
    {
        ?>
        <script>
        alert('Maaf inputan ada yang belum terisi, silahkan cek kembali');
        window.location.href = "index.php";
        </script>
        <?php
        exit;
    }
    else 
    {
        //cek data jika ada kesamaan data username
        $command = mysqli_query($con, "select * from user where username = '".$username."' ");
        $cek = mysqli_num_rows($command); // nilai akan menjadi 1 atau 0
        
        // hasil akan menjadi array
        $data = mysqli_fetch_array($command);
        
        if($cek == 0)
        {
            ?>
            <script>
            alert('Maaf akun yang anda masukan belum tersedia di database, anda akan di alihkan ke halaman register.');
            window.location.href = "register.php";
            </script>
            <?php
            exit;
        }
        else
        {
            
            // buat sesi sementara di browser
            // menindentifikasi bahwa pengguna sudah mendaftar dan langsung login
            $_SESSION['logged_in']  = true; 
            // ini variable       = ini mengambilan data di database yg telah manjadi array
            $_SESSION['user_id']  = $data['user_id'];
            $_SESSION['username'] = $data['username'];
            
            ?>
            <script>
            alert('Otentikasi Berhasil, Akun yang anda masukan tersedia.');
            window.location.href = "home.php";
            </script>
            <?php
            exit;
            
        }
    }
}
else
{
     ?>
    <script>
    alert('Anda belum melakukan proses pengimputan, mungkin secara langsung anda mengakses halaman ini.');
    window.location.href = "index.php";
    </script>
    <?php
    exit;
}

?>