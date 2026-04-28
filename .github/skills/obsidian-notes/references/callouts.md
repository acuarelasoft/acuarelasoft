# Callouts Reference

## Syntax

```
> [!type] Optional title
> Callout content with **Markdown**, [[Wikilinks]], and ![[embeds]].
```

Default title is the type in title case. Omit body for title-only callouts.

## Foldable Callouts

Add `+` (expanded) or `-` (collapsed) after type:

```
> [!tip]+ Expanded by default
> Content shown.

> [!faq]- Collapsed by default
> Content hidden until clicked.
```

## Nested Callouts

```
> [!question] Outer
> > [!todo] Inner
> > > [!example] Deeper
```

## Supported Types

| Type | Aliases | Use for |
|------|---------|---------|
| `note` | — | General notes, default for unknown types |
| `abstract` | `summary`, `tldr` | Summaries, overviews |
| `info` | — | Informational content |
| `todo` | — | Action items |
| `tip` | `hint`, `important` | Helpful advice |
| `success` | `check`, `done` | Completed items, confirmations |
| `question` | `help`, `faq` | Questions, FAQs |
| `warning` | `caution`, `attention` | Warnings, cautions |
| `failure` | `fail`, `missing` | Failures, missing items |
| `danger` | `error` | Critical warnings, errors |
| `bug` | — | Bug reports |
| `example` | — | Examples |
| `quote` | `cite` | Quotes, citations |

Type identifiers are case-insensitive. Unknown types fall back to `note` styling.
