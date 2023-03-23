<?php

// melakukan proses set form register
if(isset($_POST['register']))
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
    $jurusan    = $_POST['jurusan'];
    $fullname   = $_POST['name'];
    
    // validasi kesalahan jika inputan kosong
    if(empty($username) || empty($password) || $jurusan == null || empty($fullname))
    {
        ?>
        <script>
        alert('Maaf inputan ada yang belum terisi, silahkan cek kembali');
        window.location.href = "register.php";
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
        
        if($cek == 1)
        {
            ?>
            <script>
            alert('Maaf username yang anda masukan sudah tersedia di database, dan pendaftaran tidak akan di proses');
            window.location.href = "register.php";
            </script>
            <?php
            exit;
        }
        else
        {
            // tambahkan data ke database
            $insert_data = mysqli_query($con, "insert into user (username, password, jurusan, nama_lengkap) 
            values ('".$username."', '".$password."', '".$jurusan."', '".$fullname."') 
            ");
            
            if($insert_data === true)
            {
                // buat sesi sementara di browser
                // menindentifikasi bahwa pengguna sudah mendaftar dan langsung login
                $_SESSION['logged_in']  = true; 
                // ini variable       = ini mengambilan data di database yg telah manjadi array
                $_SESSION['username'] = $username;
                
                ?>
                <script>
                alert('Termikasih anda telah terdaftar, anda akan di alihkan ke halaman rumah.');
                window.location.href = "home.php";
                </script>
                <?php
                exit;
            }
            else
            {
                ?>
                <script>
                alert('Data gagal di tambahkan, silahkan untuk mencoba lagi.');
                window.location.href = "register.php";
                </script>
                <?php
                exit;
            }
        }
    }
}
else
{
     ?>
    <script>
    alert('Anda belum melakukan proses pengimputan, mungkin secara langsung anda mengakses halaman ini.');
    window.location.href = "register.php";
    </script>
    <?php
    exit;
}

?>