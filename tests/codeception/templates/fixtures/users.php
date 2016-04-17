<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'username' => $faker->userName,
    'auth_key' => Yii::$app->security->generateRandomString(),
    'password_hash' => Yii::$app->security->generatePasswordHash('password_' . $index),
    'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
    'created_at' => time(),
    'updated_at' => time(),
    'email' => $faker->email,
];