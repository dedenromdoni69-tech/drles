<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("Location: login_siswa.php");
}

if (isset($_POST['daftar'])) {
    $email = $_SESSION['siswa'];
    $nama = $_POST['nama'];
    $mapel = $_POST['mapel'];
    $nilai = $_POST['nilai'];

    mysqli_query($conn,
        "INSERT INTO pendaftaran (siswa_email,nama,mata_pelajaran,nilai)
        VALUES ('$email','$nama','$mapel','$nilai')"
    );

    echo "Pendaftaran berhasil!";
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">

<div class="sidebar">
    <h3>DR LES</h3>
    <a href="dashboard_siswa.php">Dashboard</a>
    <a href="pendaftaran.php">Pendaftaran Les</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
<div class="card">
<h2>Form Pendaftaran Les</h2>

<form method="post">
    <input type="text" name="nama" placeholder="Nama Lengkap" required><br><br>
    <input type="text" name="mapel" placeholder="Mata Pelajaran" required><br><br>
    <input type="number" name="nilai" placeholder="Nilai Terakhir" required><br><br>

    <button type="submit" name="daftar" class="btn-biru">Daftar</button>
</form>

</div>
</div>
</div>
