<?php

$host = 'localhost'; //127.0.0.1
$database_name = 'example_library';
$database_username = 'root';
$database_password = '';

// Membuat koneksi ke database
$mysqli = mysqli_connect($host, $database_username, $database_password, $database_name);

?>