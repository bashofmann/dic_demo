<?php
namespace dicdemo;

class FrontController {

    public function run() {
        $parameters = array(
            'userId' => 1
        );

        $container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
        $loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader(
            $container,
            new \Symfony\Component\Config\FileLocator($this->getDataDir()));
        $loader->load('services.yml');

        /** @var \dicdemo\controllers\BirthdayController $controller  */
        $controller = $container->get('birthday_controller');

        /** @var \dicdemo\services\UserService $userService  */
        $userService = $container->get('user_service');

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