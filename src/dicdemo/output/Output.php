<?php
namespace dicdemo\output;

/**
 * @implementedBy \dicdemo\output\ConsoleOutput
 */
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