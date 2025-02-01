<?php


namespace Thor\Types\Either;

use Thor\Concepts\Either;
use Thor\Concepts\EitherCase;
use Thor\Concepts\Option;
use Thor\Concepts\UnwrapOrThrow;
use Thor\Types\Option\None;

abstract class LeftOrRight implements Either
{

    use UnwrapOrThrow;

    public function __construct(protected readonly mixed $value) { }

    public function toLeft(): Left
    {
        return new Left($this->value);
    }

    public function toRight(): Right
    {
        return new Right($this->value);
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
        return $this->left()->unwrapOr($value);
    }

    public function rightOr(mixed $value): mixed
    {
        return $this->right()->unwrapOr($value);
    }

    public function isLeft(): bool
    {
        return $this->is() === EitherCase::LEFT;
    }

    abstract public function is(): EitherCase;

    public function isRight(): bool
    {
        return $this->is() === EitherCase::RIGHT;
    }

    public function isA(EitherCase $case): bool
    {
        return $this->is() === $case;
    }

    public function match(callable $ifLeft, callable $ifRight): mixed
    {
        return match ($this->is()) {
            EitherCase::LEFT => $ifLeft($this->value),
            EitherCase::RIGHT => $ifRight($this->value),
        };
    }

    /**
     * @param EitherCase              $case
     * @param callable(mixed) : mixed $f
     *
     * @return self
     */
    public function map(EitherCase $case, callable $f): Either
    {
        if (!$this->isA($case)) {
            return $this;
        }
        return match ($case) {
            EitherCase::LEFT => new Left($f($this->value)),
            EitherCase::RIGHT => new Right($f($this->value)),
        };
    }


    public function unwrapOrElse(callable $ifNot): mixed
    {
        return $this->leftOr($this->rightOr($ifNot()));
    }

}
