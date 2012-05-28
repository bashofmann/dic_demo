<?php
namespace dicdemo\services\connectors;

interface UserConnector {

    /**
     * @abstract
     * @param int $userId
     * @return \dicdemo\entities\User
     */
    public function getUser($userId);
}