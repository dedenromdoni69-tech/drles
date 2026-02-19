<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";

if(!isset($_SESSION['siswa'])){
    die("Silakan login dulu.");
}

$email = $_SESSION['siswa'];

$q = mysqli_query($conn,"
SELECT * FROM daftar_les 
WHERE siswa_email='$email'
ORDER BY id DESC LIMIT 1
");

$d = mysqli_fetch_assoc($q);

if(!$d){
    die("Belum ada permintaan les.");
}

$tanggal = date("d F Y", strtotime($d['tanggal']));
$jam_final = $d['waktu_mulai']."-".$d['waktu_selesai'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Surat Rencana Les</title>
<style>
body{font-family:Arial;padding:40px;}
h2,h3{text-align:center;}
.box{margin-top:30px;}
</style>
</head>
<body>

<h2>SURAT RENCANA LES</h2>
<h3>DR PRIVATE TUTORING</h3>

<div class="box">

Tutor Yth : <?= $d['tutor']; ?><br>
Nomor Permintaan : <?= $d['nomor_permintaan']; ?><br><br>

Nama : <?= $d['nama']; ?><br>
Nomor Peserta : <?= $d['no_peserta']; ?><br>
Mapel Les : <?= $d['mata_pelajaran']; ?><br><br>

Keterangan:<br>
Rencana Kunjungan Les : <?= $tanggal; ?>, <?= $jam_final; ?><br><br>

Catatan:<br>
Mohon surat ini dibawa pada saat pelaksanaan pembelajaran.

</div>

<br>
<button onclick="window.print()">Cetak</button>

</body>
</html>
