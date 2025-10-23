<?
spl_autoload_register(function($class) {
    include __DIR__ . "/classes/$class.php";
});

$user1 = new User("John", "John24", "12345");
$user1->showInfo();
$user2 = new User("max", "maxcd24", "qwery");
$user2->showInfo();
$user3 = new User("bob", "werfc", "poiyt");
$user3->showInfo();
$user4 = new SuperUser("sidfed", "nicname", "reefew", "admin");
$user4->showInfo();
echo $user4->auth('nicname', 'reefew') ? 'Авторизация успешна' : 'Ошибка авторизации';

echo "Всего обычных пользователей: " . User::$count . "<br>";
echo "Всего суперпользователей: " . SuperUser::$count . "<br>";

