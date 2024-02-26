<?php
// Page accessible uniquement aux personnes connectées
include 'smarty.php';
require_once('inc/db.php');
require_once('inc/functions.php');
session_start();

echo $_FILES['files'];

// tu veux un token ? en voila un !
$token = setToken();
            echo '<a href="index.php?token='.$token.'">C\'est parti !</a>';

$fichier = file_get_contents('template/index.tpl');
echo $fichier;
?>