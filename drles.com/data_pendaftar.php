<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['petugas'])) {
    header("Location: login_petugas.php");
    exit();
}

if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $aksi=$_GET['aksi'];
    $id=$_GET['id'];
    mysqli_query($conn,"UPDATE pendaftaran SET status='$aksi' WHERE id='$id'");
    header("Location: data_pendaftar.php");
}

if (isset($_GET['hapus'])) {
    $id=$_GET['hapus'];
    mysqli_query($conn,"DELETE FROM pendaftaran WHERE id='$id'");
    header("Location: data_pendaftar.php");
}
?>

<link rel="stylesheet" href="style.css">

<div class="header">
<a href="dashboard_petugas.php" class="back-btn">⬅</a>
DATA PENDAFTAR
</div>

<div class="container">
<div class="card">

<table width="100%" cellpadding="8">
<tr style="background:#0066cc;color:white;">
<th>No</th>
<th>Nama</th>
<th>Jurusan</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php
$no=1;
$data=mysqli_query($conn,"SELECT * FROM pendaftaran");

while($row=mysqli_fetch_assoc($data)){
echo "<tr>
<td>$no</td>
<td>$row[nama]</td>
<td>$row[jurusan]</td>
<td><b>$row[status]</b></td>
<td>

<a href='detail_pendaftar.php?id=$row[id]'>
<button class='btn-biru'>Detail</button>
</a>

<a href='ubah_peserta.php?id=$row[id]'>
<button class='btn-biru'>Ubah Data Peserta</button>
</a>

<a href='?aksi=Layak Seleksi&id=$row[id]'>
<button class='btn-kuning'>Layak</button>
</a>

<a href='?aksi=Diterima&id=$row[id]'>
<button class='btn-hijau'>Terima</button>
</a>

<a href='?aksi=Ditolak&id=$row[id]'>
<button class='btn-merah'>Tolak</button>
</a>

<a href='?hapus=$row[id]' onclick=\"return confirm('Yakin ingin menghapus data ini?')\">
<button class='btn-merah'>Hapus</button>
</a>

</td>
</tr>";
$no++;
}
?>

</table>

</div>
</div>
