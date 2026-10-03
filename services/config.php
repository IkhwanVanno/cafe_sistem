<?php

$koneksi = new mysqli(
    'localhost',
    'root',
    '',
    'cafe_sistem'
);

if ($koneksi->connect_error) {
    die('Terjadi kesalahan koneksi ke database:'. $koneksi->connect_error);
}
