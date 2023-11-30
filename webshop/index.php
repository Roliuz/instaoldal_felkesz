<?php
session_start();


if (isset($_SESSION["user_id"])) {
} else {
    // felhasználó nincs bejelentkezve, átirányítás a bejelentkező oldalra
    header("Location: ../loginkondi.php");
    exit;
}
include "functions.php"; //az adatbázis csatlakozása érdekében meghívom a functions.php-t
$pdo = connect_mysql();


$oldal = isset($_GET['oldal']) && file_exists($_GET['oldal'] . '.php') ? $_GET['oldal'] : 'home';

include $oldal . '.php';
