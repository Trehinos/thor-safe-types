<?php

namespace Thor\Concepts;

interface Matchable
{

    /**
     * Call the function $ifA if some conditions are met or e;se $ifB.
     *
     * The function `map` returns the value returned by the called function.
     */
    public function match(callable $ifA, callable $ifB);
}
