<?php

require_once '../config.php';
require_once '../src/init.php';
$order = array_key_exists('order', $_GET) ? strval($_GET['order']) : '';
$search = array_key_exists('search', $_GET) ? strval($_GET['search']) : '';
$cookie = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
$page = array_key_exists('page', $_GET) ? intval($_GET['page']) : 1;
$page = $page !== 0 ? $page : 1;
// Разрешенные значения сортировки
$allowed = ['firstname', 'lastname', 'group_n', 'ege'];
// Гарантируем, что в переменной будет только допустимое значение
if (!in_array($order, $allowed)) {
    $order = $allowed[3];
}
$order2 = $order;
$order .= array_key_exists('desc', $_GET) ? ' DESC' : '';
$desc = $order2 == $order ? '' : 1;
$countAbiturients = $pdo->getCountAbiturients($search);
$pager = new MyLibrary\Pager($countAbiturients, $recordsPerPage, 'index.php?', $page);
$abiturients = $pdo->getAbiturients($search, $order, $pager);
$i = $pager->getOffset() + 1;

require_once '../templates/index.html';

function getLink($name, $order, $search, $displayName, $pager)
{
    $desc = $name == $order ? 1 : '';
    $url = '<a ';
    $url .= $desc == 1 ? ' class="dropup" ' : '';
    $url .= 'href="'.$pager->getLinkForPage($search, $pager->getVar('currentPage'), $name, $desc).'">'.$displayName;
    $url .= !(strpos($order, $name) === false) ? '<span class="caret"></span>' : '';
    $url .= '</a>';

    return $url;
}
function getPaginationLink($prop, $page, $pager, $search, $order, $desc)
{
    $prop = $prop == 1 ? 1 : intval($pager->getVar('totalPages'));
    $url = '<li';
    $url .= $page == $prop ? ' class="disabled">' : '>';
    $url .= $page !== $prop && $prop !== 1 ? '<a href="'.$pager->getLinkForPage($search, $page + 1, $order, $desc).'" aria-label="Next">' : ($page !== $prop ? '<a href="'.$pager->getLinkForPage($search, $page - 1, $order, $desc).'" aria-label="Previous">' : '');
    $url .= '<span aria-hidden="true">';
    $url .= $prop == 1 ? '&laquo;' : '&raquo;';
    $url .= '</span>';
    $url .= $page !== $prop ? '</a>' : '';
    $url .= '</li>';

    return $url;
}
