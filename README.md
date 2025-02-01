# Thor Safe Types package

Provides some safe types :
* `Unwrap`
  * implemented by `Result`
    * nature is `ResultType::OK` or `ResultType::ERROR`,
  * and with `Matchable`, extended by :
    * `Option` : 
      * nature is `Maybe::SOME` or `Maybe::None`,
      * extended by `SomeOrNone`,
        * implemented by `Some` and `None`,
    * `Either` :
      * nature is `EitherCase::Left` and/or `EitherCase::Right` 
      * implemented by `Neither` and `Both`,
      * extended by `LeftOrRight` :
        * implemented by `Left` and `Right`,
    * `Validate`
      * implemented by `Validated`,
      * `Validator` is a derivable `Closure` class which encapsulate a `fn(mixed): bool`.

## Types

### `Unwrap` type 
An interface defining utility methods for extracting
contained values from a structure.

* `unwrapOrElse(callable $ifNot): mixed` : returns the contained value if it is safe to return or else calls the function `$ifNot` and returns its returned value.
* `unwrapOr(mixed $default): mixed` : returns the contained value if it is safe to return or else returns `$default`.
* `unwrapOrThrow(Throwable): mixed` : returns the contained value if it is safe to return or else throws the specified `Throwable`.
* `unwrap(): mixed` : returns the contained value if it is safe to return or else throws a `RuntimeException`.

> * Extended by the interfaces `Option` and `Either`.
> * Implemented by the final class `Result`.


---

### `Matchable`

* `match(callable $ifA, callable $ifB)` : Call the function $ifA if some conditions are met or e;se $ifB. It returns the value returned by the called function.

---

### `Option` type

> Extends `Unwrap` and `Matchable`.
 
The `Maybe` enumeration has the cases `SOME` and `NONE`.

* `is(): Maybe` : returns the nature of the Option `Maybe::SOME` or `Maybe::NONE`.
* `isNone(): bool` : this function return `true` if the Option contains no value.
* `isSome(): bool` : this function return `false` if the Option contains a value.
* `isA(Maybe $maybe): bool` : returns true if the `Option` corresponds the nature described by the specified `Maybe`.
* `map(callable(mixed): mixed $f): $this` : returns a `Some($value)` if this `Option::isSome()` else returns a `None`.
* `from(mixed $data): static` : creates an `Option` according to the specified value.

> * Extended by the abstract class `SomeOrNone`.
> * Implemented by the final types `Some` and `None`.

---

### `Either` type

> Extends `Unwrap` and `Matchable`.

The `EitherCase` enumeration has the cases `LEFT` and `RIGHT`.

* `isA(EitherCAse): bool`
* `isLeft(): bool`
* `toLeft(): Left`
* `left(): Option`
* `leftOr(mixed): mixed`
* `isRight(): bool`
* `toRight(): Right`
* `right(): Option`
* `rightOr(mixed): mixed`

> * Extended by the abstract class `LeftOrRight`.
> * Implemented by the final types `Both` and `Neither`.

---

### `LeftOrRight` type

> Implements partially `Either`.

* `is(): EitherCase`

> Implemented by the final types `Left` and `Right`.

---

### `Validate`

> Extends `Unwrap` and `Matchable`.

* `toOption(): Option`
* `isValid(): bool`
* `isInvalid(): bool`

> Implemented by `Validated`.

## License

Copyright 2025 Sébastien GELDREICH

License MIT
