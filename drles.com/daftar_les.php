<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "koneksi.php";

if(!isset($_SESSION['siswa'])){
    die("Silakan login dulu.");
}

$email = $_SESSION['siswa'];

/* Ambil data siswa */
$q = mysqli_query($conn,"SELECT * FROM pendaftaran WHERE siswa_email='$email'");
$data = mysqli_fetch_assoc($q);

if(!$data){
    die("Data siswa tidak ditemukan.");
}

/* Cek apakah sudah daftar */
$cekSudah = mysqli_query($conn,"
SELECT * FROM daftar_les 
WHERE siswa_email='$email'
ORDER BY id DESC LIMIT 1
");
$sudah = mysqli_fetch_assoc($cekSudah);


/* PROSES DAFTAR */
if(isset($_POST['daftar']) && !$sudah){

    $jadwal_id = $_POST['jadwal_id'];

    $ambil = mysqli_query($conn,"SELECT * FROM jadwal_tutor WHERE id='$jadwal_id'");
    $jadwal = mysqli_fetch_assoc($ambil);

    if(!$jadwal){
        die("Jadwal tidak ditemukan.");
    }

    /* Hitung jumlah siswa di jadwal ini */
    $cek = mysqli_query($conn,"SELECT COUNT(*) as total 
    FROM daftar_les 
    WHERE tutor='".$jadwal['nama_tutor']."' 
    AND tanggal='".$jadwal['tanggal']."'");

    $row = mysqli_fetch_assoc($cek);
    $total_daftar = $row['total'];

    list($jam_mulai, $jam_selesai) = explode("-", $jadwal['jam']);

    $start = strtotime(trim($jam_mulai));
    $end   = strtotime(trim($jam_selesai));

    $durasi_total = ($end - $start) / 60;
    $slot = 30;
    $max_siswa = floor($durasi_total / $slot);

    if($total_daftar >= $max_siswa){
        echo "<script>alert('Jadwal sudah penuh!');</script>";
    } else {

        $waktu_mulai = strtotime("+".($total_daftar * $slot)." minutes", $start);
        $waktu_selesai = strtotime("+".$slot." minutes", $waktu_mulai);

        $jam_mulai_final = date("H:i", $waktu_mulai);
        $jam_selesai_final = date("H:i", $waktu_selesai);

        $nomor_permintaan = "REQ".date("Ymd").rand(100,999);

        mysqli_query($conn,"INSERT INTO daftar_les 
        (nomor_permintaan,siswa_email,no_peserta,nama,
        mata_pelajaran,tutor,tanggal,jam,
        waktu_mulai,waktu_selesai)
        VALUES
        ('$nomor_permintaan',
        '$email',
        '".$data['no_pendaftaran']."',
        '".$data['nama']."',
        '".$jadwal['mata_pelajaran']."',
        '".$jadwal['nama_tutor']."',
        '".$jadwal['tanggal']."',
        '".$jadwal['jam']."',
        '$jam_mulai_final',
        '$jam_selesai_final')
        ");

        echo "<script>alert('Berhasil daftar les!'); window.location='daftar_les.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Pendaftaran Les</title>
<style>
body{font-family:Arial;background:#f4f6f9;padding:40px;}
.card{background:white;padding:25px;width:600px;margin:auto;border-radius:10px;box-shadow:0 0 15px #ccc;}
label{display:block;margin-top:15px;font-weight:bold;}
select,input{width:100%;padding:8px;margin-top:5px;}
button{margin-top:20px;padding:10px;width:100%;background:#007bff;color:white;border:none;border-radius:5px;}
.success{background:#e9ffe9;padding:15px;border-radius:8px;margin-top:20px;}
</style>
</head>
<body>

<div class="card">

<h2>Pendaftaran Les</h2>

<?php if($sudah){ 

    $tanggal = date("d F Y", strtotime($sudah['tanggal']));
    $jam_final = $sudah['waktu_mulai']."-".$sudah['waktu_selesai'];
?>

<div class="success">
<b>Anda sudah terdaftar les.</b><br><br>

Tutor : <?= $sudah['tutor']; ?><br>
Mapel : <?= $sudah['mata_pelajaran']; ?><br>
Tanggal : <?= $tanggal; ?><br>
Jam : <?= $jam_final; ?><br>
Nomor Permintaan : <?= $sudah['nomor_permintaan']; ?><br>
</div>

<br>
<a href="lihat_surat.php">
<button>Lihat Surat Rencana Les</button>
</a>

<?php } else { ?>

<form method="POST">

<label>Nama</label>
<input type="text" value="<?= $data['nama']; ?>" readonly>

<label>Nomor Peserta</label>
<input type="text" value="<?= $data['no_pendaftaran']; ?>" readonly>

<label>Pilih Jadwal Tutor</label>
<select name="jadwal_id" required>
<option value="">-- Pilih Jadwal --</option>

<?php
$jadwal = mysqli_query($conn,"SELECT * FROM jadwal_tutor WHERE status='tersedia' ORDER BY tanggal ASC");

while($j = mysqli_fetch_assoc($jadwal)){
    $tgl = date("d/m/Y",strtotime($j['tanggal']));
    echo "<option value='$j[id]'>
    $j[nama_tutor] | $j[mata_pelajaran] | $tgl | $j[jam]
    </option>";
}
?>

</select>

<button type="submit" name="daftar">Daftar Les</button>

</form>

<?php } ?>

</div>

</body>
</html>
