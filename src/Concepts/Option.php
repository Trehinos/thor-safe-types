<?php

namespace Thor\Concepts;

use Throwable;

/**
 * ### Option interface
 *
 * Describe an object that can be either contain no value (`isNone()`) or a value (`isSome()`).
 *
 * ### Example
 *
 * ```php
 * use Thor\Concepts\Maybe;
 * use Thor\Types\Option\SomeOrNone;
 *
 * $myOption = SomeOrNone::from("data...");
 * // $myOption->isA(Maybe::SOME) === true
 * echo $myOption->unwrapOr('');
 * ```
 */
interface Option extends Unwrap, Matchable
{

    /**
     * Returns the nature of the Option. The function can return :
     *
     *  - a `Maybe::NONE` (if the Option contains no data),
     *  - or a `Maybe::SOME` (if the Option contains some data).
     */
    public function is(): Maybe;

    /**
     * This function return `true` if the Option contains no value.
     */
    public function isNone(): bool;

    /**
     * This function return `false` if the Option contains a value.
     */
    public function isSome(): bool;

    /**
     * Returns true if the Option corresponds the nature described by the specified `Maybe`.
     */
    public function isA(Maybe $maybe): bool;

    /**
     * Call the function $ifSome if the Option contains a value or call the
     * function $ifNone if not.
     *
     * The function `map` returns the value returned by the called function.
     */
    public function match(callable $ifSome, callable $ifNone): mixed;

    /**
     * Returns a `Some($value)` if this `Option::isSome()` else returns a `None`.
     *
     * @param callable(mixed): mixed $f
     *
     * @return $this
     */
    public function map(callable $f): static;

    /**
     * Creates an `Option` according to the specified value.
     *
     * This function calls `Option::some($data)` if $data is not `null` or else it calls `Option::none()`.
     */
    public static function from(mixed $data): self;

}
