<?php 
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'theme' => 'bootstrap',
        'components'=>array(
            'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'file/<file_id>&size=<size>' => 'site/yiifilemanagerfilepicker',
                'file/<file_id>' => 'site/yiifilemanagerfilepicker',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                array('class' => 'MyRule'),
            ),
        ),
        )
        // Put front-end settings there
    )
);