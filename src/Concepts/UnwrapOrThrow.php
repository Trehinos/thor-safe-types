<?php

namespace Thor\Concepts;

use Throwable;

/**
 * @implements Unwrap
 */
trait UnwrapOrThrow {
    public function unwrapOr(mixed $default): mixed
    {
        return $this->unwrapOrElse(fn() => $default);
    }

    public function unwrapOrThrow(Throwable $t): mixed
    {
        return $this->unwrapOrElse(fn() => throw $t);
    }

    public function unwrap(): array
    {
        return $this->unwrapOrThrow(new \LogicException('Cannot happen.'));
    }
}
