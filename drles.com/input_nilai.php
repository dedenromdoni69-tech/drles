<?php
session_start();
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Input Nilai Siswa</title>
<style>
body{
    font-family:Arial;
    background:linear-gradient(135deg,#0d47a1,#1976d2);
    margin:0;
}
.container{
    padding:40px;
}
.card{
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
    max-width:600px;
    margin:auto;
}
input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
}
button{
    background:#0d47a1;
    color:white;
    border:none;
    padding:10px 15px;
    cursor:pointer;
}
</style>
</head>
<body>

<div class="container">
<div class="card">

<h3>Cari Siswa</h3>

<form method="POST">
<input type="text" name="no_pendaftaran" placeholder="Masukkan Nomor Peserta" required>
<button type="submit" name="cari">Cari</button>
</form>

<?php
if(isset($_POST['cari'])){
    $no = $_POST['no_pendaftaran'];
    $q = mysqli_query($conn,"SELECT * FROM pendaftaran WHERE no_pendaftaran='$no'");
    $data = mysqli_fetch_assoc($q);

    if($data){
?>

<hr>
<h4>Data Siswa</h4>
Nama: <?php echo $data['nama']; ?><br>
Email: <?php echo $data['siswa_email']; ?><br><br>

<a href="proses_nilai.php?id=<?php echo $data['id']; ?>">
<button type="button">Selanjutnya Input Nilai</button>
</a>

<?php
    }else{
        echo "<p style='color:red;'>Nomor peserta tidak ditemukan!</p>";
    }
}
?>

</div>
</div>

</body>
</html>
