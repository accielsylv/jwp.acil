<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'afra' && $password === 'afra1234') {
        $_SESSION['username'] = $username;
        header("Location: admin-dashboard-page.php");
        exit();
    } else {
        $_SESSION['error'] = "Username atau password salah";
        header("Location: login-page.php?error=1");
        exit();
    }
}
?>