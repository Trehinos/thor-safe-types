<?php

namespace Thor\Types\Option;

use Thor\Concepts\Maybe;
use TypeError;

final class Some extends SomeOrNone
{

    /**
     * @throws TypeError
     */
    public function __construct(private(set) mixed $value)
    {
        if ($value === null) {
            throw new TypeError('Cannot create a Some with a null value.');
        }
        parent::__construct();
    }

    public function is(): Maybe
    {
        return Maybe::SOME;
    }

    public function match(callable $ifSome, callable $ifNone): mixed
    {
        return $ifSome($this->value);
    }

}
