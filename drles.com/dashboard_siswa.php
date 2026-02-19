<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("Location: login_siswa.php");
    exit();
}

$email = strtolower($_SESSION['siswa']);

$query = mysqli_query($conn,"SELECT * FROM pendaftaran WHERE LOWER(siswa_email)='$email'");
$data = mysqli_fetch_assoc($query);

$tanggal = date("l, d F Y");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Siswa - DR Private Tutoring</title>
<style>

body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background: linear-gradient(135deg,#0d47a1,#1976d2);
}

.header{
    background:white;
    padding:15px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
}

.header h2{
    margin:0;
    color:#0d47a1;
}

.container{
    padding:40px;
}

.welcome{
    background:white;
    padding:20px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.menu-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.menu-box{
    background:white;
    padding:30px;
    text-align:center;
    border-radius:12px;
    text-decoration:none;
    color:#0d47a1;
    font-weight:bold;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
    transition:0.3s;
}

.menu-box:hover{
    transform:translateY(-5px);
}

.popup-diterima{
    background:#2ecc71;
    color:white;
    padding:15px;
    border-radius:8px;
    margin-bottom:15px;
    font-weight:bold;
    animation:slideDown 0.5s ease;
}

.popup-ditolak{
    background:#e74c3c;
    color:white;
    padding:15px;
    border-radius:8px;
    margin-bottom:15px;
    font-weight:bold;
    animation:slideDown 0.5s ease;
}

@keyframes slideDown{
    from{ transform:translateY(-20px); opacity:0;}
    to{ transform:translateY(0); opacity:1;}
}

.nomor{
    font-size:18px;
    font-weight:bold;
    color:#0d47a1;
}

</style>
</head>
<body>

<div class="header">
    <h2>DR LES 2026</h2>
    <div><?php echo $tanggal; ?></div>
</div>

<div class="container">

<?php
if($data && $data['status']=="Diterima"){
?>
<div class="popup-diterima">
     Selamat Anda Dinyatakan Diterima di Mapel/Jurusan <?php echo $data['jurusan']; ?>
</div>
<?php
}

if($data && $data['status']=="Ditolak"){
?>
<div class="popup-ditolak">
    Mohon Maaf, Anda Belum Diterima di Mapel/Jurusan <?php echo $data['jurusan']; ?>
</div>
<?php
}
?>

<div class="welcome">
    <h3>Selamat Datang <?php echo $data ? $data['nama'] : ''; ?></h3>

    <?php if($data && $data['no_pendaftaran']){ ?>
        <div class="nomor">
            Nomor Peserta: <?php echo $data['no_pendaftaran']; ?>
        </div>
    <?php } ?>
</div>

<div class="menu-grid">

<?php if(!$data){ ?>
<a href="form_pendaftaran.php" class="menu-box">
    Isi Biodata & Daftar
</a>
<?php } ?>

<a href="profil_siswa.php" class="menu-box">
    Cek Profil
</a>

<a href="status_pendaftaran.php" class="menu-box">
    Cek Status Pendaftaran
</a>

<a href="daftar_les.php" class="menu-box">
    Pendaftaran Les
</a>

<a href="cek_penerima.php" class="menu-box">
    Cek Penerima
</a>

<?php if($data && $data['status']=="Diterima"){ ?>
<a href="cetak_bukti.php" class="menu-box">
    Cetak Bukti Diterima
</a>
<?php } ?>

<a href="logout.php" class="menu-box">
    Logout
</a>

</div>

</div>

</body>
</html>
