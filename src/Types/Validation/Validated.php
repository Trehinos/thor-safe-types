<?php

namespace Thor\Types\Validation;

use Closure;
use Thor\Concepts\Option;
use Thor\Types\Option\None;
use Thor\Types\Option\Some;
use Throwable;

final class Validated
{

    /**
     * @var Option Safely access the value if it `isValid()`.
     */
    private(set) Option $validatedOption;

    /**
     * @var mixed Safely edit the validated value with this object validation function.
     *            Getting the value is "unsafe", it may throw a `Throwable` if the value `isInvalid()`.
     *            Prefer the use of `$this->toOption()` or `$this->validatedOption` to access the value safely.
     *
     */
    public mixed $value {
        get => $this->validatedOption->unwrap();
        set => $this->validatedOption = $this->validatedValue($value);
    }

    private Validator $validate;

    public function __construct(Validator $validator, mixed $value = null)
    {
        $this->validate = $validator;
        $this->validatedOption = self::validateValue($this->validate, $value);
    }

    public static function validateValue(Closure|callable $validation, mixed $value = null): Option
    {
        return $validation($value) ? new Some($value) : new None();
    }

    public function validatedValue(mixed $value = null): Option
    {
        return self::validateValue($this->validate, $value);
    }

    public function match(callable $ifValid, callable $ifInvalid): mixed
    {
        return $this->validatedOption->match($ifValid, $ifInvalid);
    }

    public function unwrapOrElse(callable $ifInvalid): mixed
    {
        return $this->validatedOption->unwrapOrElse($ifInvalid);
    }

    public function unwrapOr(mixed $ifInvalid): mixed
    {
        return $this->validatedOption->unwrapOr($ifInvalid);
    }

    public function toOption(): Option
    {
        return $this->validatedOption;
    }

    /**
     * @throws Throwable
     */
    public function unwrap(): mixed
    {
        return $this->validatedOption->unwrap();
    }

    public function isValid(): bool
    {
        return $this->validatedOption->isSome();
    }

    public function isInvalid(): bool
    {
        return $this->validatedOption->isNone();
    }

    private static function test(): void
    {
        $valid = new Validated(new Validator(fn(mixed $v): bool => is_string($v)), 1);
        assert($valid->isInvalid());
        $valid->value = "";
        assert($valid->isValid());
        assert($valid->value === "");
    }


}
