<?php

namespace Thor\Types\Either;

use Thor\Concepts\Either;
use Thor\Concepts\EitherCase;
use Thor\Concepts\Option;
use Thor\Types\Option\SomeOrNone;

final class Left extends LeftOrRight
{

    public function __construct(mixed $value) {
        parent::__construct($value);
    }

    public function toRight(): Either
    {
        return new Right($this->value);
    }

    public function left(): Option
    {
        return SomeOrNone::from($this->value);
    }

    public function is(): EitherCase {
        return EitherCase::LEFT;
    }

}
