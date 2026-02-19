<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['petugas'])){
    header("Location: login_petugas.php");
    exit;
}

if(isset($_POST['simpan'])){
    mysqli_query($conn,"INSERT INTO jadwal_tutor
    (nama_tutor,mata_pelajaran,tanggal,jam,status)
    VALUES
    ('$_POST[nama_tutor]',
     '$_POST[mapel]',
     '$_POST[tanggal]',
     '$_POST[jam]',
     '$_POST[status]')");
}
?>

<h2>Manajemen Jadwal Tutor</h2>

<form method="POST">
Nama Tutor:
<input type="text" name="nama_tutor" required><br><br>

Mata Pelajaran:
<select name="mapel">
<option>Informatika</option>
<option>Keagamaan</option>
<option>Kewirausahaan</option>
</select><br><br>

Tanggal:
<input type="date" name="tanggal" required><br><br>

Jam:
<input type="text" name="jam" placeholder="08:00 - 09:00" required><br><br>

Status:
<select name="status">
<option value="tersedia">Tersedia</option>
<option value="tidak">Tidak Tersedia</option>
</select><br><br>

<button name="simpan">Simpan</button>
</form>

<hr>

<table border="1" cellpadding="8">
<tr>
<th>Tutor</th>
<th>Mapel</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Status</th>
</tr>

<?php
$q = mysqli_query($conn,"SELECT * FROM jadwal_tutor ORDER BY tanggal ASC");
while($d=mysqli_fetch_assoc($q)){
echo "<tr>
<td>$d[nama_tutor]</td>
<td>$d[mata_pelajaran]</td>
<td>".date('d/m/Y',strtotime($d['tanggal']))."</td>
<td>$d[jam]</td>
<td>$d[status]</td>
</tr>";
}
?>
</table>
