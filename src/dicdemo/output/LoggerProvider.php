<?php
namespace dicdemo\output;

class LoggerProvider {

    /**
     * @var \Monolog\Logger
     */
    private $logger;

    /**
     * @param \dicdemo\FrontController $frontController
     */
    public function __construct(\dicdemo\FrontController $frontController) {
        $this->logger = new \Monolog\Logger('dicdemo');
        $fileHandler = new \Monolog\Handler\StreamHandler($frontController->getDataDir() . '/dicdemo.log');
        $fileHandler->setFormatter(new \Monolog\Formatter\LineFormatter());
        $this->logger->pushHandler($fileHandler);
        $this->logger->pushProcessor(new \Monolog\Processor\MemoryUsageProcessor());
        $this->logger->pushProcessor(new LoggerObjectHashProcessor($this->logger));
    }

    /**
     * @return \Monolog\Logger
     */
    public function get() {
        return $this->logger;
    }
}