<?php
require_once 'NewsDB.class.php';
$news = new NewsDB();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    die("<p>Некорректный идентификатор новости</p>");
}

$item = $news->showNews($id);
if (!$item) {
    echo "<p>Ошибка при получении новости</p>";
} else {
    echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";
    echo "<p><b>Категория:</b> " . htmlspecialchars($item['category']) . "</p>";
    echo "<p>" . nl2br(htmlspecialchars($item['description'])) . "</p>";
    echo "<p><i>Источник:</i> " . htmlspecialchars($item['source']) . "</p>";
    echo "<p><a href='news.php'>Назад к списку</a></p>";
}
