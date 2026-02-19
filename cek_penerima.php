<?php
session_start();
include "koneksi.php";

$query = mysqli_query($conn,"
SELECT no_pendaftaran,nama,asal_sekolah,
IFNULL(skor,0) as skor,
jurusan
FROM pendaftaran
WHERE status='Diterima'
ORDER BY CAST(skor AS UNSIGNED) DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Cek Penerima</title>
<style>
body{
    margin:0;
    font-family: Arial;
    background: linear-gradient(135deg,#0d47a1,#1976d2);
}
.header{
    background:white;
    padding:15px 30px;
    font-weight:bold;
    color:#0d47a1;
}
.container{
    padding:40px;
}
.card{
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#0d47a1;
    color:white;
}
th,td{
    padding:10px;
    text-align:center;
}
tr:nth-child(even){
    background:#f2f2f2;
}
.ranking1{
    background:#fff8dc;
    font-weight:bold;
}
</style>
</head>
<body>

<div class="header">
DR LES 2026 - Daftar Siswa Diterima
</div>

<div class="container">
<div class="card">

<table border="1">
<tr>
<th>Urut</th>
<th>No Pendaftaran</th>
<th>Nama</th>
<th>Asal Sekolah</th>
<th>Skor</th>
<th>Jurusan</th>
</tr>

<?php
$ranking=1;
while($row=mysqli_fetch_assoc($query)){

$class = ($ranking==1) ? "ranking1" : "";

echo "<tr class='$class'>
<td>$ranking</td>
<td>".$row['no_pendaftaran']."</td>
<td>".$row['nama']."</td>
<td>".$row['asal_sekolah']."</td>
<td>".$row['skor']."</td>
<td>".$row['jurusan']."</td>
</tr>";

$ranking++;
}
?>

</table>

</div>
</div>

</body>
</html>
