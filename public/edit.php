<?php

require_once '../config.php';
if (isset($_COOKIE['password'])) {
    $e = 1;
    $password = $_COOKIE['password'];
    if (!isset($_COOKIE['token'])) {
        $passGen = new MyLibrary\PasswordGenerator(32);
        $token = $passGen->password;
        setcookie('token', $token, strtotime('+2 hour'), 1);
    } else {
        $token = $_COOKIE['token'];
        setcookie('token', $token, strtotime('+2 hour'), 1);
    }
    require_once '../src/init.php';
    $abiturient = $pdo->getAbiturientDataById($password);
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
            if ($pdo->updateAbiturient($abiturient, $password)) {
                header('Location: edit.php?s=2');
                exit;
            } elseif (isset($pdo->error)) {
                $errors->email = $pdo->error;
            }
        }
        foreach ($errors as $value) {
            $message = $message.$value.'<br>';
        }
    } elseif (isset($_GET['s'])) {
        $s = $_GET['s'];
        if ($s == 1) {
            $message = 'Абитуриент успешно добавлен в базу.';
        } elseif ($s == 2) {
            $message = 'Изменения успешно сохранены.';
        }
    }
    require_once '../templates/registration.html';
} else {
    header('Location: registration.php');
}
