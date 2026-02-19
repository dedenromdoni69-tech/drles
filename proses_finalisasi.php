<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("Location: login_siswa.php");
    exit();
}

$email = $_SESSION['siswa'];

// Cek apakah sudah punya nomor
$cek = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT no_pendaftaran FROM pendaftaran WHERE siswa_email='$email'"));

if(!$cek['no_pendaftaran']){

    do {
        // Random 6 digit benar-benar acak
        $random = mt_rand(100000,999999);
        $no_pendaftaran = "DR2026-" . $random;

        // Cek apakah sudah ada di database
        $cek_nomor = mysqli_query($conn,
        "SELECT id FROM pendaftaran WHERE no_pendaftaran='$no_pendaftaran'");

    } while(mysqli_num_rows($cek_nomor) > 0);

    // Simpan jika sudah pasti unik
    mysqli_query($conn,"UPDATE pendaftaran 
    SET no_pendaftaran='$no_pendaftaran',
    status='Menunggu Seleksi'
    WHERE siswa_email='$email'");
}

header("Location: dashboard_siswa.php");
exit();
?>
