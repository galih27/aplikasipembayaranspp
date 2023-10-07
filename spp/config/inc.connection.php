<?php
# Konek ke Web Server Lokal
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tu71";

$koneksidb = new mysqli($servername, $username, $password, $dbname);

if ($koneksidb->connect_error) {
    die("Connection failed: " . $koneksidb->connect_error);
}
?>