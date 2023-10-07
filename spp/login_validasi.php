<?php
include_once "config/inc.connection.php";
include_once "config/inc.library.php";
session_start();

// Tangkap data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Untuk mencegah SQL injection, gunakan mysqli_real_escape_string
$username = mysqli_real_escape_string($koneksidb, $username);
$password = mysqli_real_escape_string($koneksidb, $password);

// Cek data yang dikirim, apakah kosong atau tidak
if (empty($username) && empty($password)) {
    // Kalau username dan password kosong
    header('location:index.php?error=1');
} else if (empty($username)) {
    // Kalau username saja yang kosong
    header('location:index.php?error=2');
} else if (empty($password)) {
    // Kalau password saja yang kosong
    header('location:index.php?error=3');
}

# LOGIN CEK KE TABEL USER LOGIN
$mySql = "SELECT * FROM admin WHERE username='$username' AND password='".md5($password)."'";
$myQry = mysqli_query($koneksidb, $mySql);
$myData = mysqli_fetch_array($myQry);

# JIKA LOGIN SUKSES
if (mysqli_num_rows($myQry) >= 1) {
    // Menyimpan Kode yang Login
    $_SESSION['SES_LOGIN'] = $myData['kd_petugas'];
    $_SESSION['NAMA_LOGIN'] = $myData['nm_petugas'];
    $_SESSION['photo'] = $myData['photo'];

    header("Location: admin/index.php");
} else {
    // Kalau username ataupun password tidak terdaftar di database
    header('location:index.php?error=4');
}
?>
