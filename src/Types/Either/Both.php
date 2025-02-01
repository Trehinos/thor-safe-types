<?php

namespace Thor\Types\Either;

use Thor\Concepts\Either;
use Thor\Concepts\EitherCase;
use Thor\Concepts\Option;
use Thor\Concepts\UnwrapOrThrow;
use Thor\Types\Option\SomeOrNone;

final class Both implements Either
{
    use UnwrapOrThrow;

    public function __construct(private mixed $left, private mixed $right)
    {
    }

    public function isLeft(): bool
    {
        return true;
    }

    public function isRight(): bool
    {
        return true;
    }

    public function toLeft(): Either
    {
        return new Left($this->left);
    }

    public function toRight(): Either
    {
        return new Right($this->right);
    }

    public function left(): Option
    {
        return SomeOrNone::from($this->left);
    }

    public function right(): Option
    {
        return SomeOrNone::from($this->right);
    }

    public function leftOr(mixed $value): mixed
    {
        return $this->left()->unwrapOr($value);
    }

    public function rightOr(mixed $value): mixed
    {
        return $this->right()->unwrapOr($value);
    }

    public function isA(EitherCase $case): bool
    {
        return true;
    }

    public function match(callable $ifLeft, callable $ifRight): array
    {
        return [$ifLeft($this->left), $ifRight($this->right)];
    }

    public function map(EitherCase $case, callable $f): Either
    {
        return match ($case) {
            EitherCase::LEFT => new Left($f($this->left)),
            EitherCase::RIGHT => new Right($f($this->right)),
        };
    }

    public function unwrapOrElse(callable $ifNot): array
    {
        return [$this->left, $this->right];
    }
}
