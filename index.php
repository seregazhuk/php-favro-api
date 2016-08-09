<?php

require './vendor/autoload.php';

$favro = \seregazhuk\Favro\Favro::create('seregazhuk88@gmail.com', 'Eikah1ei');
$res = $favro->organizations->update('dfc4196f77732c889bb21b44', 'test1');
print_r($res);

