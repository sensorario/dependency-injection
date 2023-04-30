<?php

require_once  __DIR__ . '/../vendor/autoload.php';

use Sensorario\DependencyInjection\PrimaClasse;
use function Sensorario\DependencyInjection\injector;

$instanza = injector(PrimaClasse::class, 'primoMetodo');

var_export($instanza);