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
    header("Location: admin-article-view.php");
    exit();
}

$articleId = $_GET['id'];

$sql = "DELETE FROM artikel WHERE id = $articleId";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . $sql . "<br>" . mysqli_error($conn));
}

mysqli_close($conn);

header("Location: admin-article-view.php");
exit();
?>
