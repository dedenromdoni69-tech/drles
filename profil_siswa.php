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
?>

<!DOCTYPE html>
<html>
<head>
<title>Profil Peserta</title>
<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    margin:0;
    padding:30px;
}
.card{
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
    max-width:900px;
    margin:auto;
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
.section-title{
    margin-top:25px;
    font-size:18px;
    font-weight:bold;
    color:#1565c0;
}
</style>
</head>
<body>

<div class="card">

<h2>Profil Murid Pendaftar</h2>

<?php if($data){ ?>

<hr>

<div class="section-title">Data Pribadi</div>
<table>
<tr><td class="label">Nama</td><td><?php echo $data['nama']; ?></td></tr>
<tr><td class="label">Tempat Lahir</td><td><?php echo $data['tempat_lahir']; ?></td></tr>
<tr><td class="label">Tanggal Lahir</td><td><?php echo $data['tanggal_lahir']; ?></td></tr>
<tr><td class="label">NIK</td><td><?php echo $data['nik']; ?></td></tr>
<tr><td class="label">NISN</td><td><?php echo $data['nisn']; ?></td></tr>
</table>

<div class="section-title">Domisili</div>
<table>
<tr><td class="label">Alamat Lengkap</td>
<td>
<alamat_lengkap='$alamat',
</td></tr>
</table>

<div class="section-title">Data Orang Tua</div>
<table>
<tr><td class="label">Nama Orang Tua/Wali</td><td><?php echo $data['nama_ortu']; ?></td></tr>
</table>

<div class="section-title">Data Akademik</div>
<table>
<tr><td class="label">Kelas</td><td><?php echo $data['kelas']; ?></td></tr>
<tr><td class="label">Asal Sekolah</td><td><?php echo $data['asal_sekolah']; ?></td></tr>
<tr><td class="label">Jurusan</td><td><?php echo $data['jurusan']; ?></td></tr>
<tr><td class="label">Nilai Matematika</td><td><?php echo $data['nilai_mtk']; ?></td></tr>
<tr><td class="label">Nilai Bahasa Indonesia</td><td><?php echo $data['nilai_indo']; ?></td></tr>
<tr><td class="label">Nilai Bahasa Inggris</td><td><?php echo $data['nilai_inggris']; ?></td></tr>
</table>

<hr>
<h3>Nilai Hasil Pembelajaran</h3>
Informatika: <?php echo $data['nilai_informatika']; ?><br>
Keagamaan: <?php echo $data['nilai_keagamaan']; ?><br>
Kewirausahaan: <?php echo $data['nilai_kewirausahaan']; ?><br>
Dasar Komputer: <?php echo $data['nilai_komputer']; ?><br>
MKDT: <?php echo $data['nilai_mkdt']; ?><br>
MWDPK: <?php echo $data['nilai_mwdpk']; ?><br>
MEDPA: <?php echo $data['nilai_medpa']; ?><br>
IDJKD: <?php echo $data['nilai_idjkd']; ?><br>
DDGdM: <?php echo $data['nilai_ddgdm']; ?><br>
Adab & Karakter: <?php echo $data['nilai_adab']; ?><br>

<?php } else { ?>
Belum ada data pendaftaran.
<?php } ?>

</div>

</body>
</html>
<hr>
