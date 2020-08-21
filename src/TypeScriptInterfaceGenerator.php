<?php

namespace Arku;

use Arku\Contracts\TypeScriptGeneratorContract;
use Arku\Generators\InterfaceGenerator;
use Nette\Loaders\RobotLoader;
use ReflectionClass;

final class TypeScriptInterfaceGenerator
{
    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getAllClasses()
    {
        $robotLoader = new RobotLoader();
        $robotLoader->addDirectory(__DIR__ . '/../resources');
        $robotLoader->acceptFiles = ['*.php'];
        $robotLoader->rebuild();

        $foundClasses = array_keys($robotLoader->getIndexedClasses());

        foreach ($foundClasses as $class) {
            $reflect = new ReflectionClass($class);
            if ($this->shouldGenerateInterface($reflect)) {
                $typescripted[] = $class;
            }
        }

        return $typescripted ?? [];
    }

    /**
     * @param array $typescripted
     * @param string $folderTo
     * @throws \ReflectionException
     */
    public function generate(array $typescripted, string $folderTo): void
    {
        $generator = new Generators\GenerateFromClass(new InterfaceGenerator());
        foreach ($typescripted as $file) {
            $generated = $generator->generateFrom($file);
            $fileName = $folderTo. filter_var($file, FILTER_SANITIZE_EMAIL) . '.ts';
            file_put_contents($fileName, $generated);
        }
    }

    /**
     * @param ReflectionClass $reflect
     * @return bool
     */
    private function shouldGenerateInterface(ReflectionClass $reflect): bool
    {
        return ($reflect->implementsInterface(TypeScriptGeneratorContract::class) && $reflect->isInterface());
    }
}