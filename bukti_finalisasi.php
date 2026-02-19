<?php
session_start();
include "koneksi.php";

$email = $_SESSION['siswa'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE siswa_email='$email'"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Bukti Finalisasi</title>
<style>
body{font-family:Arial;background:#eef2f7;padding:30px;}
.card{background:white;padding:30px;border-radius:10px;max-width:600px;margin:auto;text-align:center;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
.success{background:#d4edda;padding:15px;border-radius:6px;color:green;font-weight:bold;}
</style>
</head>
<body>

<div class="card">

<h2>Pendaftaran Berhasil !!</h2>

<div class="success">
Selamat! Data kamu sudah terkunci.
</div>

<br>

<b>Nomor Pendaftaran:</b><br>
<?= $data['no_pendaftaran'] ?><br><br>

<b>Nama Lengkap:</b><br>
<?= $data['nama'] ?><br><br>

<b>Nama Orang Tua:</b><br>
<?= $data['nama_ortu'] ?><br><br>

<b>Jurusan/Mapel Yang Diminati:</b><br>
<?= $data['jurusan'] ?><br><br>

<b>Status:</b><br>
<?= $data['status'] ?>

</div>

</body>
</html>
