<?php
session_start();
unset($_SESSION["sub"]);
unset($_SESSION["email"]);
unset($_SESSION["level"]);
session_destroy();
unset($_COOKIE['nsfw']);
// empty value and expiration one hour before
$res = setcookie('nsfw', '', time() - 3600);
unset($_COOKIE['color']);
// empty value and expiration one hour before
$res = setcookie('color', '', time() - 3600);
?>