<?php
namespace dicdemo;

class FrontController {

    public function run() {
        $parameters = array(
            'userId' => 1
        );

        $controller = new \dicdemo\controllers\BirthdayController(new \dicdemo\output\ConsoleOutput());

        $controller->run(
            new \dicdemo\services\UserService(
                new \dicdemo\services\connectors\cache\MemcachedUserConnector(
                    new \dicdemo\services\connectors\sqlite\SqliteUserConnector(
                        new \dicdemo\services\connectors\sqlite\SqliteConnection(
                            $this
                        )
                    ),
                    new \dicdemo\services\connectors\cache\MemcachedConnection()
                )
            ),
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