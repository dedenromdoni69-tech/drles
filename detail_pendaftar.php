<?php
include "koneksi.php";

if(!isset($_GET['id'])){
    echo "ID tidak ditemukan.";
    exit();
}

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE id='$id'"));

if(!$data){
    echo "Data tidak ditemukan.";
    exit();
}

$skor = $data['nilai_mtk'] + $data['nilai_indo'] + $data['nilai_inggris'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Peserta</title>
<style>
body{
    font-family:Arial;
    background:#f4f6f9;
    padding:30px;
}
.card{
    background:white;
    padding:30px;
    border-radius:12px;
    max-width:800px;
    margin:auto;
    box-shadow:0 6px 20px rgba(0,0,0,0.1);
}
h2{
    margin-top:0;
    color:#0d47a1;
}
table{
    width:100%;
    border-collapse:collapse;
}
td{
    padding:10px;
    border-bottom:1px solid #eee;
}
.label{
    font-weight:bold;
    width:35%;
    background:#f8f9fa;
}
.skor{
    background:#e3f2fd;
    padding:12px;
    margin-top:15px;
    border-radius:8px;
    font-size:18px;
    font-weight:bold;
}
.status{
    padding:10px;
    border-radius:6px;
    font-weight:bold;
}
.menunggu{background:#cfe2ff;}
.diterima{background:#d4edda;color:green;}
.ditolak{background:#f8d7da;color:red;}
</style>
</head>
<body>

<div class="card">

<h2>Detail Pendaftar Murid Baru</h2>

<table>
<tr><td class="label">Nomor Pendaftaran</td><td><?= $data['no_pendaftaran']; ?></td></tr>
<tr><td class="label">Nama</td><td><?= $data['nama']; ?></td></tr>
<tr><td class="label">Nama Orang Tua/Wali</td><td><?= $data['nama_ortu']; ?></td></tr>
<tr><td class="label">Kelas</td><td><?= $data['kelas']; ?></td></tr>
<tr><td class="label">Asal Sekolah</td><td><?= $data['asal_sekolah']; ?></td></tr>
<tr><td class="label">Jurusan</td><td><?= $data['jurusan']; ?></td></tr>
<tr><td class="label">Nilai Matematika</td><td><?= $data['nilai_mtk']; ?></td></tr>
<tr><td class="label">Nilai Bahasa Indonesia</td><td><?= $data['nilai_indo']; ?></td></tr>
<tr><td class="label">Nilai Bahasa Inggris</td><td><?= $data['nilai_inggris']; ?></td></tr>
</table>

<div class="skor">
Jumlah Skor: <?= $skor; ?>
</div>

<br>

<div class="status 
<?php 
if($data['status']=="Menunggu Seleksi") echo "menunggu";
elseif($data['status']=="Diterima") echo "diterima";
elseif($data['status']=="Ditolak") echo "ditolak";
?>">
Status: <?= $data['status']; ?>
</div>

</div>

</body>
</html>
