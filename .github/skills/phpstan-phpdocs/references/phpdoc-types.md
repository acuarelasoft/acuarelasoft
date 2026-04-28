# PHPDoc Types Reference

## Basic Types

`int`, `integer`, `string`, `array-key`, `bool`, `boolean`, `true`, `false`, `null`, `float`, `double`, `number`, `numeric`, `scalar`, `empty-scalar`, `non-empty-scalar`, `empty`, `array`, `associative-array`, `iterable`, `callable`, `pure-callable`, `pure-Closure`, `resource`, `closed-resource`, `open-resource`, `void`, `object`, `callable-object`, `callable-array`

## Mixed

- `mixed` — no type checks applied; any property/method can be called
- `non-empty-mixed` — excludes falsy values (`false`, `0`, `0.0`, `''`, `'0'`, `[]`, `null`)
- Missing typehint = implicit `mixed`; written `mixed` = explicit (level 6 requires explicit)
- Level 9: only allowed operation is passing to another `mixed`

## Integer Ranges

`positive-int`, `negative-int`, `non-positive-int`, `non-negative-int`, `non-zero-int`, `int<0, 100>`, `int<min, 100>`, `int<50, max>`

## String Types

- `class-string`, `class-string<T>`, `class-string<Foo>` — valid class name strings
- `interface-string`, `trait-string`, `enum-string`, `enum-string<T>` — aliases/variants
- `callable-string` — string PHP considers callable
- `numeric-string` — passes `is_numeric()`
- `non-empty-string` — any string except `''`
- `non-falsy-string` / `truthy-string` — true after boolean cast
- `literal-string` — developer-written string (security-focused)
- `lowercase-string`, `uppercase-string`
- Combined: `non-empty-lowercase-string`, `non-empty-uppercase-string`, `non-empty-literal-string`

## Arrays and Lists

### General Arrays

```
Type[]
array<Type>
array<int, Type>
non-empty-array<Type>
non-empty-array<int, Type>
```

### Lists

```
list<Type>
non-empty-list<Type>
```

Lists are arrays with sequential integer keys starting at 0.

### Array Shapes (Tuples / Structs)

```php
array{'foo': int, "bar": string}
array{'foo': int, "bar"?: string}       // optional key
array{int, int}                          // tuple (keys 0, 1)
array{0: int, 1?: int}                  // optional index
array{foo: int, bar: string}            // unquoted keys
array{Foo::BAR: int}                    // class constant key
list{int, string}                       // list shape
non-empty-list{int, string}
non-empty-array{foo: int, bar: string}
```

### Key/Value Extraction

```php
/** @param key-of<Foo::ARRAY_CONST> $type */
/** @param value-of<Foo::ARRAY_CONST> $wheels */
/** @param array<value-of<Suit>, int> $count */  // BackedEnum support
```

## Object Shapes

```php
object{'foo': int, "bar": string}
object{'foo': int, "bar"?: string}       // optional property
object{foo: int, bar?: string}           // unquoted
object{foo: int, bar?: string}&\stdClass // writable (intersect with class)
```

## Iterables

```
iterable<ValueType>
iterable<KeyType, ValueType>
Collection<Type>
Collection<int, Type>
Collection|Type[]                        // Collection iterates over Type
```

## Union, Intersection, Parentheses

```
Type1|Type2                              // union
Type1&Type2                              // intersection
(Type1&Type2)|Type3                      // parentheses for disambiguation
```

## static and $this

- `@return static` — returns same type it's called on (child class aware)
- `@return $this` — narrower; checks same object instance is returned
- `static<T>` — specify type arguments in generic classes

## Generics

```
Collection<Type>
Map<string, Type>
Collection<covariant Type>               // call-site covariance
Collection<contravariant Type>           // call-site contravariance
Collection<*>                            // star projection
```

## Conditional Return Types

```php
/** @return ($size is positive-int ? non-empty-array : array) */
/** @return ($value is not null ? string : never) */

// Combined with generics:
/**
 * @template T of int|array<int>
 * @param T $id
 * @return (T is int ? static : array<static>)
 */
```

## Callables

```
callable(int, int): string
callable(int, int=): string              // optional param
callable(string &$bar): mixed            // by-reference
callable(float ...$floats): (int|null)   // variadic
\Closure(int, int): string               // Closure variant
pure-callable(int, int): string          // no side effects
Closure<T>(T, int): T                    // generic closure
Closure<T of Foo>(T): T                  // bounded generic closure
```

Parameter types and return type are required; use `mixed` if unspecified.

## Literals and Constants

```
234                                      // integer literal
1.0                                      // float literal
'foo'|'bar'                              // string literals
Foo::SOME_CONSTANT
Foo::SOME_CONSTANT|Bar::OTHER_CONSTANT
self::SOME_*                             // wildcard constants
Foo::*                                   // all constants
Foo::FOO_*BAR                            // prefix+suffix pattern
```

## Global Constants

Supported if they don't contain lowercase letters and no same-named class exists: `SOME_CONSTANT`, `SOME_CONSTANT|OTHER_CONSTANT`

## Type Aliases

### Global (config)

```yaml
parameters:
  typeAliases:
    Name: 'string'
    NameResolver: 'callable(): string'
    NameOrResolver: 'Name|NameResolver'
```

### Local

```php
/**
 * @phpstan-type UserAddress array{street: string, city: string, zip: string}
 */
class User
{
    /** @var UserAddress */
    private $address;
}

// Import in another class:
/** @phpstan-import-type UserAddress from User */
/** @phpstan-import-type UserAddress from User as DeliveryAddress */
```

## Bottom Type

`never`, `noreturn`, `never-return`, `never-returns`, `no-return` — function always throws or exits.

## Integer Masks

```
int-mask<1, 2, 4>
int-mask-of<1|2|4>
int-mask-of<Foo::INT_*>
```

## Offset Access

```php
/** @return MyArray['bar'] */                    // access specific key type
/**
 * @template K of key-of<T>
 * @param K $key
 * @return T[K]|null
 */
```

## Utility Types

- `template-type` — extract @template type from a passed argument
- `new` — create object type from class-string type
