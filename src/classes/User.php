<?

class User extends UserAbstract {
    public $name;
    public $login;
    public $password;
    public static $count = 0;

    public function showInfo() {
	echo $this->name . "\n\r" . $this->login . "\n\r" . $this->password;
	echo "</br>";
    }

    public function __construct($name, $login, $password) {
	self::$count++;
	$this->name = $name;
	$this->login = $login;
        $this->password = $password;	
    }
    public function __destruct() {
	    echo "Уничтожен" . __CLASS__ . "\n </br>";
    }

}


