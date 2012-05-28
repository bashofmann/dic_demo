<?php
namespace dicdemo\services\connectors\sqlite;

class SqliteUserConnector implements \dicdemo\services\connectors\UserConnector {

    /**
     * @var \dicdemo\services\connectors\sqlite\SqliteConnection
     */
    private $sqliteConnection;

    /**
     * @inject
     * @param \dicdemo\services\connectors\sqlite\SqliteConnection $sqliteConnection
     */
    public function __construct(\dicdemo\services\connectors\sqlite\SqliteConnection $sqliteConnection) {
        $this->sqliteConnection = $sqliteConnection;
    }

    /**
     * @param int $userId
     * @throws \Exception
     * @return \dicdemo\entities\User
     */
    public function getUser($userId) {
        $db = $this->sqliteConnection->getDb();

        $query = 'SELECT * FROM users WHERE user_id = :user_id';

        $stmt = $db->prepare($query);
        $stmt->bindValue(':user_id', $userId, SQLITE3_INTEGER);

        $result = $stmt->execute();

        $userData = $result->fetchArray(SQLITE3_ASSOC);

        if ($userData) {
            $user = new \dicdemo\entities\User();
            $user->setUserId($userData['user_id']);
            $user->setFullname($userData['fullname']);
            $user->setBirthday(new \DateTime($userData['birthday']));
            return $user;
        }

        throw new \Exception('User with id ' . $userId . ' not found');

    }
}