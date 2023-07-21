<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login-page.php");
    exit();
}

$username = $_SESSION['username'];

// Koneksi ke database
$host = "localhost:3306";
$dbUsername = "root";
$dbPassword = "";
$database = "dbmading";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    header("Location: admin-comment-view.php");
    exit();
}

$komentarId = $_GET['id'];

$sql = "DELETE FROM komentar WHERE id = $komentarId";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . $sql . "<br>" . mysqli_error($conn));
}

mysqli_close($conn);

header("Location: admin-comment-view.php");
exit();
?>