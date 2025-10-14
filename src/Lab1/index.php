<!DOCTYPE html>
<?php 
include '../Lab1/inc/lib.inc.php';
include '../Lab1/inc/data.inc.php';
$title = 'Сайт нашей школы';
$header = "$welcome, Гость!";

$id = strtolower(strip_tags(trim($_GET['id'] ?? '')));

switch($id){
  case 'about':
    $title = 'О сайте';
    $header = 'О нашем сайте';
    break;
  case 'contact':
    $title = 'Контакты';
    $header = 'Обратная связь';
    break;
  case 'table':
    $title = 'Таблица умножения';
    $header = 'Таблица умножения';
    break;
  case 'calc':
    $title = 'Онлайн калькулятор';
    $header = 'Калькулятор';
    break;
}
?>
<html>
<head>
  <title><?php echo $title ?></title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
   <? include '../Lab1/inc/top.inc.php' ?>
  <div id="content">
    <!-- Заголовок -->
    <h1><? echo $header ?></h1>
    <!-- Заголовок -->
    <!-- Область основного контента -->
    <?php
switch($id){
case 'about':
include 'about.php';
break;
case 'contact':
include 'contact.php';
break;
case 'table':
include 'table.php';
break;
case 'calc':
include 'calc.php';
break;
default:
include '../Lab1/inc/index.inc.php';
}
?> 
   <!-- Область основного контента -->
  </div>
  <? include '../Lab1/inc/menu.inc.php' ?>
  <? include '../Lab1/inc/bottom.inc.php' ?>

</body>

</html>
