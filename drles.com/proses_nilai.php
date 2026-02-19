<?php
session_start();
include "koneksi.php";

if(!isset($_GET['id'])){
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

$query = mysqli_query($conn,"SELECT * FROM pendaftaran WHERE id='$id'");

if(mysqli_num_rows($query) == 0){
    die("Data siswa tidak ditemukan di database.");
}

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Input Nilai</title>
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
input,select{
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

<h3>Input Nilai - <?php echo $data['nama']; ?></h3>

<form method="POST" action="simpan_nilai.php">

<input type="hidden" name="id" value="<?php echo $data['id']; ?>">

<label>Nilai Informatika</label>
<input type="number" name="informatika" required>

<label>Nilai Keagamaan</label>
<input type="number" name="keagamaan" required>

<label>Nilai Kewirausahaan</label>
<input type="number" name="kewirausahaan" required>

<label>Nilai Dasar Komputer</label>
<input type="number" name="komputer" required>

<label>Nilai MKdT</label>
<input type="number" name="mkdt" required>

<label>Nilai MWdPK</label>
<input type="number" name="mwdpk" required>

<label>Nilai MEdPA</label>
<input type="number" name="medpa" required>

<label>Nilai IdJKD</label>
<input type="number" name="idjkd" required>

<label>Nilai DdGdM</label>
<input type="number" name="ddgdm" required>

<label>Adab & Karakter</label>
<select name="adab" required>
<option value="Sangat Baik">Sangat Baik</option>
<option value="Baik">Baik</option>
<option value="Cukup">Cukup</option>
<option value="Kurang">Kurang</option>
</select>

<button type="submit">Simpan Nilai</button>

</form>

</div>
</div>

</body>
</html>
