<?php

if (YII_ENV_PROD && file_exists(__DIR__ . '/db-prod.php')) {
    return require 'db-prod.php';
} else {
    return require 'db-dev.php';
}
