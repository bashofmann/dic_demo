<?php
namespace dicdemo;

class FrontController {

    public function run() {
        $parameters = array(
            'userId' => 1
        );

        $di = new \Zend\Di\Di();

        $config = include($this->getDataDir() . '/di_config.php');

        $di->configure(new \Zend\Di\Configuration($config));

        /** @var \dicdemo\controllers\BirthdayController $controller  */
        $controller = $di->get(\dicdemo\controllers\BirthdayController::$CLASS);

        /** @var \dicdemo\services\UserService $userService  */
        $userService = $di->get(\dicdemo\services\UserService::$CLASS);

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