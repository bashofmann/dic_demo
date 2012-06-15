<?php
return array(
    'instance' => array(
        'preferences' => array(
            'dicdemo\output\Output' => 'dicdemo\output\ConsoleOutput',
            'dicdemo\services\connectors\UserConnector' => 'dicdemo\services\connectors\cache\MemcachedUserConnector',
        ),
    )
);