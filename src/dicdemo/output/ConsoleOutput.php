<?php
namespace dicdemo\output;

class ConsoleOutput implements Output {

    /**
     * @param string $text
     */
    public function write($text) {
        echo $text;
    }

    /**
     * @param string $text
     */
    public function writeLine($text) {
        $this->write($text . PHP_EOL);
    }

}