<?php
session_start();
include "koneksi.php";

$email = $_SESSION['siswa'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE siswa_email='$email'"));

if($data && $data['status']=="Belum Finalisasi"){

    $random = rand(1000,9999);
    $no = "DRPT2026".$random;

    mysqli_query($conn,"UPDATE pendaftaran SET
        status='Menunggu Seleksi',
        no_pendaftaran='$no'
        WHERE siswa_email='$email'");
}

header("Location: bukti_finalisasi.php");
?>
