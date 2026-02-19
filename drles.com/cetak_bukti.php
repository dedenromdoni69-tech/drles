<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['siswa'])){
    header("Location: login_siswa.php");
    exit;
}

$email = $_SESSION['siswa'];

$q = mysqli_query($conn,"SELECT * FROM pendaftaran WHERE siswa_email='$email'");
$data = mysqli_fetch_assoc($q);

if(!$data){
    die("Data tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Kartu Peserta PMLB 2026</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:white;
}
.kartu{
    width:800px;
    margin:20px auto;
    border:2px solid black;
    padding:40px;
    position:relative;
}
.judul{
    text-align:center;
    font-weight:bold;
    font-size:22px;
}
.subjudul{
    text-align:center;
    font-size:18px;
    margin-bottom:30px;
}
.row{
    margin-bottom:8px;
}
.label{
    width:220px;
    display:inline-block;
}
.section{
    margin-top:20px;
    font-weight:bold;
}
.foto{
    position:absolute;
    right:40px;
    top:140px;
    width:120px;
    height:150px;
    border:1px solid black;
    text-align:center;
    line-height:150px;
    font-size:14px;
}
.pernyataan{
    margin-top:40px;
    font-size:14px;
    text-align:justify;
}
.ttd{
    margin-top:40px;
}
@media print{
    button{
        display:none;
    }
}
</style>
</head>
<body>

<div class="kartu">

<div class="judul">KARTU PESERTA</div>
<div class="subjudul">PMLB TAHUN 2026</div>

<div class="row">
<span class="label">Nomor Peserta</span>
<?= $data['no_pendaftaran'] ?? '-' ?>
</div>

<div class="row">
<span class="label">Nama Murid</span>
<?= strtoupper($data['nama'] ?? '-') ?>
</div>

<div class="row">
<span class="label">Kelas</span>
<?= $data['kelas'] ?? '-' ?>
</div>

<div class="row">
<span class="label">NISN</span>
<?= $data['nisn'] ?? '-' ?>
</div>

<div class="row">
<span class="label">Asal Sekolah</span>
<?= $data['asal_sekolah'] ?? '-' ?>
</div>

<div class="section">PILIHAN</div>
<div class="row">PILIHAN JURUSAN/MAPEL</div>

<div class="row">
<?= ($data['jurusan'] ?? '-') ?>
</div>

<div class="section">SKOR</div>
<div class="row">
<?= ($data['skor'] ?? '0') ?>
</div>

<div class="foto">
<?php 
if(!empty($data['foto']) && file_exists("foto/".$data['foto'])){
    echo "<img src='foto/".$data['foto']."' width='120' height='150'>";
}else{
    echo "Foto 3x4";
}
?>
</div>

<div class="pernyataan">
Pernyataan<br><br>
<?= date("d F Y"); ?><br><br>
Saya menyatakan bahwa data yang saya isikan dalam formulir pendaftaran PMLB 2026 adalah benar dan saya bersedia menerima ketentuan yang berlaku di Lembaga DR Private Tutoring dan Program Mata Pelajaran yang saya pilih. Saya bersedia menerima sanksi pembatalan penerimaan di DR Private Tutoring apabila melanggar pernyataan ini.
</div>

<div class="ttd">
Ketua DR Private Tutoring<br><br><br>
<br><br><br>
DEDEN ROMDONI
</div>

<br><br>
<button onclick="window.print()">Cetak</button>

</div>

</body>
</html>
