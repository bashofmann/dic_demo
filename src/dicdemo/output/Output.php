<?php
namespace dicdemo\output;

interface Output {

    /**
     * @abstract
     * @param string $text
     */
    public function write($text);

    /**
     * @abstract
     * @param string $text
     */
    public function writeLine($text);
}