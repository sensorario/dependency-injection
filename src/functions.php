<?php
/**
 * This is an automatic dependency injection function
 * php version 8.2
 * 
 * @category Project
 * @package  Sensorario\DependencyInjection
 * @author   Simone Gentili <sensorario@gmail.com>
 * @license  https://github.com/sensorario/dependency-injection/blob/main/LICENCE MIT
 * @version  GIT: <v1.0.0>
 * @link     https://github.com/sensorario/dependency-injection
 */

namespace Sensorario\DependencyInjection;

/**
 * Build all the dependencies of a given subject. Subject
 * could be a class or an object.
 * 
 * @param mixed  $subject the given class or instance
 * @param string $method  the given method
 * @param array  $deps    the list of dependencies
 * 
 * @return array
 */
function buildDeps($subject, $method, $deps = [])
{
    if (!method_exists($subject, '__construct')) {
        return null;
    }

    $params = (new \ReflectionMethod($subject, $method))
    ->getParameters();
    foreach ($params as $dep) {
        $className = (string) $dep->getType();
        $deps[] = new $className;
    }
    return $deps;
}

/**
 * Injection receive a class or an object and the relative method.
 * Then returns the instance of the given class, and the value
 * returned from the given methods.
 * 
 * @param mixed  $instance a class or object
 * @param string $method   the given method
 * 
 * @return array
 */
function injector($instance, $method = '__construct')
{
    $deps = buildDeps($instance, $method);
    return $method == '__construct'
        ? new $instance(...$deps)
        : injector($instance)->$method(...$deps);
}
