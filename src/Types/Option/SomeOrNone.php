<?php

namespace Thor\Types\Option;

use LogicException;
use Thor\Concepts\Maybe;
use Thor\Concepts\Option;
use Throwable;

abstract class SomeOrNone implements Option
{

    protected function __construct()
    {
    }

    public function isNone(): bool
    {
        return $this->is() === Maybe::NONE;
    }

    public function isSome(): bool
    {
        return $this->is() === Maybe::SOME;
    }

    public function isA(Maybe $maybe): bool
    {
        return $this->is() === $maybe;
    }

    /**
     * Returns the contained value if the option is SOME or else call the function `$ifNot` and returns its returned value.
     */
    public function unwrapOrElse(callable $ifNot): mixed
    {
        return $this->match(
            fn(mixed $some) => $some,
            $ifNot
        );
    }

    /**
     * Returns the contained value if the option is SOME or else returns `$default`.
     */
    public function unwrapOr(mixed $default): mixed
    {
        return $this->unwrapOrElse(fn() => $default);
    }

    /**
     * Returns the contained value if the option is SOME or else throws the specified `Throwable`.
     *
     * @throws Throwable
     */
    public function unwrapOrThrow(Throwable $t): mixed
    {
        return $this->unwrapOrElse(fn() => throw $t);
    }
    /**
     * Returns the contained value if the option is SOME or else throws a `RuntimeException`.
     *
     * @throws Throwable
     */
    public function unwrap(): mixed
    {
        return $this->unwrapOrThrow(new LogicException("Option : trying to unwrap a None value."));
    }

    public function map(callable $f): static
    {
        return $this->match(
            fn(mixed $some) => new Some($f($some)),
            fn() => new None(),
        );
    }

    public static function from(mixed $data): static
    {
        return match ($data) {
            null => new None(),
            default => new Some($data)
        };
    }

}
