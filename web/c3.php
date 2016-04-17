<?php

require(__DIR__ . '/../vendor/autoload.php');

$_SERVER['HTTP_X_CODECEPTION_CODECOVERAGE_DEBUG'] = 1;
$_SERVER['HTTP_X_CODECEPTION_CODECOVERAGE_CONFIG'] = __DIR__ . '/../tests/codeception.yml';