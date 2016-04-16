<?php

$dbConnectionUrl = parse_url(getenv("CLEARDB_DATABASE_URL"));

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $dbConnectionUrl["host"].';dbname=' . substr($dbConnectionUrl["path"], 1),
    'username' => $dbConnectionUrl["user"],
    'password' => $dbConnectionUrl["pass"],
    'charset' => 'utf8',
];