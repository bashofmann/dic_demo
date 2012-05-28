<?php
namespace dicdemo\output;

class LoggerObjectHashProcessor {

    /**
     * @var string
     */
    private $objectHash;

    /**
     * @param \Monolog\Logger $logger
     */
    public function __construct(\Monolog\Logger $logger) {
        $this->objectHash = spl_object_hash($logger);
    }

    /**
     * @param array $record
     * @return array
     */
    public function __invoke(array $record) {
        $record['extra'] = array_merge(
            $record['extra'],
            array(
                'logger_object_hash' => $this->objectHash,
            )
        );

        return $record;
    }
}