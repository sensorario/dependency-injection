# Depencency-Injection

## Install 

```
composer require sensorario/dependency-injection
```

## Usage

```php
use function Sensorario\DependencyInjection\injector;

$result = injector(ClassName::class, 'methodName');

echo $result;
```