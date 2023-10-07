<?php
// Remove error_reporting(0); as it hides errors which can be useful for debugging.

$databaseHost = 'localhost'; // Replace with your database host
$databaseName = 'tu71';      // Replace with your database name
$databaseUser = 'root';      // Replace with your database username
$databasePass = '';           // Replace with your database password

$koneksidb = new mysqli($databaseHost, $databaseUser, $databasePass, $databaseName);

if ($koneksidb->connect_errno) {
    die("Failed to connect to MySQL: " . $koneksidb->connect_error);
}
?>
<html>
<head>
<script language="JavaScript" type="text/JavaScript">
function showKab() {
    var propinsi = document.getElementById('propinsi').value;

    // Make an AJAX request to fetch data based on the selected propinsi
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // Update the kabupaten dropdown with the fetched data
            document.getElementById('kabupaten').innerHTML = xmlhttp.responseText;
        }
    };

    xmlhttp.open('GET', 'get_kabupaten.php?kelas=' + propinsi, true);
    xmlhttp.send();
}
</script>
</head>
<body>
<table class='table-data' width='100%'>
    <tr>
        <td class="head-data">Pilih Kelas
            <select id="propinsi" name="propinsi" onchange="showKab()">
                <option value="">Kelas</option>
                <?php
                // query to retrieve unique kelas values
                $query = "SELECT DISTINCT kelas FROM siswa";
                $result = mysql_query($query);
                while ($data = mysql_fetch_array($result)) {
                    echo "<option value='" . $data['kelas'] . "'>" . $data['kelas'] . "</option>";
                }
                ?>
            </select>
            Pilih Siswa:
            <select name="kab" id="kabupaten">
                <option value="">Pilih Kelas terlebih dahulu</option>
            </select>
        </td>
    </tr>
</table>
</body>
</html>
