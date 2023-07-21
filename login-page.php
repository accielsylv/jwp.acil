<?php
session_start();

$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>MadingJWP</title>
    <link rel="stylesheet" type="text/css" href="login_page.css">
</head>
<body>
    <?php if (!isset($_SESSION['username'])) { ?>
        <div class="nav">
            <div class="logo">MadingJWP</div>
        </div>

        <div class="content">
            <div class="login-box">
                <h2>Login</h2>
                <form action="login_mading.php" method="POST">
                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username" autocomplete="off" required placeholder="tulis username!"><br>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" autocomplete="off" required placeholder="tulis password!"><br>
                    <?php if (!empty($error)) { ?>
                        <p><?php echo $error; ?></p>
                    <?php } ?>
                    <input type="submit" value="Login!">
                    <button class="cancel" onclick="location.href='index.php'">Cancel</button>
                </form>
            </div>
        </div>

        <div class="footer">
            <div class="copyright">
                <p>Copyright © 2023 madingjwp.com. All Rights Reserved<p>
            </div>
        </div>
    <?php } else { ?>
        <div class="login-session">
            <h2>Anda telah login sebagai <?php echo $_SESSION['username']; ?></h2>
            <div class="button-session">
                <button onclick="location.href='logout_mading.php'">Logout</button>
                <button class="cancel" onclick="location.href='admin-dashboard-page.php'">Cancel</button>
            </div>
        </div>
    <?php } ?>
</body>
</html>