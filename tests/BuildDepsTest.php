<?php

namespace Sensorario\DependencyInjection\Tests;

use PHPUnit\Framework\TestCase;
use function Sensorario\DependencyInjection\buildDeps;
use function Sensorario\DependencyInjection\injector;

class BuildDepsTest extends TestCase
{
    /** @test */
    public function returnEmptyListOfDependenciesWheneverConstructNotExists()
    {
        $result = buildDeps(IndipendentClass::class, '__construct');
        $this->assertEquals(null, $result);
    }

    /** @test */
    public function returnAnInstanceForEachSubjectDependencies()
    {
        $result = buildDeps(DependendClass::class, '__construct');
        $this->assertTrue(IndipendentClass::class === get_class($result[0]));
    }

    /** @test */
    public function InjectorShoudInstanceSubjectAndRunGivenMethod()
    {
        $result = injector(DependendClass::class, 'foo');
        $this->assertEquals('fizz', $result);
    }
}


class IndipendentClass
{
    public function bar()
    {
        return 'fizz';
    }
}
class DependendClass
{
    public function __construct(private IndipendentClass $class)
    {

    }

    public function foo()
    {
        return $this->class->bar();
    }
}