---
name: obsidian-notes
description: Write and format notes as Obsidian-optimized Markdown (.md) files. Use when creating, editing, or formatting notes intended for Obsidian vaults. Covers all Obsidian Flavored Markdown features including properties (YAML frontmatter), wikilinks, embeds, callouts, math, Mermaid diagrams, and all standard formatting. Triggers on requests to create notes, knowledge base entries, documentation, journals, or any .md content for Obsidian.
---

# Obsidian Notes

Write Markdown notes optimized for Obsidian's rendering engine and features.

## Note Structure

Every note follows this structure:

```
---
properties (YAML frontmatter)
---

# Note Title

Content with Obsidian-flavored Markdown
```

1. **Properties** — Add YAML frontmatter when the note needs metadata (tags, aliases, dates, etc.). See [references/properties.md](references/properties.md) for types and format.
2. **Title** — Single `# Heading 1` as the note title.
3. **Content** — Use appropriate formatting from the references below.

## Core Rules

- Prefer wikilinks `[[Note Name]]` over markdown links for internal references
- Use `==highlight==` for emphasis beyond bold/italic
- Use `%%comments%%` for editor-only annotations
- Use callouts (`> [!type]`) instead of plain blockquotes for structured information — see [references/callouts.md](references/callouts.md) for all types
- **ALWAYS use the MermaidJS MCP tool (`mcp_mcp-mermaid_generate_mermaid_diagram`) to generate Mermaid diagrams.** Never write Mermaid code manually. Wrap the generated output in a ` ```mermaid ` code block.
- Use `$...$` for inline math and `$$...$$` for block math (MathJax/LaTeX)
- Use `#tags` inline or in frontmatter `tags` property — not both redundantly

## Formatting Quick Reference

| Feature | Syntax |
|---------|--------|
| Bold | `**text**` |
| Italic | `*text*` |
| Highlight | `==text==` |
| Strikethrough | `~~text~~` |
| Wikilink | `[[Note]]` or `[[Note\|Display]]` |
| Embed | `![[Note]]` or `![[image.jpg]]` |
| Heading link | `[[Note#Heading]]` |
| Block link | `[[Note#^block-id]]` |
| Task | `- [ ] task` / `- [x] done` |
| Callout | `> [!type] Title` |
| Footnote | `text[^1]` + `[^1]: content` |
| Comment | `%%hidden text%%` |
| Inline math | `$e^{i\pi}+1=0$` |
| Block math | `$$\sum_{n=1}^{\infty}$$` |
| Image size | `![[img.png\|300]]` or `![[img.png\|640x480]]` |

## Detailed References

- **Full syntax** (formatting, tables, code, math, diagrams, escaping): [references/syntax.md](references/syntax.md)
- **Links and embeds** (wikilinks, headings, blocks, images, PDFs, audio): [references/links-and-embeds.md](references/links-and-embeds.md)
- **Callouts** (all types, foldable, nested): [references/callouts.md](references/callouts.md)
- **Properties** (YAML frontmatter types, defaults, format): [references/properties.md](references/properties.md)

Load the relevant reference when working with specific features.

## Properties Guidelines

Add frontmatter when notes need:
- **Tags** for categorization: `tags: [topic, status]`
- **Aliases** for alternate link names: `aliases: [short name]`
- **Dates** for temporal context: `date: 2024-01-15`
- **Custom metadata** for workflows: `status: draft`, `project: x`

```yaml
---
tags:
  - project
  - meeting
aliases:
  - standup
date: 2024-01-15
---
```

Wrap internal links in property values with quotes: `related: "[[Other Note]]"`

## Callout Selection Guide

Choose the right callout type for the content purpose:

| Purpose | Type |
|---------|------|
| General note | `[!note]` |
| Summary / TL;DR | `[!abstract]` or `[!tldr]` |
| Helpful advice | `[!tip]` |
| Warning | `[!warning]` |
| Important info | `[!info]` |
| Example | `[!example]` |
| Question / FAQ | `[!question]` |
| Error / danger | `[!danger]` |
| Citation | `[!quote]` |

Use `-` for collapsed and `+` for expanded foldable callouts:

```
> [!faq]- Frequently Asked Question
> Answer hidden by default.
```
