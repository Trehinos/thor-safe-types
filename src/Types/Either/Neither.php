<?php

namespace Thor\Types\Either;

use LogicException;
use Thor\Concepts\Either;
use Thor\Concepts\EitherCase;
use Thor\Concepts\Option;
use Thor\Types\Option\None;
use Throwable;

final class Neither implements Either
{

    public function __construct()
    {
    }

    public function isLeft(): bool
    {
        return true;
    }

    public function isRight(): bool
    {
        return false;
    }

    public function toLeft(): Either
    {
        return new Left(null);
    }

    public function toRight(): Either
    {
        return new Right(null);
    }

    public function left(): Option
    {
        return new None;
    }

    public function right(): Option
    {
        return new None;
    }

    public function leftOr(mixed $value): mixed
    {
        return $value;
    }

    public function rightOr(mixed $value): mixed
    {
        return $value;
    }

    public function isA(EitherCase $case): bool
    {
        return false;
    }

    public function match(callable $ifLeft, callable $ifRight): void
    {
    }

    public function map(EitherCase $case, callable $f): Either
    {
        return $f(null);
    }

    public function unwrapOrElse(callable $ifNot): mixed
    {
        return $ifNot();
    }

    public function unwrapOr(mixed $default): mixed
    {
        return $default;
    }

    public function unwrapOrThrow(Throwable $t): never
    {
        throw $t;
    }

    public function unwrap(): never
    {
        throw new LogicException('Cannot unwrap a Neither');
    }
}
