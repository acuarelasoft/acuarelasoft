# Process Documentation Template

Use this template when documenting a high-level business process or workflow that spans multiple files, classes, and services.

**Important:** Write all documentation in the same language used in the codebase (detected from variable names, comments, and string literals).

---

## Folder Structure

Create a folder `docs/{process-name}/` with the following files:

```
docs/{process-name}/
├── index.md
├── sequence-diagram.md
├── step-breakdown.md
├── data-flow.md
├── models-database.md
├── events-side-effects.md
├── error-handling.md
├── dependency-graph.md
├── glossary.md
└── [symbol-name].md          ← one per significant symbol (optional)
```

---

## File Templates

### `index.md`

```markdown
---
tags:
  - documentation
  - process
type: process
entrypoint: "path/to/entrypoint.ext"
---

# Process: [Process Name]

> [!info] Entrypoint
> **File:** [path/to/entrypoint.ext](path/to/entrypoint.ext#L10) — `ClassName::methodName`
> **Trigger:** [What initiates this process: HTTP request, CLI command, scheduled job, event, etc.]

## Overview

[2-3 paragraphs describing:
- What this process accomplishes from a business perspective (assume the reader has zero prior knowledge)
- When and why it is triggered
- The high-level outcome when successful
- Who/what consumes the result]

## Sections

- [[sequence-diagram]]
- [[step-breakdown]]
- [[data-flow]]
- [[models-database]]
- [[events-side-effects]]
- [[error-handling]]
- [[dependency-graph]]
- [[glossary]]

[If individual symbol docs were created:]
- [[symbol-name-1]]
- [[symbol-name-2]]
```

---

### `sequence-diagram.md`

```markdown
# Sequence Diagram

## Component Interaction

\`\`\`mermaid
sequenceDiagram
    participant Client
    participant Controller
    participant Service
    participant Model
    participant EventBus

    Client->>Controller: HTTP POST /resource
    Controller->>Service: processAction(data)
    Service->>Model: validate & persist
    Model-->>Service: result
    Service->>EventBus: dispatch Event
    Service-->>Controller: response DTO
    Controller-->>Client: 201 Created
\`\`\`

[Prose explanation of the sequence: describe each interaction and why it happens.]

## Process Flow

\`\`\`mermaid
flowchart TD
    A[Entrypoint: Controller::action] --> B[Validate Request]
    B --> C{Valid?}
    C -->|No| D[Return Error Response]
    C -->|Yes| E[Service::execute]
    E --> F[Step 1: Description]
    F --> G[Step 2: Description]
    G --> H{Decision Point}
    H -->|Path A| I[Step 3a]
    H -->|Path B| J[Step 3b]
    I --> K[Persist Result]
    J --> K
    K --> L[Dispatch Events]
    L --> M[Return Response]
\`\`\`

[Prose explanation of the flow: describe each decision point and what determines the path taken.]
```

---

### `step-breakdown.md`

```markdown
# Step-by-Step Breakdown

## Step 1: [Step Name]

> **Executed by:** [`ClassName::method`](path/to/file.ext#L20-L45)

**What it does:** [Description of the business logic — explain the *why*, not just the *what*.]

**Inputs:**
| Name | Type | Source | Description |
|------|------|--------|-------------|
| `input1` | `Type` | Request body | Description |

**Outputs:**
| Name | Type | Description |
|------|------|-------------|
| `output1` | `Type` | Description |

**Database Operations:**
- READ `table_name` — [Why this data is needed]
- WRITE `table_name` — [What fields are written, under what conditions]

**Key Logic:**
\`\`\`language
// Relevant code excerpt illustrating the core logic of this step
\`\`\`

**Business Context:** [Explain why this step exists from a business perspective. What would break if it were removed?]

> [!warning] Edge Cases
> [Note any edge cases, special conditions, or gotchas for this step. Remove this callout if none exist.]

---

## Step 2: [Step Name]

> **Executed by:** [`ClassName::method`](path/to/file.ext#L50-L80)

[Same structure as Step 1]
```

---

### `data-flow.md`

```markdown
# Data Flow

## Input → Output Transformations

[Describe what data enters the process, how it transforms at each stage, and what exits.]

| Stage | Input | Transformation | Output |
|-------|-------|---------------|--------|
| Validation | Raw request data | Schema validation, type casting | Validated DTO |
| Processing | Validated DTO | Business logic applied | Domain entity |
| Persistence | Domain entity | ORM mapping | Database record |
| Response | Database record | Serialization | API response |
```

---

### `models-database.md`

```markdown
# Models & Database

| Model | Table | Role in Process |
|-------|-------|-----------------|
| [`ModelName`](path/to/model.ext) | `table_name` | What role this model plays |

## Relationships

\`\`\`mermaid
erDiagram
    MODEL_A ||--o{ MODEL_B : "has many"
    MODEL_B }o--|| MODEL_C : "belongs to"
\`\`\`

## Relevant Columns

### `table_name`

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint | Primary key |
| `status` | enum | Possible values: draft, active, archived |
```

---

### `events-side-effects.md`

```markdown
# Events & Side Effects

| Event / Job | Dispatched By | Listener / Handler | Effect |
|-------------|--------------|-------------------|--------|
| `EventName` | [`Service::method`](path/to/file.ext#L75) | [`ListenerClass`](path/to/listener.ext) | What happens |
| `QueuedJob` | [`Service::method`](path/to/file.ext#L78) | — | What the job does |

## Detail

### `EventName`

[Describe when this event fires, what data it carries, and what downstream effects it triggers.]
```

---

### `error-handling.md`

```markdown
# Error Handling & Edge Cases

| Scenario | Where | Behavior | Recovery |
|----------|-------|----------|----------|
| Invalid input | Validation step | Returns 422 | User corrects input |
| Duplicate entry | DB insert | Throws exception | Caught, returns conflict error |
| External service down | API call | Retry 3x, then fail | Queued for retry |

## Detail

### [Scenario Name]

[Describe the error path in detail: what triggers it, what exception is thrown, how it's caught, what the user/system sees, and how to recover.]
```

---

### `dependency-graph.md`

```markdown
# Dependency Graph

\`\`\`mermaid
flowchart TD
    A[Entrypoint] --> B[ServiceA]
    A --> C[ServiceB]
    B --> D[ModelX]
    B --> E[HelperUtil]
    C --> F[ModelY]
    C --> G[ExternalAPI]
    B --> H[Event: Created]
    H --> I[Listener1]
    H --> J[Listener2]
\`\`\`

[Prose explanation of the dependency graph: describe the role of each component and why the dependencies exist.]
```

---

### `glossary.md`

```markdown
# Glossary

| Term | Definition | Context |
|------|-----------|---------|
| [Term 1] | [Plain-language definition of this concept] | [Where/how it appears in the codebase: class name, table, config key, etc.] |
| [Term 2] | [Definition] | [Context] |

[Include every domain-specific term, abbreviation, business concept, model name, and technical term used in the documentation. The reader may have zero prior knowledge of the domain.]
```

---

## Guidelines

- **Start from the entrypoint** — Always begin tracing from the route/controller/command that initiates the process.
- **Follow every call** — Read the source of every method called in the chain. Do not skip or assume.
- **Document all DB operations** — Every query, insert, update, delete must be captured.
- **Capture all events** — Every dispatched event, queued job, and notification must be listed.
- **Include real code** — Use actual code excerpts from the codebase, not pseudocode.
- **Mermaid via MCP** — Use the Mermaid MCP tool to generate and validate all diagrams. Embed the Mermaid syntax as text in the corresponding section file.
- **Obsidian formatting** — Follow the `obsidian-notes` skill conventions: add YAML frontmatter to every file, use callouts (`> [!type]`) for structured info blocks, use `==highlights==` for key terms on first mention, use `[[wikilinks]]` for cross-references between doc files, and use `%%comments%%` for internal annotations.
- **Link everything** — All file references must be Markdown links with line numbers.
- **Wiki-links between files** — In `index.md`, reference section files with `[[filename]]` syntax.
- **Glossary is mandatory** — Every process documentation must include a `glossary.md`.
- **Language** — Write in the same language used in the codebase.
- **Audience** — Assume the reader is an engineer with zero prior knowledge of this process. Explain business context, define terms, and describe the purpose behind each step.
