<?php

if(!isset($_POST['userController'])){
    header('location:/?error=injection');
    return false;
}

require ('../Models/User.php');
$model = new User();

switch ($_POST['userController'])
{
    case "register":
        $result = $model->postUser($_POST);
        var_dump($result);
        echo 'deu bom';
        break;

    default:
        throw new Exception("aqui nao 2");
}