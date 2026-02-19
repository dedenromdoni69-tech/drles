<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("Location: login_siswa.php");
    exit();
}

$email = $_SESSION['siswa'];

if(isset($_POST['simpan'])){

    mysqli_query($conn,"UPDATE pendaftaran SET
    nama='$_POST[nama]',
    tempat_lahir='$_POST[tempat_lahir]',
    tanggal_lahir='$_POST[tanggal_lahir]',
    nisn='$_POST[nisn]',
    asal_sekolah='$_POST[asal_sekolah]',
    alamat_jalan='$_POST[alamat_jalan]',
    kelurahan='$_POST[kelurahan]',
    kecamatan='$_POST[kecamatan]',
    kabupaten='$_POST[kabupaten]',
    provinsi='$_POST[provinsi]',
    nama_ortu='$_POST[nama_ortu]',
    pekerjaan_ortu='$_POST[pekerjaan_ortu]',
    anak_ke='$_POST[anak_ke]'
    WHERE siswa_email='$email'");

    echo "<script>alert('Profil berhasil disimpan'); 
    window.location='profil_siswa.php';</script>";
}

$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE siswa_email='$email'"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Ubah Profil</title>
<link rel="stylesheet" href="style_siswa.css">
</head>
<body>

<div class="sidebar">
    <h2>DR LES</h2>
    <a href="dashboard_siswa.php">🏠 Dashboard</a>
    <a href="profil_siswa.php" class="active">👤 Cek Profil</a>
    <a href="status_pendaftaran.php">📋 Status Pendaftaran</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main-content">

<div class="card">
<h2>Ubah Profil</h2>

<form method="post">

<input type="text" name="nama" value="<?php echo $data['nama']; ?>" placeholder="Nama Lengkap" required>

<input type="text" name="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" placeholder="Tempat Lahir">

<input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>">

<input type="text" name="nisn" value="<?php echo $data['nisn']; ?>" placeholder="NISN">

<input type="text" name="asal_sekolah" value="<?php echo $data['asal_sekolah']; ?>" placeholder="Asal Sekolah">

<hr>

<h3>Alamat Siswa</h3>

<input type="text" name="alamat_jalan" value="<?php echo $data['alamat_jalan']; ?>" placeholder="Nama Jalan / Kampung">

<input type="text" name="kelurahan" value="<?php echo $data['kelurahan']; ?>" placeholder="Kelurahan">

<input type="text" name="kecamatan" value="<?php echo $data['kecamatan']; ?>" placeholder="Kecamatan">

<input type="text" name="kabupaten" value="<?php echo $data['kabupaten']; ?>" placeholder="Kab/Kota">

<input type="text" name="provinsi" value="<?php echo $data['provinsi']; ?>" placeholder="Provinsi">

<hr>

<h3>Data Orang Tua</h3>

<input type="text" name="nama_ortu" value="<?php echo $data['nama_ortu']; ?>" placeholder="Nama Orang Tua">

<input type="text" name="pekerjaan_ortu" value="<?php echo $data['pekerjaan_ortu']; ?>" placeholder="Pekerjaan Orang Tua">

<input type="number" name="anak_ke" value="<?php echo $data['anak_ke']; ?>" placeholder="Anak ke-">

<br><br>

<button name="simpan" class="btn-success">Simpan Profil</button>

</form>

</div>

</div>

</body>
</html>
