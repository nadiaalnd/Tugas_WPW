<?php 
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// cookie
setcookie('core', '', time() - 3600);
setcookie('key', '', time() - 3600);

header("Location: login.php");
exit;
