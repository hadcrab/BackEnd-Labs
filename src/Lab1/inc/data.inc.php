    <?php 
        setlocale(LC_ALL, "russian");
	$dateTime = new DateTime();
  	$day = date('d');
  	$mon = date('M');
  	$year = date('Y'); 
	#$hour = (int)strftime('%H');
	$hour = 13;
	$welcome;
	if ($hour >= 0 && $hour <=6) {
	   $welcome = 'Доброй ночи';
	} elseif ($hour >= 6 && $hour <= 12) {
	   $welcome = 'Доброе утро';
	} elseif ($hour >= 12 && $hour <= 18) {
	   $welcome = 'Добрый день';
	} elseif ($hour >= 18 && $hour <= 23) {
	   $welcome = 'Добрый вечер';
	} else {
	   $welcome = 'Доброй ночи';
	};
	$leftMenu = [
['link'=>'Домой', 'href'=>'index.php'],
['link'=>'О нас', 'href'=>'index.php?id=about'],
['link'=>'Контакты', 'href'=>'index.php?id=contact'],
['link'=>'Таблица умножения', 'href'=>'index.php?id=table'],
['link'=>'Калькулятор', 'href'=>'index.php?id=calc']
	];

	function drawMenu($menu, $vertical = true) {
    if ($vertical) {
        echo "<ul>";
        foreach ($menu as $item) {
            echo "<li><a href='{$item['href']}'>{$item['link']}</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<ul style='list-style: none; padding: 0; margin: 0;'>";
        foreach ($menu as $item) {
            echo "<li style='display: inline; margin-right: 15px;'>
                    <a href='{$item['href']}'>{$item['link']}</a>
                  </li>";
        }
        echo "</ul>";
    }
}
    ?>

