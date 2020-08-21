<?php

namespace Arku\tests;

use Arku\Resources\ExampleInterface;
use Arku\TypeScriptInterfaceGenerator;

class TypeScriptInterfaceGeneratorTest extends TestCase
{

    public function testPublic()
    {
        $public = new TypeScriptInterfaceGenerator();
        $classes = $public->getAllClasses();

        $this->assertEquals(
            [
                ExampleInterface::class,
            ],
            $classes
        );
    }

    public function testGenerated()
    {
        $public = new TypeScriptInterfaceGenerator();
        $folderTo = __DIR__ . '/../generated/';
        foreach (glob($folderTo . '*.*') as $file) {
            unlink($file);
        }
        $public->generate($public->getAllClasses(), $folderTo);

        $this->assertFileDoesNotExist(__DIR__.'/../generated/ArkuResourcesExampleClass.ts');
        $this->assertFileExists(__DIR__.'/../generated/ArkuResourcesExampleInterface.ts');
    }
}
