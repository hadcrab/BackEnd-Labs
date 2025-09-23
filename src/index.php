<blockquote>
    <?php 
	setlocale(LC_ALL, "russian");
  	$day = strftime('%d');
  	$mon = strftime('%B');
  	$year = strftime('%Y'); 
	echo 'Сегодня ', $day, ' число, ', $mon, ' месяц, ', $year, ' год.'; 
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

	echo $welcome;
    ?>
</blockquote> 
<h1><?= $welcome ?>, Гость! <h1>

