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

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>MadingJWP</title>
  <link rel="stylesheet" type="text/css" href="article_about_page.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
	<div class="nav">
        <div class="logo">MadingJWP</div>

        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="login-page.php">Login</a></li>
            <li><a href="article-about-page.php">Tentang</a></li>
        </ul>
        
        <div class="search-bar">
            <form action="index.php" method="GET">
                <input type="text" name="keyword" autocomplete="off" placeholder="Cari artikel">
                <button type="submit">Search</button>
            </form>
        </div>
	</div>

    <div class="content">
        <h2 class="about-title">Tentang MadingJWP</h2>
        <hr>

        <div class="about-content">
            <p>MadingJWP adalah platform sumber informasi yang didedikasikan untuk Sekolah Tinggi JWP. Dengan tujuan menyediakan akses mudah dan cepat terhadap berita, artikel, dan informasi terkini yang relevan dengan lingkungan sekolah, MadingJWP menjadi sumber utama bagi seluruh komunitas akademik di Sekolah Tinggi JWP. Melalui tampilan yang modern dan responsif, pengguna dapat dengan mudah menjelajahi berbagai topik, termasuk perkuliahan, kegiatan kampus, prestasi mahasiswa, dan informasi penting lainnya.<br><br>
            MadingJWP menawarkan fitur pencarian artikel yang memudahkan pengguna untuk menemukan konten berdasarkan kata kunci tertentu, sehingga informasi yang dibutuhkan dapat ditemukan dengan cepat. Platform ini juga memfasilitasi interaksi antar pengguna melalui fitur komentar pada setiap artikel, memberikan kesempatan untuk berdiskusi, bertukar ide, dan memberikan tanggapan terhadap berita dan topik yang dibahas. Dengan demikian, MadingJWP tidak hanya berfungsi sebagai sumber informasi terpercaya, tetapi juga sebagai sarana komunikasi yang mempererat ikatan komunitas akademik di Sekolah Tinggi JWP.</p>
        </div>
    </div> 

    <div class="footer">
        <div class="reach">
            <h3>Hubungi kami!<h3>

            <table>
                <tr>
                <td><i class="fa-solid fa-phone"></i></td>
                <td>+6281234567890</td>
                </tr>

                <tr>
                <td><i class="fa-solid fa-envelope"></i></td>
                <td>madingjwp@gmail.com</td>
                </tr>

                <tr>
                <td><i class="fa-solid fa-location-dot"></i></td>
                <td>Sekolah Tinggi JeWePe, Jl. Abcd, Depok</td>
                </tr>
            </table>
        </div>

        <div class="copyright">
            <p>Copyright © 2023 madingjwp.com. All Rights Reserved<p>
        </div>
    </div>
</body>
</html>