<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login-page.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>MadingJWP</title>
    <link rel="stylesheet" type="text/css" href="admin_create_page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
	<div class="nav">
        <div class="logo">MadingJWP</div>
        
        <div class="admin-profile">
            <i class="fa-solid fa-user"></i>
     	    <h3>Hai <?php echo $username; ?>!</h3>
        </div>
	</div>

    <div class="content">
        <div class="admin-create-box">
            <h2>Buat artikel baru</h2>
            <form action="article_create_mading.php" method="POST">
              <label for="article-title">Judul artikel</label><br>
              <input type="text" id="article-title" class="title" name="article-title" autocomplete="off" required placeholder="tuliskan judul artikel!"><br>
              <label for="article-content">Tuliskan isi artikel</label><br>
              <textarea id="article-content" name="article-content" autocomplete="off" required placeholder="tuliskan isi artikel!"></textarea><br>
              <button class="cancel" onclick="location.href='admin-dashboard-page.php'">Cancel</button>
              <input type="submit" value="Publish!" class="publish">
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