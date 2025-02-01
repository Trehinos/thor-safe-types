<?php

namespace Thor\Concepts;

use Throwable;

interface Validate extends Matchable, Unwrap
{
    public function match(callable $ifValid, callable $ifInvalid): mixed;

    public function toOption(): Option;

    public function isValid(): bool;

    public function isInvalid(): bool;

}
