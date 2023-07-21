<?php
session_start();

$host = "localhost:3306";
$username = "root";
$password = "";
$database = "dbmading";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['comment-name'];
    $email = $_POST['comment-email'];
    $isi_komentar = $_POST['comment'];
    $articleId = $_POST['article-id'];

    if (empty($nama) || empty($email) || empty($isi_komentar)) {
        echo "Mohon isi semua field!";
        exit();
    }

    $sql = "INSERT INTO komentar (nama, email, id_artikel, isi_komentar, created_at) VALUES ('$nama', '$email', '$articleId', '$isi_komentar', NOW())";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: article-detail-page.php?id=$articleId");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
