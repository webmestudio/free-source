<?php

// panggil class bahasa
require "class.language.php";

// buat objek bahasa
$language = new language();
$lang = $language->get(@$_POST['lang']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contoh Membuat Translate Bahasa Sendiri</title>
</head>
<body>

<!-- Contoh Pemakaian System Bahasa -->
<div align="center">
    <h1> <?= $lang['h1']; ?> </h1>
    <form name="language" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        <select onchange="document.language.submit()" onload="document.language.reload()" name="lang">
            <option value="0"><?= $lang['select-lang']; ?></option>
            <option value="ID">Indonesia</option>
            <option value="EN">English</option>
         </select>
    </form>
    <br /> <br /> 
    <a href="#" onclick="window.location.href = 'index.php'">Reload Halaman</a>
</div>

</body>
</html>