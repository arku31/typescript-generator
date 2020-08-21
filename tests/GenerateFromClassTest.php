<?php

namespace Arku\tests;

use Arku\Generators\GenerateFromClass;
use Arku\Generators\InterfaceGenerator;
use Arku\Resources\ExampleInterface;

class GenerateFromClassTest extends TestCase
{
    public function testExample()
    {
        $ts = file_get_contents(__DIR__.'/../resources/ExampleInterface.ts');
        $this->assertEquals(
            $ts,
            (new GenerateFromClass(new InterfaceGenerator()))->generateFrom(ExampleInterface::class)
        );
    }
}
