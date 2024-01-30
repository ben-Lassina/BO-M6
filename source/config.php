<?php
    if (!file_exists(__DIR__ . '/../.env')) {
        die('Geen .env bestand gevonden');
    }

    $envSettings = parse_ini_file(__DIR__ . '/../.env');

    define('DB_SCHEMA', (isset($envSettings['DB_SCHEMA'])) ? $envSettings['DB_SCHEMA'] : 'BOfoto');
    define('DB_USER', (isset($envSettings['DB_USER'])) ? $envSettings['DB_USER'] : 'root');
    define('DB_PASSWORD', (isset($envSettings['DB_PASSWORD'])) ? $envSettings['DB_PASSWORD'] : '4dy5qwtrsag#!sad');
    define('DB_HOST', (isset($envSettings['DB_HOST'])) ? $envSettings['DB_HOST'] : 'mariadb');
