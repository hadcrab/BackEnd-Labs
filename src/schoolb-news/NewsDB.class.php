<?php
require_once "INewsDB.class.php";

class NewsDB implements INewsDB {
    const DB_NAME = 'news.db'; 
    private $_db;     
    protected function getDb() {
        return $this->_db;
    }
    public function __construct() {
        $dbPath = __DIR__ . '/' . self::DB_NAME;
        $isNew = !file_exists($dbPath);

        $this->_db = new SQLite3($dbPath);

        if ($isNew) {
            $this->createTables();
        }
    }
    private function createTables() {
        $sql = "
            CREATE TABLE msgs(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT,
                category INTEGER,
                description TEXT,
                source TEXT,
                datetime INTEGER
            );

            CREATE TABLE category(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT
            );

            INSERT INTO category(name) VALUES ('Политика');
            INSERT INTO category(name) VALUES ('Культура');
            INSERT INTO category(name) VALUES ('Спорт');
        ";

        if (!$this->_db->exec($sql)) {
            throw new Exception("Error creating tables: " . $this->_db->lastErrorMsg());
        }
    }

    public function __destruct() {
        $this->_db->close();
    }
    public function saveNews($title, $category, $description, $source) {
        $dt = time();
        $sql = "INSERT INTO msgs(title, category, description, source, datetime)
            VALUES (:title, :category, :description, :source, :dt)";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':title', $title, SQLITE3_TEXT);
        $stmt->bindValue(':category', $category, SQLITE3_INTEGER);
        $stmt->bindValue(':description', $description, SQLITE3_TEXT);
        $stmt->bindValue(':source', $source, SQLITE3_TEXT);
        $stmt->bindValue(':dt', $dt, SQLITE3_INTEGER);
        return $stmt->execute() ? true : false;
    }
    public function getNews() {
        $sql = "SELECT 
                msgs.id AS id, 
                title, 
                category.name AS category, 
                description, 
                source, 
                datetime 
            FROM msgs, category 
            WHERE category.id = msgs.category 
            ORDER BY msgs.id DESC";

        $result = $this->_db->query($sql);
        if (!$result) return false;
        $data = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function showNews($id) {
        $id = (int)$id;
        $sql = "SELECT 
                msgs.id AS id, 
                title, 
                category.name AS category, 
                description, 
                source, 
                datetime 
            FROM msgs, category 
            WHERE category.id = msgs.category AND msgs.id = $id";

        $result = $this->_db->querySingle($sql, true);
        return $result ?: false;
    }


}
$news = new NewsDB();


