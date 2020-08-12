<?php
namespace Arku\Tests;

use Arku\Generators\GenerateFromClass;
use Arku\Generators\InterfaceGenerator;
use Arku\PublicGenerator;
use Arku\Resources\ExampleClass;
use Arku\Resources\ExampleInterface;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;

class TestCase extends PhpUnitTestCase
{
    public function testExample()
    {
        $ts = file_get_contents(__DIR__.'/../resources/ExampleInterface.ts');
        $this->assertEquals(
            $ts,
            (new GenerateFromClass(new InterfaceGenerator()))->generateFrom(ExampleInterface::class)
        );
    }

    public function testPublic()
    {
        $public = new PublicGenerator();
        $classes = $public->getAllClasses();

        $this->assertEquals(
            [
                ExampleClass::class,
                ExampleInterface::class,
            ],
            $classes
        );
    }
    public function testGenerated()
    {
        $public = new PublicGenerator();
        $folderTo = __DIR__ . '/../generated/';
        $public->generate($public->getAllClasses(), $folderTo);

        $this->assertFileExists(__DIR__.'/../generated/ArkuResourcesExampleClass.ts');
        $this->assertFileExists(__DIR__.'/../generated/ArkuResourcesExampleInterface.ts');
    }
}