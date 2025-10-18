<?php
/* Основные настройки */
define('DB_HOST', 'db');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'gbook');
$mysqli = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME)
    or die('Ошибка подключения: ' . mysqli_connect_error());
/* Основные настройки */

/* Сохранение записи в БД */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name  = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $msg   = trim($_POST["msg"] ?? "");
    $name  = mysqli_real_escape_string($mysqli, htmlspecialchars($name));
    $email = mysqli_real_escape_string($mysqli, htmlspecialchars($email));
    $msg   = mysqli_real_escape_string($mysqli, htmlspecialchars($msg));
    if ($name && $msg) {
        $query = "INSERT INTO msgs (name, email, msg) VALUES ('$name', '$email', '$msg')";
        $res = mysqli_query($mysqli, $query);

        if (!$res) {
            echo "<p>Ошибка: " . mysqli_error($mysqli) . "</p>";
        } else {
            header("Location: ".$_SERVER['PHP_SELF']."?id=gbook");
            exit;
        }
    }
}
/* Сохранение записи в БД */

/* Удаление записи из БД */
if (isset($_GET['del'])) {
    $del = (int)$_GET['del'];
    if ($del > 0) {
        $query = "DELETE FROM msgs WHERE id = $del";
        $res = mysqli_query($mysqli, $query);
        if ($res) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?id=gbook");
            exit;
        } else {
            echo "<p>Ошибка удаления: " . mysqli_error($mysqli) . "</p>";
        }
    }
}
/* Удаление записи из БД */
?>
<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>
<?php
/* Вывод записей из БД */
/* Вывод записей из БД */
$result = mysqli_query(
    $mysqli,
    "SELECT id, name, email, msg, UNIX_TIMESTAMP(datetime) AS dt
     FROM msgs
     ORDER BY id DESC"
);

if (!$result) {
    echo "<p>Ошибка запроса: " . mysqli_error($mysqli) . "</p>";
    exit;
}

$count = mysqli_num_rows($result);
echo "<p>Всего записей в гостевой книге: $count</p>";

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $name = htmlspecialchars($row['name']);
    $email = htmlspecialchars($row['email']);
    $msg = nl2br(htmlspecialchars($row['msg']));
    $dt = date('d-m-Y в H:i', $row['dt']);

    echo "<p>
            <a href='mailto:$email'>$name</a> $dt<br />
            написал:<br />$msg
          </p>
          <p align='right'>
            <a href='?id=gbook&del=$id'>Удалить</a>
          </p>";
}

mysqli_close($mysqli);
/* Вывод записей из БД */

/* Вывод записей из БД */
?>
