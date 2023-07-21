<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login-page.php");
    exit();
}

// Ambil data dari form
$judul = $_POST['article-title'];
$isi = $_POST['article-content'];

// Lakukan koneksi ke database
$host = "localhost:3306";
$username = "root";
$password = "";
$database = "dbmading";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Escape karakter khusus dalam judul dan isi artikel
$judul = mysqli_real_escape_string($conn, $judul);
$isi = mysqli_real_escape_string($conn, $isi);

// Query untuk menyimpan data ke dalam tabel artikel
$sql = "INSERT INTO artikel (judul, isi, created_at, updated_at) VALUES ('$judul', '$isi', NOW(), NOW())";

if (mysqli_query($conn, $sql)) {
    // Redirect ke halaman admin-dashboard-page.php setelah data tersimpan
    header("Location: admin-dashboard-page.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
