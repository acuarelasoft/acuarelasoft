# Narrowing Types

## Prefer Precise Types

Avoid narrowing when possible by using precise parameter and return types:

```php
// Good: precise parameter type
function doFoo(Article $a): void { }

// Good: precise return type
function doBar(): Article { return $article; }
```

## Built-in Narrowing

### Strict Comparison (`===`, `!==`)

```php
if ($stringOrBool === true) {
    // $stringOrBool is true
}

assert($stringOrBool === true);
// $stringOrBool is true after assert()
```

### Type-checking Functions

`is_array()`, `is_bool()`, `is_callable()`, `is_float()`, `is_int()`, `is_numeric()`, `is_iterable()`, `is_null()`, `is_object()`, `is_resource()`, `is_scalar()`, `is_string()`, `is_subclass_of()`, `is_a()`

### instanceof

```php
if ($exception instanceof \InvalidArgumentException) {
    // $exception is \InvalidArgumentException
}
```

## Custom Type-checking Functions

Use `@phpstan-assert` tags to inform PHPStan about type narrowing in custom functions:

### @phpstan-assert (throws on failure)

```php
/** @phpstan-assert BarService $object */
public function checkType(object $object): void
{
    if (!$object instanceof BarService) {
        throw new WrongObjectTypeException();
    }
}
```

### @phpstan-assert-if-true / @phpstan-assert-if-false

```php
/** @phpstan-assert-if-true \stdClass $arg */
public function isStdClass(mixed $arg): bool
{
    return $arg instanceof \stdClass;
}
```

### With Generics

```php
/**
 * @template T of object
 * @param class-string<T> $class
 * @phpstan-assert-if-true T $object
 */
public function isObjectOfClass(string $class, object $object): bool
{
    return $object instanceof $class;
}
```

### Type Negation

```php
/** @phpstan-assert !string $arg */
public function checkNotString(mixed $arg): void
{
    if (is_string($arg)) { throw new \Exception(); }
}
```

### Hassers and Getters

```php
/** @phpstan-assert-if-true !null $this->getName() */
public function hasName(): bool
{
    return $this->name !== null;
}

public function getName(): ?string
{
    return $this->name;
}
```

### The `=` Operator (disable false-branch narrowing)

Use `=` when the `false` return doesn't guarantee the negation:

```php
/** @phpstan-assert-if-true =Admin $this->admin */
public function isAdmin(): bool
{
    return $this->admin !== null && $this->admin->active === true;
}

// In the else branch, $this->admin stays Admin|null (not narrowed to null)
```

## Solving Undefined Variables

### Early Terminating Methods

Configure methods that halt execution (like `redirect()`) so PHPStan knows subsequent code is unreachable:

```yaml
parameters:
  earlyTerminatingMethodCalls:
    Nette\Application\UI\Presenter:
      - redirect
      - redirectUrl
  earlyTerminatingFunctionCalls:
    - redirect
```

Or use `@return never` on the function/method instead.
