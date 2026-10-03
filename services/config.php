<?php

$host     = "localhost";
$user     = "root";
$password = "";
$database = "cafe_sistem";

$koneksi = new mysqli(
    $host,
    $user,
    $password,
    $database
);

if ($koneksi->connect_error) {
    die('Terjadi kesalahan koneksi ke database:' . $koneksi->connect_error);
}
