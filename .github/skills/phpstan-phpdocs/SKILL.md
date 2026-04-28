---
name: phpstan-phpdocs
description: Write PHPDoc annotations that PHPStan can read for static analysis of PHP code. Use when writing or reviewing PHP code that needs type annotations, generics, array shapes, type narrowing, custom assertions, template types, conditional return types, or any PHPStan-compatible PHPDoc. Triggers on PHP files, PHPDoc blocks, PHPStan type errors, or requests to add/fix type annotations.
---

# PHPStan PHPDocs

Write PHPDoc annotations that PHPStan understands for static type analysis. Always use `/** */` blocks (not `/* */` or `//`). Prefer native PHP type hints where possible; use PHPDocs to augment with information PHP can't express natively.

## Core PHPDoc Tags

### Functions and Methods

```php
/**
 * @param Foo $param
 * @return Bar
 */
function foo($param) { ... }
```

### Properties

```php
/** @var Foo */
private $bar;
```

### Combining with Native Types

Use PHPDocs to specify what's inside arrays or to refine native types:

```php
/** @param User[] $users */
function foo(array $users) { ... }

/** @param array<int, User> $users */
function foo(array $users) { ... }

/** @return static */
public function returnStatic(): self { return $this; }
```

## Generics

### Define Type Variables

```php
/**
 * @template T
 * @param T $value
 * @return T
 */
function identity(mixed $value): mixed { return $value; }

/** @template T of Animal */  // upper bound
/** @template T = string */    // default type
/** @template T of object = stdClass */  // bound + default
```

### Variance

- `@template-covariant T` — `Collection<Cat>` accepted where `Collection<Animal>` expected (read-only)
- `@template-contravariant T` — `Comparator<Animal>` accepted where `Comparator<Cat>` expected (write-only)

### Extending Generic Classes

```php
/**
 * @extends Collection<Dog>
 * @implements Countable<Dog>
 */
class DogShelter extends Collection implements Countable { }

/** @use SomeTrait<string> */  // for generic traits
```

## Magic Properties and Methods

```php
/**
 * @property int $foo
 * @property-read string $bar
 * @property-write \stdClass $baz
 */
class Foo { ... }

/**
 * @method int computeSum(int $a, int $b)
 * @method static int staticMethod()
 */
class Foo { ... }
```

## Callables

### Invocation Timing

```php
/** @param-immediately-invoked-callable $cb */
/** @param-later-invoked-callable $cb */
```

### Closure $this Binding

```php
/** @param-closure-this Bar $cb */
function doFoo(Closure $cb) { ... }
```

## Custom Type Assertions

Inform PHPStan about type narrowing in custom functions:

```php
/** @phpstan-assert BarService $object */
public function checkType(object $object): void { ... }

/** @phpstan-assert-if-true \stdClass $arg */
public function isStdClass(mixed $arg): bool { ... }

/** @phpstan-assert-if-true !null $this->getName() */
public function hasName(): bool { ... }

// Use = to disable false-branch narrowing:
/** @phpstan-assert-if-true =Admin $this->admin */
public function isAdmin(): bool { ... }
```

## Self-Out (Mutating Generic State)

```php
/**
 * @template TItemValue
 * @param TItemValue $item
 * @phpstan-self-out self<TValue|TItemValue>
 */
public function add($item): void { ... }
```

## Parameter Out (By-Reference)

```php
/** @param-out int $i */
function foo(mixed &$i): void { $i = 5; }
```

## Mixins

```php
/** @mixin A */
class B { ... }  // B delegates unknown calls to A

/** @template T  @mixin T */
class Delegatee { ... }  // generic mixin
```

## Class-Level Tags

| Tag | Purpose |
|-----|---------|
| `@immutable` / `@readonly` | All properties treated as readonly |
| `@final` | Prevent extension/override |
| `@internal` | Restrict usage to top-level namespace |
| `@phpstan-consistent-constructor` | Enforce same constructor in children |
| `@no-named-arguments` | Prevent named argument calls |
| `@phpstan-sealed FooClass\|BarClass` | Restrict allowed subtypes |
| `@phpstan-all-methods-impure` | Mark all methods as impure |
| `@phpstan-all-methods-pure` | Mark all methods as pure |
| `@phpstan-require-extends Bar` | Interface/trait requires extending Bar |
| `@phpstan-require-implements Bar` | Trait requires implementing Bar |

## Impure Functions

```php
/** @phpstan-impure */
function impureFunction(): bool { return rand(0, 1) === 0; }

/** @phpstan-pure */
function pureFunction(int $a): int { return $a * 2; }
```

## Deprecations

```php
/** @deprecated Use newMethod() instead */
public function oldMethod(): void { ... }

/** @not-deprecated */  // break inheritance chain
public function doFoo(): void { ... }
```

## Prefixed Tags

Use `@phpstan-` prefix when IDEs don't understand advanced types:

```php
/**
 * @param Foo $param
 * @phpstan-param Foo&Bar $param
 */
```

Supported: `@phpstan-var`, `@phpstan-param`, `@phpstan-return`, and all generics tags.

## Inline @var (Last Resort)

```php
/** @var Foo $foo */
$foo = createFoo();
```

Prefer fixing types at the source (stub files, generics, dynamic return type extensions). If unavoidable, consider `assert()` instead.

## Solving Undefined Variables

Mark never-returning functions with `@return never`. Configure early-terminating methods in phpstan config:

```yaml
parameters:
  earlyTerminatingMethodCalls:
    Nette\Application\UI\Presenter:
      - redirect
```

## References

- **Full type syntax**: See [references/phpdoc-types.md](references/phpdoc-types.md) for complete list of all PHPDoc types (array shapes, conditional returns, integer masks, offset access, type aliases, etc.)
- **Type narrowing**: See [references/narrowing-types.md](references/narrowing-types.md) for custom assertions, type guards, and solving undefined variables