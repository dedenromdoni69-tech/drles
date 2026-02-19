<?php
session_start();
include "koneksi.php";

$email = $_SESSION['siswa'];
$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE siswa_email='$email'"));
?>

<link rel="stylesheet" href="style.css">

<div class="header">KARTU PESERTA</div>
<div class="container">
<div class="card">

<h2>Berhasil Mendaftar di DR Private Tutoring</h2>

<p>No Pendaftaran: <b><?php echo $data['no_pendaftaran']; ?></b></p>
<p>Nama: <?php echo $data['nama']; ?></p>
<p>Jurusan: <?php echo $data['jurusan']; ?></p>
<p>Status: <?php echo $data['status']; ?></p>

<br>
<button onclick="window.print()" class="btn-biru">Unduh Kartu Peserta</button>

</div>
</div>
