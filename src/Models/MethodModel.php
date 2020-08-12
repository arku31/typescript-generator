<?php
namespace Arku\Models;

use ReflectionType;

final class MethodModel
{
    private const MAPPINGS = [
        'int' => 'number',
    ];

    /**
     * @var string
     */
    private $name;

    /**
     * @var ReflectionType
     */
    private $reflectionType;

    /**
     * MethodModel constructor.
     * @param string $name
     * @param ReflectionType $type
     */
    public function __construct(string $name, ReflectionType $type)
    {
        $this->name = $name;
        $this->reflectionType = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->reflectionType->getName();
    }

    /**
     * @return string
     */
    public function getTypescriptType()
    {
        $type = $this->getMapped($this->getType());

        if ($this->reflectionType->allowsNull()) {
            $type .='|null';
        }

        return $type;
    }

    /**
     * @param string $type
     * @return string
     */
    private function getMapped(string $type): string
    {
        if (array_key_exists($type, self::MAPPINGS)) {
            return self::MAPPINGS[$type];
        }
        return $type;
    }
}