<!DOCTYPE html>
<html>
<head>
  <title>Сайт нашей школы</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
</head>
<?php 
include '../Lab1/inc/lib.inc.php';
include '../Lab1/inc/data.inc.php';
?>
<body>
   <? include '../Lab1/inc/top.inc.php' ?>
  <div id="content">
    <!-- Заголовок -->
    <h1><?= $welcome ?>, Гость! </h1>
    <!-- Заголовок -->
    <!-- Область основного контента -->
   <? include '../Lab1/inc/index.inc.php' ?>
   <!-- Область основного контента -->
  </div>
  <? include '../Lab1/inc/menu.inc.php' ?>
  <? include '../Lab1/inc/bottom.inc.php' ?>

</body>

</html>
