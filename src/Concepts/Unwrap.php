<?php

namespace Thor\Concepts;

use Throwable;

/**
 * An interface defining utility methods for extracting
 * contained values from a structure.
 */
interface Unwrap
{
    /**
     * Returns the contained value if the option is SOME or else call the function `$ifNot` and returns its returned value.
     */
    public function unwrapOrElse(callable $ifNot): mixed;

    /**
     * Returns the contained value if the option is SOME or else returns `$default`.
     */
    public function unwrapOr(mixed $default): mixed;

    /**
     * Returns the contained value if the option is SOME or else throws the specified `Throwable`.
     *
     * @throws Throwable
     */
    public function unwrapOrThrow(Throwable $t): mixed;

    /**
     * Returns the contained value if the option is SOME or else throws a predefined `Throwable`.
     *
     * @throws Throwable
     */
    public function unwrap(): mixed;

}
