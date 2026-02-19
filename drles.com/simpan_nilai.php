<?php
include "koneksi.php";

$id = $_POST['id'];
$inf = $_POST['informatika'];
$keag = $_POST['keagamaan'];
$kewira = $_POST['kewirausahaan'];
$adab = $_POST['adab'];

mysqli_query($conn,"
UPDATE pendaftaran SET
nilai_informatika='$inf',
nilai_keagamaan='$keag',
nilai_kewirausahaan='$kewira',
nilai_komputer='$komp',
nilai_mkdt='$mkdt',
nilai_mwdpk='$mwdpk',
nilai_medpa='$medpa',
nilai_idjkd='$idjkd',
nilai_ddgdm='$ddgdm',
nilai_adab='$adab'
WHERE id='$id'
");

echo "<script>
alert('Nilai berhasil disimpan');
window.location='dashboard_petugas.php';
</script>";
