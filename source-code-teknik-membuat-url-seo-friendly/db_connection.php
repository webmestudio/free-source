<?php

// define connect to database
$connect = mysqli_connect('localhost', 'root', 'social102', 'ws_url_friendly', '3306');

// statement if tidak terkoneksi ke database
if(mysqli_connect_errno()) 
{
	exit('Maaf anda tidak terkoneksi ke database');
}

?>