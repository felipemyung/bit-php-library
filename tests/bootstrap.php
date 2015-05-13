<?php

$loaderFilePath = __DIR__.'/../vendor/autoload.php';

if (!file_exists($loaderFilePath)) {
    throw new Exception('Do you forgot of execute \'composer install\'?');
}
$loader = require $loaderFilePath;

//$loader->add('BandsInTownApi', __DIR__);