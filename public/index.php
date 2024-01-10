<?php

use MovieMatch\Config\Router;

require_once __DIR__ . "/../vendor/autoload.php";

$currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($currentURL, PHP_URL_PATH);
$segments = explode('/', trim($path, '/'));

$router = new Router($_SERVER['REQUEST_METHOD'], $segments[0]);
$router->route();
