<?php

namespace Thor\Types;

use Thor\Concepts\Either;
use Thor\Concepts\EitherCase;
use Thor\Concepts\Option;
use Thor\Concepts\ResultType;
use Thor\Concepts\Unwrap;
use Thor\Types\Either\Left;
use Thor\Types\Either\LeftOrRight;
use Thor\Types\Either\Right;
use Throwable;

final readonly class Result implements Unwrap
{
    public function __construct(private LeftOrRight $either)
    {
    }

    public function createOk(mixed $value): Result
    {
        return new Result(new Left($value));
    }

    public function createError(mixed $value): Result
    {
        return new Result(new Right($value));
    }

    public function match(callable $ifOk, callable $ifError): mixed
    {
        return $this->either->match($ifOk, $ifError);
    }

    public function unwrapOrThrow(Throwable $t): mixed
    {
        return $this->either->leftOr(fn() => throw $t);
    }

    public function unwrapOrElse(callable $ifNot): mixed
    {
        return $this->either->leftOr($ifNot());
    }

    public function unwrapOr(mixed $default): mixed
    {
        return $this->either->leftOr($default);
    }

    public function toEither(): Either
    {
        return $this->either;
    }

    /**
     * @throws Throwable
     */
    public function unwrap(): mixed
    {
        return $this->either->left()->unwrap();
    }

    public function isOk(): bool
    {
        return $this->either->isLeft();
    }

    public function isError(): bool
    {
        return $this->either->isRight();
    }

    public function ok(): Option
    {
        return $this->either->left();
    }

    public function error(): Option
    {
        return $this->either->right();
    }

    /**
     * @param callable(mixed): mixed $f
     *
     * @throws Throwable
     */
    public function map(ResultType $t, callable $f): Result
    {
        return match ($t) {
            ResultType::OK => self::createOk($this->either->map(EitherCase::LEFT, $f)->left()->unwrap()),
            ResultType::ERROR => self::createError($this->either->map(EitherCase::RIGHT, $f)->right()->unwrap()),
        };
    }

    public function and(self $other): Result
    {
        if ($this->isOk()) {
            return $other;
        }
        return $this;
    }

    public function or(self $other): Result
    {
        if ($this->isError()) {
            return $other;
        }
        return $this;
    }
}
