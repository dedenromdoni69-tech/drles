<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("Location: login_siswa.php");
    exit();
}

$email = $_SESSION['siswa'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE siswa_email='$email'"));

$skor = 0;
if($data){
    $skor = $data['nilai_mtk'] + $data['nilai_indo'] + $data['nilai_inggris'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Status Pendaftaran</title>
<style>
body{font-family:Arial;background:#eef2f7;padding:30px;}
.card{background:white;padding:30px;border-radius:10px;max-width:700px;margin:auto;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
.status-box{padding:12px;border-radius:6px;font-weight:bold;margin-bottom:20px;}
.menunggu{background:#cfe2ff;}
.diterima{background:#d4edda;color:green;}
.ditolak{background:#f8d7da;color:red;}
.skor{background:#f8f9fa;padding:10px;border-radius:6px;font-size:18px;}
</style>
</head>
<body>

<div class="card">

<h2>Status Pendaftaran</h2>

<?php if($data){ ?>

<b>Nomor Pendaftaran:</b><br>
<?= $data['no_pendaftaran'] ?><br><br>

<div class="status-box
<?php 
if($data['status']=="Menunggu Seleksi") echo "menunggu";
elseif($data['status']=="Diterima") echo "diterima";
elseif($data['status']=="Ditolak") echo "ditolak";
?>">
Status: <?= $data['status'] ?>
</div>

<b>Jurusan Yang Diminati:</b><br>
<?= $data['jurusan'] ?><br><br>

<div class="skor">
Jumlah Skor: <b><?= $skor ?></b>
</div>

<?php } else { ?>
Belum ada data pendaftaran.
<?php } ?>

</div>

</body>
</html>
