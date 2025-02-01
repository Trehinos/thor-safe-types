<?php

namespace Thor\Types\Validation;

use Closure;

class Validator
{
    /**
     * @var Closure(mixed):bool $validation
     */
    private Closure $validate;

    /**
     * @param Closure(mixed):bool | callable(mixed):bool $validation
     */
    public function __construct(Closure|callable $validation)
    {
        $this->validate = $validation(...);
    }

    public final function __invoke(mixed $toValidate): bool
    {
        return ($this->validate)($toValidate);
    }
}
