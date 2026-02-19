<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn,
        "SELECT * FROM petugas WHERE username='$username' AND password='$password'"
    );

    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['petugas'] = $username;
        header("Location: dashboard_petugas.php");
    } else {
        echo "<script>alert('Login gagal!');</script>";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="login-body">
    <div class="login-card">
        <h2>DR PRIVATE TUTORING</h2>
        <p style="margin-bottom:20px;">Login Tutor/Admin</p>

        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="login">Masuk</button>
        </form>

        <a href="login_siswa.php" class="login-link">Login sebagai Siswa</a>
    </div>
</div>
