<?php
namespace Arku\Resources;

use Arku\Contracts\TypeScriptGeneratorContract;

interface ExampleInterface extends TypeScriptGeneratorContract
{
    public function getId(): int;
    public function getName(): string;
    public function getValue(): ?string;
}