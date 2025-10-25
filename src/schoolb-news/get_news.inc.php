<?php
$items = $news->getNews();

if ($items === false) {
    $errMsg = "Произошла ошибка при выводе новостной ленты";
    echo "<p style='color:red;'>$errMsg</p>";
} elseif (count($items) == 0) {
    echo "<p>Новостей нет.</p>";
} else {
    echo "<p>Всего новостей: " . count($items) . "</p>";

    foreach ($items as $n) {
        echo "<div>";
        echo "<h3><a href='show-news.php?id={$n['id']}'>" . htmlspecialchars($n['title']) . "</a></h3>";
        echo "<p><b>Категория:</b> " . htmlspecialchars($n['category']) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($n['description'])) . "</p>";
        echo "<p><i>Источник:</i> " . htmlspecialchars($n['source']) . "</p>";
        echo "<hr>";
        echo "</div>";
    }
}
