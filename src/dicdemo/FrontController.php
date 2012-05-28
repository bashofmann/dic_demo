<?php
namespace dicdemo;

/**
 * @singleton
 */
class FrontController {

    public function run() {
        $parameters = array(
            'userId' => 1
        );

        $dicConfiguration = new \rg\injektor\Configuration($this->getDataDir() . '/dic_config.php', null);
        $dic = new \rg\injektor\DependencyInjectionContainer($dicConfiguration);

        /** @var \dicdemo\controllers\BirthdayController $controller  */
        $controller = $dic->getInstanceOfClass(\dicdemo\controllers\BirthdayController::$CLASS);

        $dic->callMethodOnObject($controller, 'run', $parameters);
    }

    /**
     * @return string
     */
    public function getDataDir() {
        return realpath(__DIR__ . '/../../data');
    }
}