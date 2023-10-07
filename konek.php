<?php
# Konek ke Web Server Lokal
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tu71"; // nama database, disesuaikan dengan database di MySQL

# Konek ke Web Server Lokal menggunakan MySQLi
$koneksidb = new mysqli($servername, $username, $password, $dbname);

# Cek koneksi
if ($koneksidb->connect_error) {
    die("Koneksi MySQL gagal: " . $koneksidb->connect_error);
} else {
    echo "Koneksi MySQL berhasil!";
}
?>