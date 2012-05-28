<?php
namespace dicdemo;

class FrontController {

    public function run() {
        $parameters = array(
            'userId' => 1
        );

        $controller = new \dicdemo\controllers\BirthdayController(new \dicdemo\output\ConsoleOutput());

        $memcachedConnector = new \dicdemo\services\connectors\cache\MemcachedUserConnector(
            new \dicdemo\services\connectors\sqlite\SqliteUserConnector(
                new \dicdemo\services\connectors\sqlite\SqliteConnection(
                    $this
                )
            ),
            new \dicdemo\services\connectors\cache\MemcachedConnection()
        );
        $loggerProvider = new \dicdemo\output\LoggerProvider($this);
        $memcachedConnector->setLogger($loggerProvider->get());

        $userService = new \dicdemo\services\UserService(
            $memcachedConnector
        );
        $loggerProvider = new \dicdemo\output\LoggerProvider($this);
        $userService->setLogger($loggerProvider->get());

        $controller->run(
            $userService,
            $parameters['userId']
        );
    }

    /**
     * @return string
     */
    public function getDataDir() {
        return realpath(__DIR__ . '/../../data');
    }
}