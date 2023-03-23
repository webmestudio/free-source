<?php

// Ex : Output Subfolder/
define('_BASE_DIR_', basename(dirname($_SERVER['PHP_SELF'])) . '/');

// AUTO DETECT SUBFOLDER
// Jika Di URL terditeksi /subfolder/ or /subfolder
// ex output : subfolder/param/param [or] /subfolder/param/param
if( str_replace('/', '', _BASE_DIR_) ) { 
    // Variable Tetap
    define('_BASEROOT_', str_replace('/', '/', _BASE_DIR_));
}
else {
    // Variable Tetap
    define('_BASEROOT_', str_replace('/', '', _BASE_DIR_));
}

// Jalur DIR application/
define('_APP_PATH_', _BASEPATH_ . 'apps/');

// Jalur DIR library/
define('_LIB_PATH_', _BASEPATH_ . 'libs/');

// Jalur DIR core/
define('_CORE_', _BASEPATH_ . 'core/');

// Automatis Menentukan Socket Menggunakan SSL Atau Tidak dan port
// Ex 1 : http://localhost/ atau http://localhost:8080/
// Ex 2 : https://localhost/ atau https://localhost:8080/
if(isset($_SERVER['SERVER_NAME'])) {
    if($_SERVER["SERVER_PORT"] == '80') {
        $server = sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && 
            $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'], '/');
    }
    else {
        $server = sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && 
            $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"], '/');
    }
}
else {
    if($_SERVER["SERVER_PORT"] == '80') { 
        $server = sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && 
            $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_ADDR'], '/'); 
    }
    else {
       $server = sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && 
            $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER['SERVER_ADDR'].':'.$_SERVER["SERVER_PORT"], '/'); 
    }
}

// Ex : http://localhost/ | https://localhost/
define('_HOSTNAME_', $server);

// URL Standart | if exists subfolder 
// output : http://localhost/subfolder
define('_BASE_URL_', _HOSTNAME_ . _BASEROOT_);

// URL API 
// output : http://localhost/api/
define('_URL_API_', _HOSTNAME_ . _BASEROOT_ . 'api/');

// URL AJAX 
// output : http://localhost/ajax/
define('_URL_AJAX_', _HOSTNAME_ . _BASEROOT_ . 'ajax/');

// Set Path Project untuk router
define('_BASE_PROJECT_', _BASEROOT_);

// Definisi String Connect To Database
define('DB_ENGINE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', '');
define('DB_PORT', '3306');

?>