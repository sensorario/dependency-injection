<?php

namespace Sensorario\DependencyInjection;

function buiildDeps($instance, $method, $deps = []) {
    $params = (new \ReflectionMethod($instance, $method))
        ->getParameters();
    foreach ($params as $dep) {
        $className = (string) $dep->getType();
        $deps[] = new $className;
    }
    return $deps;
}

function injector($instance, $method = '__construct') {
    $deps = buiildDeps($instance, $method);
    return $method == '__construct'
        ? new $instance(...$deps)
        : injector($instance)->$method(...$deps);
}
