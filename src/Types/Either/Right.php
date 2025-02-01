<?php

namespace Thor\Types\Either;

use Thor\Concepts\Either;
use Thor\Concepts\EitherCase;
use Thor\Concepts\Option;
use Thor\Types\Option\SomeOrNone;

final class Right extends LeftOrRight
{

    public function __construct(mixed $value)
    {
        parent::__construct($value);
    }

    public function toLeft(): Either
    {
        return new Left($this->value);
    }

    public function right(): Option
    {
        return SomeOrNone::from($this->value);
    }

    public function is(): EitherCase
    {
        return EitherCase::RIGHT;
    }

}
