<?php

use PHPUnit\Framework\TestCase;
use Thor\Concepts\Maybe;
use Thor\Types\Option\None;
use Thor\Types\Option\Some;
use Thor\Types\Option\SomeOrNone;

final class OptionTest extends TestCase
{

    public function testNoneCreation() {
        $none = new None();
        $none2 = SomeOrNone::from(null);
        $this->assertEquals($none, $none2);
    }

    public function testUnwrapException() {
        $none = new None();
        $this->expectException(LogicException::class);
        $_ = $none->unwrap();
    }

    public function testUnwrapCustomException() {
        $none = new None();
        $this->expectException(Throwable::class);
        $_ = $none->unwrapOrThrow(new Exception('custom exception'));
    }

    public function testDefaultValue() {
        $some = new Some(1);
        $none = new None();
        $this->assertEquals($some->unwrapOr(0), $none->unwrapOr(1));
    }

    public function testMaybe() {
        $some = new Some(1);
        $none = new None();
        $this->assertEquals(Maybe::SOME, $some->is());
        $this->assertEquals(Maybe::NONE, $none->is());
    }

}
