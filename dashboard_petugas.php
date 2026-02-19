<?php
session_start();
if (!isset($_SESSION['petugas'])) {
    header("Location: login_petugas.php");
    exit();
}
?>

<link rel="stylesheet" href="style.css">

<div class="header">
    DR PRIVATE TUTORING - Deden Romdoni
</div>

<div class="container">

<h2 style="margin-bottom:20px;">SELAMAT DATANG, PETUGAS</h2>

<div class="menu-grid">

<a href="tambah_siswa.php" class="menu-box">
    📧<br><br>
    Tambah Akun<br>Calon Murid
</a>

<a href="data_pendaftar.php" class="menu-box">
    📢<br><br>
    Data Pendaftar
</a>

<a href="input_nilai.php" class="menu-box">
    📋<br><br>
    Input Nilai Murid
</a>

<a href="absen.php" class="menu-box">
    📖<br><br>
    Absensi Murid
</a>

<a href="petugas_jadwal_tutor.php" class="menu-box">
    👨‍🏫<br><br>
    Manajemen<br>Jadwal Tutor
</a>

<a href="petugas_data_les.php" class="menu-box">
    📚<br><br>
    Data<br>Pendaftaran Les
</a>

<a href="data_penerima.php" class="menu-box">
    🎓<br><br>
    Data Penerima
</a>

<a href="logout.php" class="menu-box">
    🚪<br><br>
    Logout
</a>

</div>

</div>
