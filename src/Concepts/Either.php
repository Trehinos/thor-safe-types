<?php

namespace Thor\Concepts;

use Thor\Types\Either\Left;
use Thor\Types\Either\Right;

/**
 * @template T
 * @type Either<T>
 */
interface Either extends Unwrap, Matchable {
    public function isLeft(): bool;
    public function isRight(): bool;
    public function isA(EitherCase $case): bool;
    public function toLeft(): Left;
    public function toRight(): Right;
    public function left(): Option;
    public function right(): Option;
    public function leftOr(mixed $value): mixed;
    public function rightOr(mixed $value): mixed;

    /**
     * Call the function $iLeft  if the Either is a left-value or call the
     * function $ifRight it is a right-value.
     *
     * The function `map` returns the value returned by the called function.
     */
     public function match(callable $ifLeft, callable $ifRight);

    /**
     * @param EitherCase $case
     * @param callable(Either) : Either $f
     *
     * @return self
     */
    public function map(EitherCase $case, callable $f): self;

}
