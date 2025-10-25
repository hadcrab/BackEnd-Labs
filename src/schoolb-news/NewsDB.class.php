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
    public function getNews(int $limit = 10, int $offset = 0) : array {
        $sql = "SELECT * FROM msgs ORDER BY datetime DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':limit', $limit, SQLITE3_INTEGER);
        $stmt->bindValue(':offset', $offset, SQLITE3_INTEGER);
        $res = $stmt->execute();
        $rows = [];
        while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
           $rows[] = $row;
        }
        return $rows;
    }
    public function showNews($id){
        $news = $this->getNews($limit);
        foreach ($news as $item) {
            echo "<article>";
            echo "<h2>" . htmlspecialchars($item['title']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($item['description'])) . "</p>";
            echo "<small>" . date('Y-m-d H:i:s', (int)$item['datetime']) . "</small>";
            echo "</article>";
    }
}

}
$news = new NewsDB();


