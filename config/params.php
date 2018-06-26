<?php

$config = require('config.php');

return [
    'mail' => $config['mail'],
    'adminEmail' => 'Itok.ToniLaksono@mitrais.com',
    'frontend' => 'coza',
    'base_url' => 'http://localhost:8080/',
    'name' => 'Yii Commerce',
    'stripe_publish' => $config['stripe_publish'],
    'stripe_key' => $config['stripe_key'],
];
