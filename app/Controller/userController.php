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
        $validate = validateRegister($model, $_POST);
        if (count($validate)) {
            header('location:/register.php?error=validation&content=' . json_encode($validate));
            die();
        }
        
        $result = $model->postUser($_POST);

        if($result) {
            header('location:/');
        }else{
            header('location:/register.php');
        }

        var_dump($result);
        echo 'deu bom';
        break;

    case "login":
        $validate = validateLogin($model, $_POST);
        if (count($validate)) {
            header('location:/?error=validation&content=' . json_encode($validate));
            die();
        }
        header('location:/logado.php');
        break;

    default:
        throw new Exception("aqui nao 2");
}

function validateRegister(User $user, array $data)
{
    $userExist = $user->getUser($data['email'], 'email');
    if ($userExist){
        $errors[] = 1;
    }

    /*if($data['password'] !== $data['nome q for criado password_confirmation']) {
        $error[] = 2;
    }*/

    return $errors;
}

function validateLogin(User $user, array $data)
{
    $errors = [];
    var_dump($data);
    $user = $user->getUser($data['email'], 'email');
    if(!$user){
        $errors[] = 1;
    }

    if(password_verify($data['password'], $user['password'])){
        session_start();
        $_SESSION['online'] = true;
        $_SESSION['id'] = $user['id'];
    } else {
        $errors[] = 2;
    }

    return $errors;
}