# Symbol Documentation Template

Use this template when documenting a function, method, or class. Adapt sections as needed — omit sections that don't apply (e.g., "Properties" for a function, "Parameters" for a class with no constructor args).

**Important:** Write all documentation in the same language used in the codebase (detected from variable names, comments, and string literals).

---

## Folder Structure

For complex symbols, create a folder `docs/{symbol-name}/` with separate files:

```
docs/{symbol-name}/
├── index.md              ← Signature, purpose, parameters, return value + wiki-links
├── internal-flow.md      ← Mermaid flowchart + prose walkthrough
├── dependencies.md       ← Dependency table + usage examples from codebase
├── error-handling.md     ← Error conditions, exceptions, side effects
└── glossary.md           ← Key terms, types, domain concepts
```

For simple symbols (pure functions, small utilities), a single file with all sections is acceptable.

---

## File Templates

### `index.md`

```markdown
---
tags:
  - documentation
  - symbol
type: symbol
symbol-type: function  # or method, class
file: "path/to/file.ext"
---

# `SymbolName`

> [!info] Definition
> **File:** [path/to/file.ext](path/to/file.ext#L10-L50)
> **Type:** Function | Method | Class
> **Visibility:** public | protected | private | exported

## Purpose

[One paragraph: what this symbol does, why it exists, and what business or technical problem it solves. Assume the reader has zero prior knowledge of the domain — explain the context.]

## Signature

\`\`\`language
function symbolName(param1: Type, param2: Type): ReturnType
\`\`\`

## Parameters

| Name | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `param1` | `Type` | Yes | — | Description of parameter |
| `param2` | `Type` | No | `defaultVal` | Description of parameter |

## Return Value

| Type | Description |
|------|-------------|
| `ReturnType` | What the return value represents and its possible states |

## Properties (Classes only)

| Name | Type | Visibility | Description |
|------|------|------------|-------------|
| `prop1` | `Type` | public | Description |

## Methods (Classes only)

| Name | Signature | Visibility | Description |
|------|-----------|------------|-------------|
| `method1` | `method1(arg: T): R` | public | Brief description |

## Sections

- [[internal-flow]]
- [[dependencies]]
- [[error-handling]]
- [[glossary]]
```

---

### `internal-flow.md`

```markdown
# Internal Flow

\`\`\`mermaid
flowchart TD
    A[Entry] --> B{Validation}
    B -->|Pass| C[Core Logic]
    B -->|Fail| D[Error]
    C --> E[Return]
\`\`\`

[Walk through the flowchart in prose, explaining each decision point and significant operation. Explain the *why* behind each branch — not just the *what*.]
```

---

### `dependencies.md`

```markdown
# Dependencies & Usage

## Dependencies

| Symbol | File | Purpose |
|--------|------|---------|
| `DependencyName` | [path/to/dep.ext](path/to/dep.ext#L20) | What it provides to this symbol |

## Usage Examples

Real call sites found in the codebase:

**From [CallerFile](path/to/caller.ext#L30-L35):**
\`\`\`language
// Relevant code excerpt showing how this symbol is called
\`\`\`

## Related Symbols

- [`RelatedSymbol`](path/to/related.ext#L10) — How it relates
```

---

### `error-handling.md`

```markdown
# Error Handling & Side Effects

## Error Conditions

| Condition | Error/Exception | Behavior |
|-----------|----------------|----------|
| Invalid input | `ValidationException` | Returns 422 / throws |
| Not found | `NotFoundException` | Returns null / throws |

> [!danger] Critical Failures
> [Describe any conditions that could cause data loss, corruption, or unrecoverable errors. Remove this callout if none exist.]

## Side Effects

- **Database:** [Reads/writes to `table_name`]
- **Events:** [Dispatches `EventName`]
- **External:** [Calls `ExternalService`]
- **I/O:** [File/network operations]
```

---

### `glossary.md`

```markdown
# Glossary

| Term | Definition | Context |
|------|-----------|---------|
| [Term 1] | [Plain-language definition] | [Where it appears: class, table, parameter, etc.] |
| [Term 2] | [Definition] | [Context] |

[Include every domain-specific term, type alias, abbreviation, and technical concept used in the symbol's documentation. The reader may have zero prior knowledge of the domain.]
```

---

## Guidelines

- **Investigate before writing** — Read source code for every section. Do not guess.
- **Include code excerpts** — For complex logic, include the relevant lines from the source (not the entire file).
- **Mermaid via MCP** — Use the Mermaid MCP tool to generate and validate diagrams. Embed the Mermaid syntax as text in the corresponding `.md` file.
- **Obsidian formatting** — Follow the `obsidian-notes` skill conventions: add YAML frontmatter to every file, use callouts (`> [!type]`) for structured info blocks, use `==highlights==` for key terms on first mention, use `[[wikilinks]]` for cross-references between doc files, and use `%%comments%%` for internal annotations.
- **Link everything** — File paths must be Markdown links with line numbers.
- **Wiki-links between files** — In `index.md`, reference section files with `[[filename]]` syntax.
- **Glossary is mandatory** — Every symbol documentation must include a `glossary.md` defining key terms.
- **Omit empty sections** — If a symbol has no side effects, remove that section entirely.
- **Language** — Write in the same language used in the codebase.
- **Audience** — Assume the reader is an engineer with zero prior knowledge of this symbol's domain. Explain business context and purpose, not just mechanics.
