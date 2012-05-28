<?php
namespace dicdemo\services\connectors\cache;

class MemcachedUserConnector implements \dicdemo\services\connectors\UserConnector {

    /**
     * @var \dicdemo\services\connectors\UserConnector
     */
    private $innerConnector;

    /**
     * @var \dicdemo\services\connectors\cache\MemcachedConnection
     */
    private $cacheConnection;

    /**
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
     * @param \dicdemo\services\connectors\UserConnector $innerConnector
     * @param \dicdemo\services\connectors\cache\MemcachedConnection $cacheConnection
     * @named inner $innerConnector
     */
    public function __construct(\dicdemo\services\connectors\UserConnector $innerConnector,
                                \dicdemo\services\connectors\cache\MemcachedConnection $cacheConnection) {
        $this->innerConnector = $innerConnector;
        $this->cacheConnection = $cacheConnection;
    }

    /**
     * @abstract
     * @param int $userId
     * @return \dicdemo\entities\User
     */
    public function getUser($userId) {
        $cacheKey = sprintf('u/%d', $userId);

        $cache = $this->cacheConnection->getCache();

        if ($this->logger) $this->logger->info('Try to get user ' . $userId . ' from cache');
        $value = $cache->get($cacheKey);
        if ($cache->getResultCode() !== \Memcached::RES_SUCCESS) {
            if ($this->logger) $this->logger->info('Not found in cache, get from inner connector');
            $value = $this->innerConnector->getUser($userId);
            $cache->set($cacheKey, $value);
        }
        return $value;
    }
}