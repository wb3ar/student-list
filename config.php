<?php

//Настройки базы данных
$host='localhost';
$user='root';
$pass='';
$dbname='studentlist';

//Количество отображаемых записей на одной странице таблицы
$recordsPerPage = 15;

//Подключение автозагрузчика Composer
require_once '../vendor/autoload.php';

//Функция для экранирования HTML
require_once '../src/htmlspec.php';
