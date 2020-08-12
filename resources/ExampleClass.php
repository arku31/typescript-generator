<?php

namespace Arku\Resources;

final class ExampleClass implements ExampleInterface
{

    public function getId(): int
    {
       return 1;
    }

    public function getName(): string
    {
       return 'testName';
    }

    public function getValue(): ?string
    {
        return null;
    }
}