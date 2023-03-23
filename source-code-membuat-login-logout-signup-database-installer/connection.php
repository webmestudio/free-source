
        <?php
            $dbhost = '127.0.0.1';
            $dbuser = 'root';
            $dbpass = 'social102';
            $dbname = 'db_universitas';
            
            $con = @mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            
            if(mysqli_connect_errno()) {
                echo 'tidak terkoneksi ke database';
            }
        ?>
        