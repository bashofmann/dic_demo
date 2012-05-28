<?php
namespace dicdemo\entities;

class User {

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $fullname;

    /**
     * @var \DateTime
     */
    private $birthday;

    /**
     * @param \DateTime $birthday
     */
    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday() {
        return $this->birthday;
    }

    /**
     * @param string $fullname
     */
    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    /**
     * @return string
     */
    public function getFullname() {
        return $this->fullname;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }
}