# Properties Reference

Properties are YAML frontmatter at the top of the note between `---` delimiters.

## Format

```yaml
---
key: value
tags:
  - tag1
  - tag2
aliases:
  - alternate name
---
```

Each property name must be unique within a note. Order does not matter.

## Property Types

| Type | Example | Notes |
|------|---------|-------|
| Text | `title: My Note` | Single line, no markdown rendering |
| List | `items:\n  - one\n  - two` | Each value on own line with `- ` |
| Number | `year: 2024` | Integers and decimals, no expressions |
| Checkbox | `draft: true` | `true` or `false` |
| Date | `date: 2024-01-15` | `YYYY-MM-DD` format |
| Date & time | `time: 2024-01-15T10:30:00` | ISO 8601 format |
| Tags | `tags:\n  - journal` | Reserved for `tags` property only |

### Internal Links in Properties

Wrap in quotes:

```yaml
---
related: "[[Other Note]]"
sources:
  - "[[Reference 1]]"
  - "[[Reference 2]]"
---
```

## Default Properties

| Property | Type | Purpose |
|----------|------|---------|
| `tags` | Tags | Categorize the note |
| `aliases` | List | Alternative names for linking |
| `cssclasses` | List | Apply CSS snippets to this note |

### Publish Properties

| Property | Purpose |
|----------|---------|
| `publish` | Control publish visibility |
| `permalink` | Custom URL path |
| `description` | Social media preview text |
| `image` / `cover` | Social media preview image |

## JSON Alternative

```
---
{
  "tags": ["journal"],
  "publish": false
}
---
```

JSON is read, interpreted, and saved as YAML by Obsidian.
