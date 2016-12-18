<?php

require_once '../config.php';
if (!isset($_COOKIE['password'])) {
    if (!isset($_COOKIE['token'])) {
        $passGen = new MyLibrary\PasswordGenerator(32);
        $token = $passGen->password;
        setcookie('token', $token, strtotime('+2 hour'), 1);
    } else {
        $token = $_COOKIE['token'];
        setcookie('token', $token, strtotime('+2 hour'), 1);
    }
    $abiturient = new MyLibrary\Abiturient();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($_POST as $key => $value) {
            $abiturient->setVar($key, $value);
        }
        if (!isset($_COOKIE['token'], $_POST['token']) or empty($_COOKIE['token']) or empty($_POST['token']) or $_COOKIE['token'] !== $_POST['token']) {
            $message = 'Произошла ошибка.';
            require_once '../templates/registration.html';
            exit;
        }
        $message = '';
        $errors = new MyLibrary\AbiturientValidator($abiturient);
        if (count((array) $errors) == 0) {
            require_once '../src/init.php';
            if ($pdo->addAbiturient($abiturient)) {
                $passGen = new MyLibrary\PasswordGenerator(32);
                $pass = $pdo->addUser($passGen->password);
                setcookie('password', $pass, strtotime('+10 year'), 1);
                header('Location: edit.php?s=1');
                exit;
            } elseif (isset($pdo->error)) {
                $errors->email = $pdo->error;
            }
        }
        foreach ($errors as $value) {
            $message = $message.$value.'<br>';
        }
    }

    require_once '../templates/registration.html';
} else {
    header('Location: edit.php');
}
