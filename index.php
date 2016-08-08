<?php

require './vendor/autoload.php';

$favro = \seregazhuk\Favro\Favro::create('seregazhuk88@gmail.com', 'Eikah1ei');
$res = $favro->organizations->getById('60e9e54d24f24ec6939d9b61');
print_r($res);

