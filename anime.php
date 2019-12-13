<?php
    session_start();
    if (empty($_GET["id"])) {
        header("Location: /index.php");
    }
    else {
        $id = $_GET["id"];
    }
    if (isset($_SESSION['level'])) {
        header("Location: /p/anime.php?id=$id");
    } else if (!isset($_SESSION['level'])) {
        header("Location: /n/anime.php?id=$id");
    }

    $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
    $url = $base_url . $_SERVER["REQUEST_URI"];
    ?>