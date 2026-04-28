# Links and Embeds Reference

## Table of Contents

- [Internal Links](#internal-links)
- [External Links](#external-links)
- [Embeds](#embeds)

## Internal Links

Obsidian supports two formats:

| Format | Syntax |
|--------|--------|
| Wikilink (default) | `[[Note Name]]` |
| Markdown | `[Note Name](Note%20Name.md)` |

### Link to Headings

```
[[Note#Heading]]
[[Note#Heading#Subheading]]
[[#Heading in same note]]
```

Search headers across vault: `[[## search term]]`

### Link to Blocks

```
[[Note#^block-id]]
```

Add block IDs to content:

```
Paragraph text. ^my-block-id
```

For structured blocks (lists, quotes, tables), place ID on separate line with blank lines around it:

```
> A blockquote.

^quote-id

```

For list items, place directly on the bullet:

```
- List item ^item-id
```

Block IDs: Latin letters, numbers, dashes only. Search blocks across vault: `[[^^search]]`

### Display Text

| Format | Syntax |
|--------|--------|
| Wikilink | `[[Note\|Custom display]]` |
| Markdown | `[Custom display](Note.md)` |

Heading links: `[[Note#Heading\|Display text]]`

### File Links

Link to non-markdown files requires extension: `[[Figure 1.png]]`

## External Links

```
[Link text](https://example.com)
```

### Escape Spaces in URLs

```
[Note](obsidian://open?vault=Main&file=My%20Note.md)
```

Or use angle brackets:

```
[Note](<obsidian://open?vault=Main&file=My Note.md>)
```

## Embeds

Prefix internal link with `!` to embed content inline.

### Notes

```
![[Note Name]]
![[Note Name#Heading]]
![[Note Name#^block-id]]
```

### Images

```
![[image.jpg]]
![[image.jpg|640x480]]
![[image.jpg|100]]
```

Width-only scales proportionally. External images:

```
![Alt text|100](https://example.com/image.jpg)
```

### Audio

```
![[recording.ogg]]
```

### PDF

```
![[document.pdf]]
![[document.pdf#page=3]]
![[document.pdf#height=400]]
```

### Lists

Add block ID to list, then embed:

```
![[Note#^my-list-id]]
```

### Search Results

Embed live search results with a `query` code block:

````
```query
tag:#project status:open
```
````
