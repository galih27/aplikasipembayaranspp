<?php
error_reporting(0);

$databaseHost = 'localhost'; // Replace with your database host
$databaseName = 'tu71';      // Replace with your database name
$databaseUser = 'root';      // Replace with your database username
$databasePass = '';           // Replace with your database password

// Create a new mysqli connection
$mysqli = new mysqli($databaseHost, $databaseUser, $databasePass, $databaseName);

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

$kode_jenis = ''; // Initialize the variable

// Generate the unique code
$query = "SELECT MAX(kode_jenis) AS kode_jenis FROM jns_bayar";
$result = $mysqli->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    if ($row['kode_jenis']) {
        $nourut = (int) substr($row['kode_jenis'], 3, 3);
    } else {
        $nourut = 0;
    }
    $nourut++;
    $char = "B";
    $kode_jenis = $char . sprintf("%03s", $nourut);
}

if (isset($_POST['btnSimpan'])) {
    // Get data from the form
    $jns_bayar = $_POST['jns_bayar'];
    $biaya = $_POST['biaya'];

    // Prepare the SQL statement
    $insertSql = "INSERT INTO jns_bayar (kode_jenis, jns_bayar, biaya) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($insertSql);

    if ($stmt) {
        // Bind the parameters and execute the statement
        $stmt->bind_param("ssd", $kode_jenis, $jns_bayar, $biaya);
        if ($stmt->execute()) {
            echo "Data berhasil disimpan.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
}
?>

<h2> TAMBAH JENIS PEMBAYARAN<br />
  <br />
</h2>
<form action="?page=simpanjenis" method="
