<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['siswa'])) {
    header("Location: login_siswa.php");
    exit();
}

$email = $_SESSION['siswa'];

$data = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM pendaftaran WHERE siswa_email='$email'"));

if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $ortu = $_POST['ortu'];
    $kelas = $_POST['kelas'];
    $asal = $_POST['asal'];
    $jurusan = $_POST['jurusan'];
    $mtk = $_POST['mtk'];
    $indo = $_POST['indo'];
    $inggris = $_POST['inggris'];

    if($data){
        mysqli_query($conn,"UPDATE pendaftaran SET
            nama='$nama',
            nama_ortu='$ortu',
            kelas='$kelas',
            asal_sekolah='$asal',
            jurusan='$jurusan',
            nilai_mtk='$mtk',
            nilai_indo='$indo',
            nilai_inggris='$inggris'
            WHERE siswa_email='$email'");
    } else {
        mysqli_query($conn,"INSERT INTO pendaftaran
        (siswa_email,nama,nama_ortu,kelas,asal_sekolah,jurusan,nilai_mtk,nilai_indo,nilai_inggris,status)
        VALUES
        ('$email','$nama','$ortu','$kelas','$asal','$jurusan','$mtk','$indo','$inggris','Belum Finalisasi')");
    }

    header("Location: form_pendaftaran.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Form Pendaftaran</title>
<style>
body{font-family:Arial;background:#f4f6f9;padding:30px;}
.card{background:white;padding:30px;border-radius:10px;max-width:600px;margin:auto;box-shadow:0 5px 15px rgba(0,0,0,0.1);}
input,select{width:100%;padding:8px;margin:6px 0;}
button{padding:10px 15px;background:#1565c0;color:white;border:none;border-radius:6px;cursor:pointer;}
button:hover{background:#0d47a1;}
.lock{color:red;font-weight:bold;}
</style>
</head>
<body>

<div class="card">
<h2>Form Pendaftaran Murid Baru</h2>

<?php if($data && $data['status']!="Belum Finalisasi"){ ?>
<div class="lock">
Pendaftaran sudah difinalisasi dan tidak bisa diubah.
</div>
<?php } else { ?>

<form method="POST">

Nama Lengkap:
<input type="text" name="nama" value="<?= $data['nama'] ?? '' ?>" required>

Nama Orang Tua (Ayah/Wali):
<input type="text" name="ortu" value="<?= $data['nama_ortu'] ?? '' ?>" required>

Kelas:
<input type="text" name="kelas" value="<?= $data['kelas'] ?? '' ?>" required>

Asal Sekolah:
<input type="text" name="asal" value="<?= $data['asal_sekolah'] ?? '' ?>" required>

Jurusan Yang Diminati:
<select name="jurusan" required>
<option value="">-- Pilih Jurusan --</option>
<option value="Informatika Dasar" <?= ($data['jurusan']??'')=="Informatika Dasar"?'selected':'' ?>>Informatika Dasar</option>
<option value="Keagamaan" <?= ($data['jurusan']??'')=="Keagamaan"?'selected':'' ?>>Keagamaan</option>
<option value="Kewirausahaan" <?= ($data['jurusan']??'')=="Kewirausahaan"?'selected':'' ?>>Kewirausahaan</option>
</select>

Nilai Matematika:
<input type="number" name="mtk" value="<?= $data['nilai_mtk'] ?? '' ?>" required>

Nilai Bahasa Indonesia:
<input type="number" name="indo" value="<?= $data['nilai_indo'] ?? '' ?>" required>

Nilai Bahasa Inggris:
<input type="number" name="inggris" value="<?= $data['nilai_inggris'] ?? '' ?>" required>

<button name="simpan">Simpan</button>

</form>
<br>
<div style="background:#fff3cd;padding:12px;border-radius:6px;color:#856404;font-size:14px;">
⚠️ Setelah finalisasi dilakukan, data anda tidak dapat diubah kembali.
Pastikan semua data yang diinput sudah benar sebelum menekan tombol FINALISASI.
</div>

<?php if($data){ ?>
<br>
<a href="finalisasi.php">
<button>FINALISASI</button>
</a>
<?php } ?>

<?php } ?>

</div>
</body>
</html>
