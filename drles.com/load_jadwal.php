<?php
include "koneksi.php";

$mapel = $_POST['mapel'];

$q = mysqli_query($conn,"SELECT * FROM jadwal_tutor WHERE mata_pelajaran='$mapel' ORDER BY tanggal ASC");

echo "<label>Pilih Jadwal Tutor</label>";
echo "<select name='jadwal_id' required>";

while($d = mysqli_fetch_assoc($q)){

$tanggal = date("d/m/Y",strtotime($d['tanggal']));

if($d['status']=="tersedia"){
echo "<option value='$d[id]'>
$d[nama_tutor] | $tanggal | $d[jam]
</option>";
}else{
echo "<option disabled>
$d[nama_tutor] | $tanggal | Tidak tersedia
</option>";
}

}

echo "</select>";
?>
