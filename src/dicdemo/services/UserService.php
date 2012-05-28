<?php
namespace dicdemo\services;

class UserService {

    /**
     * @var \dicdemo\services\connectors\UserConnector
     */
    private $userConnector;

    /**
     * @param \dicdemo\services\connectors\UserConnector $userConnector
     */
    public function __construct(\dicdemo\services\connectors\UserConnector $userConnector) {
        $this->userConnector = $userConnector;
    }

    /**
     * @param int $userId
     * @return \dicdemo\entities\User
     */
    public function getUser($userId) {
        return $this->userConnector->getUser($userId);
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function hasBirthday($userId) {
        $user = $this->getUser($userId);
        $interval = $user->getBirthday()->diff(new \DateTime('now'));

        return $interval->d === 0;
    }
}