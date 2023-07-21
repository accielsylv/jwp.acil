<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login-page.php");
    exit();
}

$username = $_SESSION['username'];

$host = "localhost:3306";
$db_username = "root";
$db_password = "";
$database = "dbmading";

$conn = mysqli_connect($host, $db_username, $db_password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$queryArtikel = "SELECT COUNT(*) AS total_artikel FROM artikel";
$resultArtikel = mysqli_query($conn, $queryArtikel);

if (!$resultArtikel) {
    die("Error: " . $queryArtikel . "<br>" . mysqli_error($conn));
}

$rowArtikel = mysqli_fetch_assoc($resultArtikel);
$totalArtikel = $rowArtikel['total_artikel'];

$queryKomentar = "SELECT COUNT(*) AS total_komentar FROM komentar";
$resultKomentar = mysqli_query($conn, $queryKomentar);

if (!$resultKomentar) {
    die("Error: " . $queryKomentar . "<br>" . mysqli_error($conn));
}

$rowKomentar = mysqli_fetch_assoc($resultKomentar);
$totalKomentar = $rowKomentar['total_komentar'];

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>MadingJWP</title>
    <link rel="stylesheet" type="text/css" href="admin_dashboard_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
	<div class="nav">
        <div class="logo">MadingJWP</div>

        <div class="menu">
            <a class="margin" href="index.php">Home</a>
            <a href="article-about-page.php">Tentang</a>
        </div>

        <div class="admin-profile">
            <i class="fa-solid fa-user"></i>
     	    <h3>Hai <?php echo $username; ?>!</h3>
        </div>
	</div>

    <div class="content">
        <div class="article-view">
            <div class="view">
                <div class="span">
                    <span><i class="fa-solid fa-book"></i></span>
                    <span><?php echo $totalArtikel; ?></span>
                </div>
                
                <h3>Total Artikel</h3>
            </div>

            <div class="create-view">
                <a href="admin-create-page.php">Buat artikel baru</a>
                <a href="admin-article-view.php">Lihat artikel list</a>
            </div>
        </div>

        <div class="comment-view">
            <div class="view">
                <div class="span">
                    <span><i class="fa-solid fa-comments"></i></span>
                    <span><?php echo $totalKomentar; ?></span>
                </div>
                
                <h3>Total komentar</h3>
            </div>

            <div class="create-view">
                <a href="admin-comment-view.php">Lihat komentar list</a>
            </div>
        </div>

        <form action="logout_mading.php" method="POST">
            <div class="button">
                <input type="submit" value="Logout!">
            </div>
        </form>
    </div>

    <div class="footer">
        <div class="copyright">
            <p>Copyright © 2023 madingjwp.com. All Rights Reserved<p>
        </div>
    </div>
</body>
</html>