<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "koneksi.php";

if(!isset($_SESSION['petugas'])){
    die("Silakan login petugas.");
}

/* PROSES TERIMA */
if(isset($_GET['terima'])){
    $id = $_GET['terima'];
    mysqli_query($conn,"UPDATE daftar_les SET status='Diterima' WHERE id='$id'");
    header("Location: petugas_data_les.php");
}

/* PROSES BATAL */
if(isset($_GET['batal'])){
    $id = $_GET['batal'];
    mysqli_query($conn,"UPDATE daftar_les SET status='Dibatalkan' WHERE id='$id'");
    header("Location: petugas_data_les.php");
}

/* AMBIL DATA */
$data = mysqli_query($conn,"SELECT * FROM daftar_les ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Pendaftaran Les</title>
<style>
body{font-family:Arial;background:#f4f6f9;padding:30px;}
h2{margin-bottom:20px;}
table{
    width:100%;
    border-collapse:collapse;
    background:white;
}
th,td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}
th{
    background:#007bff;
    color:white;
}
.status-menunggu{color:orange;font-weight:bold;}
.status-diterima{color:green;font-weight:bold;}
.status-batal{color:red;font-weight:bold;}
.btn{
    padding:5px 10px;
    text-decoration:none;
    border-radius:4px;
    color:white;
    font-size:12px;
}
.btn-terima{background:green;}
.btn-batal{background:red;}
.btn-edit{background:#007bff;}
</style>
</head>
<body>

<h2>Data Pendaftaran Les</h2>

<table>
<tr>
<th>No</th>
<th>No Permintaan</th>
<th>Nama</th>
<th>No Peserta</th>
<th>Mapel</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Tutor</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php 
$no=1;
while($d=mysqli_fetch_assoc($data)):

$tanggal = date("d/m/Y", strtotime($d['tanggal']));
$jam_final = $d['waktu_mulai']."-".$d['waktu_selesai'];

$status_class = "";
if($d['status']=="Menunggu") $status_class="status-menunggu";
if($d['status']=="Diterima") $status_class="status-diterima";
if($d['status']=="Dibatalkan") $status_class="status-batal";
?>

<tr>
<td><?= $no++; ?></td>
<td><?= $d['nomor_permintaan']; ?></td>
<td><?= $d['nama']; ?></td>
<td><?= $d['no_peserta']; ?></td>
<td><?= $d['mata_pelajaran']; ?></td>
<td><?= $tanggal; ?></td>
<td><?= $jam_final; ?></td>
<td><?= $d['tutor']; ?></td>
<td class="<?= $status_class; ?>"><?= $d['status']; ?></td>
<td>

<?php if($d['status']=="Menunggu"){ ?>
<a href="?terima=<?= $d['id']; ?>" class="btn btn-terima">Terima</a>
<a href="?batal=<?= $d['id']; ?>" class="btn btn-batal">Batalkan</a>
<?php } ?>

<a href="edit_les.php?id=<?= $d['id']; ?>" class="btn btn-edit">Edit</a>

</td>
</tr>

<?php endwhile; ?>

</table>

</body>
</html>
