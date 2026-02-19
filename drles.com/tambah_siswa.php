<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['petugas'])) {
    header("Location: login_petugas.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $cek = mysqli_query($conn,"SELECT * FROM akun_siswa WHERE email='$email'");

    if (mysqli_num_rows($cek) > 0) {
        $pesan = "Email sudah terdaftar!";
    } else {
        mysqli_query($conn,"INSERT INTO akun_siswa (email) VALUES ('$email')");
        $pesan = "Email berhasil ditambahkan!";
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn,"DELETE FROM akun_siswa WHERE id='$id'");
    header("Location: tambah_siswa.php");
}
?>

<link rel="stylesheet" href="style.css">

<div class="header">
    <a href="dashboard_petugas.php" class="back-btn">⬅</a>
    AKUN SISWA
</div>

<div class="container">

<div class="card">

<h2>Tambah Email</h2>

<?php if(isset($pesan)){ echo "<div class='alert'>$pesan</div>"; } ?>

<form method="post">
<input type="email" name="email" placeholder="Masukkan Email Siswa" required>
<button name="simpan" class="btn-biru">Simpan</button>
</form>

<hr>

<h3>Daftar Email Terdaftar</h3>

<table width="100%" cellpadding="8">
<tr style="background:#0066cc;color:white;">
<th>No</th>
<th>Email</th>
<th>Nama (Jika Sudah Daftar)</th>
<th>Aksi</th>
</tr>

<?php
$no=1;
$data=mysqli_query($conn,"
SELECT akun_siswa.id, akun_siswa.email, pendaftaran.nama 
FROM akun_siswa 
LEFT JOIN pendaftaran 
ON akun_siswa.email = pendaftaran.siswa_email
");

while($row=mysqli_fetch_assoc($data)){
echo "<tr>
<td>$no</td>
<td>$row[email]</td>
<td>$row[nama]</td>
<td>
<a href='?hapus=$row[id]'>
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
