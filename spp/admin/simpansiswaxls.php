<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=simpansiswaxls.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
include_once "../config/inc.connection.php";

$mysqli = new mysqli("localhost", "root", "", "tu71");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$query = "SELECT * FROM siswa";
$result = $mysqli->query($query);

if (!$result) {
    die("Error: " . $mysqli->error);
}

$jumlah = $result->num_rows;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style type="text/css">
        a:link{color:#000000;}
        a:visited{color:#000000;}
        a:hover{color:#000000;}
        .style1 {color: #000000}
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>
<body>
    <div style="width:800px; margin:auto;">
        <div>
            <h2 align="center" style="color:#000000;">DATA SISWA</h2>
            <div style="padding-top:10px;"></div>
        </div>
        <form method="post" action="#">
            <?php
$jum_hal = 9000;

error_reporting(E_ALL ^ E_NOTICE);
$halaman = isset($_REQUEST['hal']) ? intval($_REQUEST['hal']) : 1;

if ($halaman <= 0) {
    $mulai = 0;
    $halaman = 1;
} else {
    $mulai = ($jum_hal * $halaman) - $jum_hal;
}
?>



<?php
$mysqli = new mysqli("localhost", "root", "", "tu71");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
$jum_data = $mysqli->query("SELECT COUNT(*) as total FROM siswa")->fetch_assoc()['total'];
$jum_page = ceil($jum_data / $jum_hal);

$next = $halaman + 1;
$back = $halaman - 1;

if ($halaman > 1) {
    echo "<a href='index.php?page=data_siswa&hal=$back'>Back</a> ";
}

echo " $halaman / $jum_page Halaman  ";

if ($halaman < $jum_page) {
    echo "<a href='index.php?page=data_siswa&hal=$next'>Next</a>";
}
?>

            <div style="padding-top:10px; padding-bottom:5px;">
                <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:#8fb041 1px solid;">
                    <tr>
                        <td>
                            <table width="100%" cellspacing="1" cellpadding="3">
                                <tr style="font-weight:bold; font-size:13px;color:#FFFFFF" align="center">
                                    <td width="9%">NO</td>
                                    <td width="17%" height="30">NO INDUK</td>
                                    <td width="23%">NISN</td>
                                    <td width="31%">NAMA SISWA</td>
                                    <td width="21%">JENIS KELAMIN</td>
                                    <td width="21%">TEMPAT, TGL LAHIR</td>
                                    <td width="21%">KELAS</td>
                                    <td width="23%">ALAMAT</td>
                                    <td width="23%">NAMA AYAH</td>
                                    <td width="23%">NAMA IBU</td>
                                    <td width="23%">NO HP AYAH</td>
                                    <td width="23%">NO HP IBU</td>
                                </tr>
                                <?php
                                if ((isset($_POST['submit'])) AND ($_POST['search'] <> "")) {
                                    $search = $_POST['search'];
                                    $sql1 = $mysqli->query("SELECT * FROM siswa LIKE '%$search%'") or die($mysqli->error);
                                } else {
                                    $sql1 = $mysqli->query("SELECT * FROM siswa order by no_induk asc LIMIT $mulai,$jum_hal");
                                }
                                $jumlah1 = $sql1->num_rows;
                                {
                                    $no = 0;
                                    while ($tampil = $sql1->fetch_assoc()) {
                                        $no = $no + 1;
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $no; ?></td>
                                            <td align="center"><?php echo $tampil['no_induk'] ?></td>
                                            <td><a href="" class="style1"><?php echo $tampil['nisn'] ?></a></td>
                                            <td align="center"><?php echo $tampil['nama_siswa']; ?></td>
                                            <td align="center"><?php echo $tampil['jk']; ?></td>
                                            <td align="center"><?php echo $tampil['tmpt_lahir']; ?>,<?php echo $tampil['tgl_lahir']; ?></td>
                                            <td align="center"><?php echo $tampil['kelas']; ?></td>
                                            <td align="center"><?php echo $tampil['alamat']; ?></td>
                                            <td align="center"><?php echo $tampil['alamat']; ?></td>
                                            <td align="center"><?php echo $tampil['alamat']; ?></td>
                                            <td align="center"><?php echo $tampil['alamat']; ?></td>
                                            <td align="center"><?php echo $tampil['alamat']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</body>
</html>
