<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title']) || empty($_POST['description']) || empty($_POST['source'])) {
        $errMsg = "Заполните все поля формы!";
    } else {
        $title = trim($_POST['title']);
        $category = isset($_POST['category']) ? (int)$_POST['category'] : 0;
        $description = trim($_POST['description']);
        $source = trim($_POST['source']);

        if ($news->saveNews($title, $category, $description, $source)) {
            header('Location: news.php');
            exit;
        } else {
            $errMsg = "Произошла ошибка при добавлении новости";
        }
    }
}

