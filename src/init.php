<?php
$host='localhost';
$user='root';
$pass='';
$dbname='studentlist';
try {
  $DBH = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $user, $pass);
  $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $DBH->setAttribute( PDO::MYSQL_ATTR_INIT_COMMAND, "SET sql_mode='STRICT_ALL_TABLES'" );
  $pdo = new MyLibrary\AbiturientDataGateway ($DBH);
}
catch(PDOException $e) {
    $message='Не удалось подключиться к базе данных.';
    require_once '../templates/index.html';
    exit;
}
