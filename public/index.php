<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

require_once dirname(__DIR__) . '/templates/home.php';
