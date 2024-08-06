
<?php
class Database {
    private $host = 'localhost';
    private $dbName = 'shop';
    private $user = 'root';
    private $pass = '';
    private $pdo;
    private static $instance = null;

    private function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}
