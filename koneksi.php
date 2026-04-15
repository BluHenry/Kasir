<?php

$hostname = "Localhost";
$username = "root";
$password = "";
$db = "kasir_db";

$koneksi = new mysqli($hostname, $username, $password, $db);


//  kcoonnect versi lama
// if (!$koneksi) {
//     die("koneksi gagal, coba rodok Novu lagi : " . mysqli_connect_error());
// }

if ($koneksi -> connect_error) {
    die("koneksi gagal, coba rodok Novu lagi : " . $koneksi->connect_error);
}


?>