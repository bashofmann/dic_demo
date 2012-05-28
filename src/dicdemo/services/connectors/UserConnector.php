<?php
namespace dicdemo\services\connectors;

/**
 * @implementedBy default \dicdemo\services\connectors\cache\MemcachedUserConnector
 * @implementedBy inner \dicdemo\services\connectors\sqlite\SqliteUserConnector
 */
interface UserConnector {

    /**
     * @abstract
     * @param int $userId
     * @return \dicdemo\entities\User
     */
    public function getUser($userId);
}