<?
class SuperUser extends User implements ISuperUser, IAuthorizeUser {
    public $role;
    public static $count = 0;
    public function __construct($name, $login, $password, $role) {
	self::$count++;
	parent::__construct($name, $login, $password);
	$this->role = $role;
    }
    public function showInfo() {
	parent::showInfo();
	echo $this->role;
	echo "</br>";
    }
    public function auth($login, $password) {
        return $this->login === $login && $this->password === $password;
        echo "</br>";
    }
}


