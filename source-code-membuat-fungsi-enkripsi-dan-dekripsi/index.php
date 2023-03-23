<?php 

require 'crypt.class.php';

$crypt = new Crypt;

$enk = $crypt->encode('test');
$dek = $crypt->decode($enk);

echo 'Enkripsi : ' . $enk . '</br>';
echo 'Dekripsi : ' . $dek ;

?>