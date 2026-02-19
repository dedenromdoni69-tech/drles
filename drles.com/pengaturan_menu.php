<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "koneksi.php";

if(!$conn){
    die("Koneksi database gagal.");
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    mysqli_query($conn,"
        UPDATE menu_siswa 
        SET status = CASE 
            WHEN status='Aktif' THEN 'Nonaktif'
            ELSE 'Aktif'
        END
        WHERE id='$id'
    ");
    header("Location: pengaturan_menu.php");
    exit();
}

$data = mysqli_query($conn,"SELECT * FROM menu_siswa");
?>

<!DOCTYPE html>
<html>
<head>
<title>Pengaturan Menu</title>
</head>
<body>

<h2>Pengaturan Menu Siswa</h2>

<table border="1" cellpadding="10">
<tr>
<th>Nama Menu</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $row['menu_siswa']; ?></td>
<td><?= $row['status']; ?></td>
<td>
<a href="?id=<?= $row['id']; ?>">Ubah Status</a>
</td>
</tr>
<?php } ?>

</table>

</body>
</html>
