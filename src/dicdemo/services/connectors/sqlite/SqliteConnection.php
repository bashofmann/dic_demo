<?php
namespace dicdemo\services\connectors\sqlite;

class SqliteConnection {

    /**
     * @var \SQLite3
     */
    private $db;

    /**
     * @inject
     * @param \dicdemo\FrontController $frontController
     */
    public function __construct(\dicdemo\FrontController $frontController) {
        $this->db = new \SQLite3($frontController->getDataDir() . '/user.db');
    }

    /**
     * @return \Sqlite3
     */
    public function getDb() {
        return $this->db;
    }
}
