# Thor Safe Type package

Provides some safe types.

## Types

### `Unwrap` type
An interface defining utility methods for extracting
contained values from a structure.

* `unwrapOrElse(callable $ifNot): mixed`  
  Returns the contained value if it is safe to return or else calls the function `$ifNot` and returns its returned value.
* `unwrapOr(mixed $default): mixed`  
  Returns the contained value if it is safe to return or else returns `$default`.
* `unwrapOrThrow(Throwable): mixed`  
  Returns the contained value if it is safe to return or else throws the specified `Throwable`.
* `unwrap(): mixed`  
  Returns the contained value if it is safe to return or else throws a `RuntimeException`.

> * Extended by `Option` and `Either`.
> * Implemented by `Result`

---

### `Option` type

> Extends `Unwrap`
 
The `Maybe` enumeration has the cases `SOME` and `NONE`.

* `is(): Maybe`  
  Returns the nature of the Option `Maybe::SOME` or `Maybe::NONE`.
* `isNone(): bool`  
  This function return `true` if the Option contains no value.
* `isSome(): bool`  
  This function return `false` if the Option contains a value.
* `isA(Maybe $maybe): bool`  
  Returns true if the `Option` corresponds the nature described by the specified `Maybe`.
* `match(callable $ifSome, callable $ifNone): mixed`  
  Call the function `$ifSome` if the Option contains a value or call the  function `$ifNone` if not.
* `map(callable(mixed): mixed $f): $this`  
  Returns a `Some($value)` if this `Option::isSome()` else returns a `None`.
* `from(mixed $data): static`  
  Creates an `Option` according to the specified value.

> * Extended by the abstract class `SomeOrNone`.
> * Implemented by the final types `Some` and `None`.

## License

Copyright 2025 Sébastien GELDREICH

License MIT
