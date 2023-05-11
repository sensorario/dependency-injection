<?php

namespace Sensorario\DependencyInjection;

function buildDeps($subject, $method, $deps = []) {
    if (!method_exists($subject, '__construct')) return null;
    $params = (new \ReflectionMethod($subject, $method))
        ->getParameters();
    foreach ($params as $dep) {
        $className = (string) $dep->getType();
        $deps[] = new $className;
    }
    return $deps;
}

function injector($instance, $method = '__construct') {
    $deps = buildDeps($instance, $method);
    return $method == '__construct'
        ? new $instance(...$deps)
        : injector($instance)->$method(...$deps);
}
