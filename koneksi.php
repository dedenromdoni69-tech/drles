<?php
$conn = mysqli_connect("localhost","root","","drles");

if (!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
