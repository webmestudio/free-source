<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'social102';
$dbname = 'db_inventori';

$con = @mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(mysqli_connect_errno()) {
    echo 'tidak terkoneksi ke database';
}

?>