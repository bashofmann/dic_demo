<?php
namespace dicdemo\controllers;

class BirthdayController {

    public static $CLASS = __CLASS__;
    /**
     * @var \dicdemo\output\Output
     */
    private $output;

    public function __construct(\dicdemo\output\Output $output) {
        $this->output = $output;
    }

    public function run(\dicdemo\services\UserService $userService, $userId) {
        $user = $userService->getUser($userId);
        $hasBirthday = $userService->hasBirthday($userId);

        if ($hasBirthday) {
            $this->output->writeLine('Happy birthday ' . $user->getFullname());
        } else  {
            $this->output->writeLine('It\'s not '  . $user->getFullname() . '\'s birthday');
        }
    }
}