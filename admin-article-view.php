<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login-page.php");
    exit();
}

$username = $_SESSION['username'];

$host = "localhost:3306";
$dbUsername = "root";
$dbPassword = "";
$database = "dbmading";

$conn = mysqli_connect($host, $dbUsername, $dbPassword, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM artikel";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . $sql . "<br>" . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>MadingJWP</title>
    <link rel="stylesheet" type="text/css" href="admin_article_view.css">
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
        <div class="article-list">
            <h2>List artikel</h2>
            <table>
                <tr>
                    <th style='width: 3%;'>No</th>
                    <th style='width: 10%;'>Judul Artikel</th>
                    <th style='width: 25%;'>Isi Artikel</th>
                    <th style='width: 5%;'>Aksi</th>
                </tr>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $articleId = $row['id'];
                    $judul = $row['judul'];
                    $isi = $row['isi'];
                ?>
                <tr>
                    <td class="article-no"><?php echo $no; ?></td>
                    <td class="article-title"><?php echo $judul; ?></td>
                    <td class="article-description"><?php echo nl2br($isi); ?></td>
                    <td class="article-action">
                        <a href="admin-edit-page.php?id=<?php echo $articleId; ?>">Ubah</a>
                        <a href="article_delete_mading.php?id=<?php echo $articleId; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
                    $no++;
                }
                ?>
            </table>
        </div>
        
        <button class="cancel" onclick="location.href='admin-dashboard-page.php'">Cancel</button>
    </div>

    <div class="footer">
        <div class="copyright">
            <p>Copyright © 2023 madingjwp.com. All Rights Reserved<p>
        </div>
    </div>
</body>
</html>