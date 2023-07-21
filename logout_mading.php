<?php
session_start();
session_destroy();
header("Location: login-page.php?logout=1");
exit();
?>