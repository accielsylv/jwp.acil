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

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$sql = "SELECT id, judul, isi FROM artikel WHERE judul LIKE '%$keyword%' ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
  die("Error: " . $sql . "<br>" . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>MadingJWP</title>
  <link rel="stylesheet" type="text/css" href="index.css">
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
        <input type="text" name="keyword" autocomplete="off" placeholder="Cari artikel" value="<?php echo $keyword; ?>">
        <button type="submit">Search</button>
      </form>
    </div>
	</div>

  <div class="content">
    <?php
            if (mysqli_num_rows($result) === 0) {
                if ($keyword === '') {
                    echo '<h2 class="description-content">Belum ada artikel dibuat</h2>';
                } else {
                    echo '<p>Artikel dengan keyword "' . $keyword . '" tidak ada</p>';
                }
            } else {
                echo '<h2 class="description-content">Artikel terbaru</h2>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $articleId = $row['id'];
                    $judul = $row['judul'];
                    $isi = $row['isi'];
                    $highlightedTitle = preg_replace('/' . preg_quote($keyword, '/') . '/i', '<span class="highlight">$0</span>', $judul);
        ?>
      <div class="article-box" onclick="location.href='article-detail-page.php?id=<?php echo $articleId; ?>'">
        <h3 class="article-title"><?php echo $highlightedTitle; ?></h3>
        <hr>
        <p class="article-description"><?php echo nl2br($isi); ?></p>
      </div>
      <?php } } ?>
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