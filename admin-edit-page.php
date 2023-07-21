<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login-page.php");
    exit();
}

$username = $_SESSION['username'];
$greeting = "Hai " . $username . "!";

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

    mysqli_close($conn);
} else {
    header("Location: admin-dashboard-page.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>MadingJWP</title>
    <link rel="stylesheet" type="text/css" href="admin_edit_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
	<div class="nav">
        <div class="logo">MadingJWP</div>
        
        <div class="admin-profile">
            <i class="fa-solid fa-user"></i>
     	    <h3><?php echo $greeting; ?></h3>
        </div>
	</div>

    <div class="content">
        <div class="admin-create-box">
            <h2>Ubah artikel</h2>
            <form action="article_edit_mading.php?id=<?php echo $articleId; ?>" method="POST">
              <label for="article-title">Judul artikel</label><br>
              <input type="text" id="article-title" class="title" name="article-title" autocomplete="off" required value="<?php echo $judul; ?>"><br>
              <label for="article-content">Tuliskan isi artikel</label><br>
              <textarea id="article-content" name="article-content" autocomplete="off" required><?php echo str_replace(array("<br>", "<br/>", "<br />"), "", nl2br($isi)); ?></textarea><br>
              <button class="cancel" onclick="location.href='admin-dashboard-page.php'">Cancel</button>
              <input type="submit" value="Ubah!" class="ubah">
            </form>
          </div>
    </div>

    <div class="footer">
        <div class="copyright">
            <p>Copyright © 2023 madingjwp.com. All Rights Reserved<p>
        </div>
    </div>
</body>
</html>