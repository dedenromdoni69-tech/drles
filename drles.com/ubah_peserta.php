<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['petugas'])){
    header("Location: login_petugas.php");
    exit();
}

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE id='$id'"));

if(!$data){
    die("Data tidak ditemukan");
}

if(isset($_POST['update'])){

    $nama_ayah = $_POST['nama_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $alamat = $_POST['alamat'];
    $nik = $_POST['nik'];
    $nisn = $_POST['nisn'];
    $tempat = $_POST['tempat_lahir'];
    $tgl = $_POST['tanggal_lahir'];
    $penghasilan = $_POST['penghasilan'];

    mysqli_query($conn,"UPDATE pendaftaran SET
        nama_ayah='$nama_ayah',
        nama_ibu='$nama_ibu',
        alamat_lengkap='$alamat',
        nik='$nik',
        nisn='$nisn',
        tempat_lahir='$tempat',
        tanggal_lahir='$tgl',
        penghasilan_ortu='$penghasilan'
        WHERE id='$id'
    ");

    echo "<script>
        alert('Data berhasil diperbarui');
        window.location='data_pendaftar.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Ubah Data Peserta</title>
<style>
body{
    font-family: Arial;
    background:#f4f6f9;
}
.container{
    width:800px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:8px;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
}
h2{
    border-bottom:2px solid #004aad;
    padding-bottom:10px;
    margin-bottom:20px;
}
.form-group{
    margin-bottom:15px;
}
label{
    font-weight:bold;
    display:block;
    margin-bottom:5px;
}
input, textarea{
    width:100%;
    padding:8px;
    border:1px solid #ccc;
    border-radius:5px;
}
button{
    background:#004aad;
    color:white;
    padding:10px 20px;
    border:none;
    border-radius:5px;
    cursor:pointer;
}
button:hover{
    background:#003580;
}
.info-box{
    background:#eef3ff;
    padding:15px;
    margin-bottom:20px;
    border-left:4px solid #004aad;
}
</style>
</head>
<body>

<div class="container">

<h2>Ubah Data Peserta</h2>

<div class="info-box">
Data berikut dapat diperbarui oleh petugas. 
Data utama seperti nama siswa, nilai dan jurusan tidak dapat diubah.
</div>

<form method="POST">

<div class="form-group">
<label>Nama Ayah</label>
<input type="text" name="nama_ayah" value="<?= $data['nama_ayah']; ?>">
</div>

<div class="form-group">
<label>Nama Ibu</label>
<input type="text" name="nama_ibu" value="<?= $data['nama_ibu']; ?>">
</div>

<div class="form-group">
<label>Alamat Lengkap</label>
<textarea name="alamat"><?= $data['alamat_lengkap']; ?></textarea>
</div>

<div class="form-group">
<label>NIK</label>
<input type="text" name="nik" value="<?= $data['nik']; ?>">
</div>

<div class="form-group">
<label>NISN</label>
<input type="text" name="nisn" value="<?= $data['nisn']; ?>">
</div>

<div class="form-group">
<label>Tempat Lahir</label>
<input type="text" name="tempat_lahir" value="<?= $data['tempat_lahir']; ?>">
</div>

<div class="form-group">
<label>Tanggal Lahir</label>
<input type="date" name="tanggal_lahir" value="<?= $data['tanggal_lahir']; ?>">
</div>

<div class="form-group">
<label>Penghasilan Orang Tua / Bulan</label>
<input type="text" name="penghasilan" value="<?= $data['penghasilan_ortu']; ?>">
</div>

<button type="submit" name="update">Perbarui Data</button>

</form>

</div>

</body>
</html>
