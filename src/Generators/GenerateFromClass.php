<?php

namespace Arku\Generators;

use Arku\Builders\MethodModelBuilder;
use Arku\Models\MethodModel;
use ReflectionClass;
use ReflectionMethod;

final class GenerateFromClass
{
    /**
     * @var InterfaceGenerator
     */
    private $generator;

    /**
     * InterfaceGeneratorEntry constructor.
     * @param InterfaceGenerator $generator
     */
    public function __construct(InterfaceGenerator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param string $className
     * @return string
     * @throws \ReflectionException
     */
    public function generateFrom(string $className): string
    {
        $reflection = new ReflectionClass($className);
        $interfaceName = $reflection->getShortName();
        $methods = $reflection->getMethods();
        return $this->generator->generate($interfaceName, $this->extractGetters($methods));
    }

    /**
     * @param ReflectionMethod[] $methods
     * @return MethodModel[]
     */
    private function extractGetters(array $methods)
    {
        foreach ($methods as $method) {
            if (strpos($method->getName(), 'get', 0) === 0) {
                $getters[] = MethodModelBuilder::build($method);
            }
        }
        return $getters ?? [];
    }

}