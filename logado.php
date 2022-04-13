<?php
session_start();

if (!isset($_SESSION['id']) && !$_SESSION['online']) {
    die("<marquee>Você não está logado</marquee>");
}

require('./app/Models/User.php');

$model = new User();

$me = $model->getMe();

echo "Olá " . $me['name'] . "!";

