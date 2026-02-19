<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn,$_POST['email']);

    $cek = mysqli_query($conn,"SELECT * FROM akun_siswa WHERE email='$email'");

    if ($cek && mysqli_num_rows($cek) > 0){
        $_SESSION['siswa'] = $email;
        header("Location: dashboard_siswa.php");
        exit();
    } else {
        $error = "Email belum didaftarkan oleh petugas!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Siswa</title>
<link rel="stylesheet" href="style.css">
</head>
<body class="bg-login">

<div class="login-card">

<h2>LOGIN SISWA</h2>

<?php if(isset($error)){ ?>
<div class="alert"><?php echo $error; ?></div>
<?php } ?>

<form method="post">
<input type="email" name="email" placeholder="Masukkan Email Terdaftar" required>
<button name="login" class="btn-primary">Masuk</button>
</form>

<br>
<a href="login_petugas.php">
<button class="btn-secondary">Daftar / Login Tutor</button>
</a>

</div>

</body>
</html>
