<?php
namespace Arku\Generators;

final class InterfaceGenerator
{
    private const INDENTATION = '    ';
    private const DELIMITER = ': ';
    private const EOL = ';';

    /**
     * @param string $interfaceName
     * @param array $properties
     * @return string
     */
    public function generate(string $interfaceName, array $properties): string
    {
        $string = $this->createInterfaceLine($interfaceName);
        foreach ($properties as $methodModel) {
            $string.= $this->createMethodAndTypeLine($methodModel);
        }
        $string .= $this->createEndLine();
        return $string;
    }

    /**
     * @param string $interfaceName
     * @return string
     */
    private function createInterfaceLine(string $interfaceName): string
    {
        return "interface " . $interfaceName . ' {' . PHP_EOL;
    }

    /**
     * @param $methodModel
     * @return string
     */
    private function createMethodAndTypeLine($methodModel): string
    {
        return self::INDENTATION .
            $methodModel->getName() .
            self::DELIMITER .
            $methodModel->getTypescriptType() .
            self::EOL . PHP_EOL;
    }

    /**
     * @return string
     */
    private function createEndLine(): string
    {
        return  '}' . PHP_EOL;
    }
}