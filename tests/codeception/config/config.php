<?php
/**
 * Application configuration shared by all test types
 */
return [
    'language' => 'ru',

    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'fixtureDataPath' => '@tests/codeception/fixtures',
            'templatePath' => '@tests/codeception/templates',
            'namespace' => 'tests\codeception\fixtures',
        ],
    ],

    'components' => [
        'db' => require 'db.php',

        'mailer' => [
            'useFileTransport' => true,
        ],

        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
        ],
    ],
];
