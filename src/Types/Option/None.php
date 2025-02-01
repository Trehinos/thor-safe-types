<?php

namespace Thor\Types\Option;

use Thor\Concepts\Maybe;

final class None extends SomeOrNone
{

    public function __construct()
    {
        parent::__construct();
    }

    public function is(): Maybe
    {
        return Maybe::NONE;
    }

    public function match(callable $ifSome, callable $ifNone): mixed
    {
        return $ifNone();
    }
}
