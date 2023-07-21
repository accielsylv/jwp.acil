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

$articleId = $_GET['id'];
$sql = "SELECT * FROM artikel WHERE id = $articleId";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . $sql . "<br>" . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$judul = $row['judul'];
$isi = $row['isi'];

$sqlKomentar = "SELECT * FROM komentar WHERE id_artikel = $articleId";
$resultKomentar = mysqli_query($conn, $sqlKomentar);

if (!$resultKomentar) {
    die("Error: " . $sqlKomentar . "<br>" . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>MadingJWP</title>
  <link rel="stylesheet" type="text/css" href="article_detail_page.css">
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
    <h2 class="article-title"><?php echo $judul; ?></h2>
    <hr>

    <div class="article-content">
        <p><?php echo nl2br($isi); ?></p>
        <p class="meta-info">Created at: <?php echo $row['created_at']; ?></p>
        <p class="meta-info">Updated at: <?php echo $row['updated_at']; ?></p>
    </div>

    <div class="article-comment">
        <h2>Komentar</h2>

        <?php
        if (mysqli_num_rows($resultKomentar) === 0) {
            echo '<p>Belum ada komentar</p>';
        } else {
            while ($rowKomentar = mysqli_fetch_assoc($resultKomentar)) {
                ?>
                <div class="user">
                    <h3 class="comment-username"><?php echo $rowKomentar['nama']; ?></h3>
                    <hr>
                    <p><?php echo nl2br($rowKomentar['isi_komentar']); ?></p>
                    <p class="meta-info">Created at: <?php echo $rowKomentar['created_at']; ?></P>
                </div>
                <?php
            }
        }
        ?>

        <h2>Tambahkan komentarmu!</h2>
        <form action="article-submit-comment.php" method="POST">
            <input type="hidden" name="article-id" value="<?php echo $articleId; ?>">
            <label for="comment-name">Nama</label><br>
            <input type="text" id="comment-name" class="box" name="comment-name" autocomplete="off" required placeholder="tuliskan nama!"><br>
            <label for="comment-email">Email</label><br>
            <input type="email" id="comment-email" class="box" name="comment-email" autocomplete="off" required placeholder="tuliskan email!"><br>
            <label for="comment">Komentar</label><br>
            <textarea id="comment" name="comment" autocomplete="off" required placeholder="tuliskan tanggapan!"></textarea><br>
            <input type="submit" value="Submit!" class="submit">
        </form>
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