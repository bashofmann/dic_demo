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
     * @param \dicdemo\services\connectors\UserConnector $innerConnector
     * @param \dicdemo\services\connectors\cache\MemcachedConnection $cacheConnection
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

        $value = $cache->get($cacheKey);
        if ($cache->getResultCode() !== \Memcached::RES_SUCCESS) {
            $value = $this->innerConnector->getUser($userId);
            $cache->set($cacheKey, $value);
        }
        return $value;
    }
}