<?php
namespace dicdemo\services\connectors\cache;

class MemcachedConnection {

    /**
     * @var \Memcached
     */
    private $cache;

    public function __construct() {
        $this->cache = new \Memcached();
        $this->cache->addServer('localhost', '11222');
    }

    /**
     * @return \Memcached
     */
    public function getCache() {
        return $this->cache;
    }
}
