<?php
namespace dicdemo\services;

class UserService {

    /**
     * @var \dicdemo\services\connectors\UserConnector
     */
    private $userConnector;

    /**
     * @inject
     * @var \Monolog\Logger
     */
    protected $logger;

    /**
     * @param \Monolog\Logger $logger
     */
    public function setLogger(\Monolog\Logger $logger) {
        $this->logger = $logger;
    }

    /**
     * @inject
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

        if ($this->logger) $this->logger->info('Interval is ' . print_r($interval, true));

        return $interval->d === 0;
    }
}