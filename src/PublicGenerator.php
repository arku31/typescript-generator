<?php

namespace Arku;

use Arku\Contracts\TypeScriptGeneratorContract;
use Arku\Generators\InterfaceGenerator;
use Nette\Loaders\RobotLoader;
use ReflectionClass;

final class PublicGenerator
{
    public function getAllClasses()
    {
        $robotLoader = new RobotLoader();
        $robotLoader->addDirectory(__DIR__ . '/../resources');
        $robotLoader->acceptFiles = ['*.php']; // optional to reduce file count
        $robotLoader->rebuild();

        $foundClasses = array_keys($robotLoader->getIndexedClasses());

        foreach ($foundClasses as $class) {
            $reflect = new ReflectionClass($class);
            if ($reflect->implementsInterface(TypeScriptGeneratorContract::class)) {
                $typescripted[] = $class;
            }
        }

        return $typescripted ?? [];
    }

    public function generate(array $typescripted, string $folderTo)
    {
        $generator = new Generators\GenerateFromClass(new InterfaceGenerator());
        foreach ($typescripted as $file) {
            $generated = $generator->generateFrom($file);
            $fileName = $folderTo. filter_var($file, FILTER_SANITIZE_EMAIL) . '.ts';
            file_put_contents($fileName, $generated);
        }
    }
}