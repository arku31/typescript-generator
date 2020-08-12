<?php

namespace Arku\Builders;

use Arku\Models\MethodModel;
use ReflectionMethod;

final class MethodModelBuilder
{
    /**
     * @param ReflectionMethod $reflectionMethod
     * @return MethodModel
     */
    public static function build(ReflectionMethod $reflectionMethod): MethodModel
    {
        return new MethodModel(
            self::getMethodName($reflectionMethod),
            $reflectionMethod->getReturnType()
        );
    }

    /**
     * @param ReflectionMethod $reflectionMethod
     * @return string
     */
    private static function getMethodName(ReflectionMethod $reflectionMethod): string
    {
        return strtolower(explode('get', $reflectionMethod->getName())[1]);
    }
}