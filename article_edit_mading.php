<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login-page.php");
    exit();
}

$host = "localhost:3306";
$username = "root";
$password = "";
$database = "dbmading";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $sql = "SELECT * FROM artikel WHERE id = $articleId";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error: " . $sql . "<br>" . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $judul = $row['judul'];
    $isi = $row['isi'];
} else {
    header("Location: admin-dashboard-page.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newJudul = $_POST['article-title'];
    $newIsi = $_POST['article-content'];

    $updateSql = "UPDATE artikel SET judul = '$newJudul', isi = '$newIsi', updated_at = NOW() WHERE id = $articleId";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        mysqli_close($conn);
        header("Location: admin-dashboard-page.php");
        exit();
    } else {
        die("Error: " . $updateSql . "<br>" . mysqli_error($conn));
    }
}
?>
