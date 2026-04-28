---
name: laravel-boost
description: "Comprehensive guide for using all Laravel Boost MCP tools effectively. Activate this skill whenever interacting with the Laravel application through Boost MCP tools — including debugging errors (backend or frontend), inspecting database schema or data, exploring routes, checking configuration or environment variables, searching Laravel ecosystem documentation, resolving URLs, running PHP in app context with tinker, or gathering application context at conversation start. Also activate when the user mentions Boost, MCP tools, database inspection, log reading, route listing, config checking, doc searching, or wants to understand the app structure. Even if the user doesn't mention Boost explicitly, use this skill when any Boost MCP tool would be the best approach — for instance, when debugging, exploring the database, or looking up Laravel docs."
license: MIT
metadata:
  author: laravel
---

# Laravel Boost MCP Tools

Laravel Boost is an MCP server that provides direct access to your Laravel application's internals — database, logs, config, routes, docs, and more — without leaving the editor. This skill teaches you when and how to use each tool, and how to chain them for common workflows.

Boost tools are read-only and safe to call at any time. Prefer them over manual alternatives (shell commands, file reads, web searches) because they're faster, return structured data, and are version-aware.

## Tool Inventory

### Context & Discovery

| Tool | Purpose | When to use |
|------|---------|-------------|
| `application-info` | PHP/Laravel version, installed packages, Eloquent models | Start of every conversation, before writing version-specific code |
| `database-connections` | List configured DB connection names | Before querying a non-default database |
| `database-schema` | Table structure (columns, indexes, FKs) | Before writing migrations, models, queries, or seeders |
| `list-artisan-commands` | Available artisan commands | When discovering what the app can do, or checking if a command exists |
| `list-routes` | Application routes (name, method, URI, controller) | When building links, debugging 404s, or understanding app structure |

### Configuration & Environment

| Tool | Purpose | When to use |
|------|---------|-------------|
| `get-config` | Read a config value by key | When you need a specific config value (e.g., `app.name`, `database.default`) |
| `list-available-config-keys` | List all config keys | When you don't know the exact key name |
| `list-available-env-vars` | List all environment variables | When checking what env vars are set or diagnosing env-related issues |

### Documentation

| Tool | Purpose | When to use |
|------|---------|-------------|
| `search-docs` | Version-specific Laravel ecosystem docs | Before making any code change — this is the most important tool to use proactively |

### Database Querying

| Tool | Purpose | When to use |
|------|---------|-------------|
| `database-query` | Execute read-only SQL (SELECT, SHOW, EXPLAIN, DESCRIBE) | When you need actual data to understand the app state, debug issues, or verify queries |

### Debugging

| Tool | Purpose | When to use |
|------|---------|-------------|
| `last-error` | Last backend error/exception | First stop when debugging a server-side issue |
| `read-log-entries` | Application log entries (PSR-3/JSON) | When `last-error` isn't enough, or to see a history of recent issues |
| `browser-logs` | Browser/JS console log entries | When debugging frontend issues, JavaScript errors, or Livewire/Alpine problems |

### Utilities

| Tool | Purpose | When to use |
|------|---------|-------------|
| `get-absolute-url` | Resolve absolute URL from path or named route | Before sharing any URL with the user — always resolve it first |
| `tinker` | Execute PHP code in the application context | For quick PHP evaluation, testing code snippets, or calling app-specific methods |

## Workflow Patterns

These are the recommended tool-chaining sequences for common tasks. Following these patterns avoids wasted effort and ensures you gather the right context before acting.

### 1. New Conversation Startup

Every conversation benefits from establishing context. This takes seconds and prevents writing incompatible code.

```
application-info → database-schema(summary: true)
```

`application-info` gives you PHP version, Laravel version, all installed packages with versions, and the list of Eloquent models. Use this data to write version-compatible code — for example, knowing whether Livewire v3 or v4 is installed changes the component syntax significantly.

Follow with `database-schema(summary: true)` to get a quick overview of all tables and column types. This two-step sequence gives you enough context to answer most questions confidently.

### 2. Debug a Backend Error

When the user reports something isn't working on the server side:

```
last-error → read-log-entries(entries: 5) → database-query (if data-related)
```

Start with `last-error` — it returns the most recent exception with stack trace. If that's not enough context, pull the last few log entries with `read-log-entries` to see what happened leading up to the error. If the error is data-related (e.g., "user not found", constraint violations), follow up with `database-query` to inspect the actual data.

### 3. Debug a Frontend Error

When the user reports a JavaScript, Livewire, or Alpine.js issue:

```
browser-logs(entries: 10) → last-error (check if backend too)
```

`browser-logs` captures console errors, warnings, and Livewire communication failures. Often frontend issues have a backend component (e.g., a failed Livewire action), so check `last-error` as well.

### 4. Understand the Database

When you need to work with the database (write migrations, queries, models):

```
database-connections → database-schema(summary: true) → database-schema(filter: "specific_table")
```

Start with `database-connections` if the app might use multiple databases. Then get the summary view for a high-level understanding, and finally zoom into specific tables with `filter` to see full column details, indexes, and foreign keys. Add `include_column_details: true` when you need nullable, default values, or comments.

### 5. Before Making Code Changes

This is non-negotiable — always search docs before writing code that uses Laravel ecosystem packages:

```
search-docs(queries: [...], packages: [...])
```

The docs returned are version-specific to the installed packages, so you get accurate API signatures and patterns. Use multiple broad queries rather than one narrow query. See the "search-docs Mastery" section below for query techniques.

### 6. Explore Application Structure

When understanding what the app does and how it's organized:

```
list-routes → list-artisan-commands → application-info
```

`list-routes` shows all registered routes with their HTTP methods, URIs, names, and controller actions — this is the fastest way to understand the app's surface area. Combine with `list-artisan-commands` to see custom commands, and `application-info` for the package landscape.

### 7. Check Configuration

When diagnosing config-related issues or checking how the app is set up:

```
list-available-config-keys → get-config(key) → list-available-env-vars
```

If you know the key, go straight to `get-config`. If you're exploring, start with `list-available-config-keys` to find the right key. Use `list-available-env-vars` for environment-level settings (database credentials, API keys, feature flags).

### 8. Share a URL with the User

Before giving the user any URL, resolve it first — the app might be running on a non-standard port, behind a proxy, or using HTTPS:

```
get-absolute-url(path: "/dashboard") or get-absolute-url(route: "home")
```

Never hardcode `http://localhost` — always use this tool to get the correct scheme, domain, and port.

### 9. Quick PHP Execution

When you need to test a code snippet, call an app method, or check a value in the application context:

```
tinker
```

Prefer `database-query` over `tinker` for pure SQL — it's faster and safer. Use `tinker` when you need PHP logic, Eloquent methods, or access to application services. Always use single quotes for the outer shell to prevent variable expansion.

## search-docs Mastery

`search-docs` is the most impactful tool — it returns version-specific documentation tailored to the installed packages. Using it well means getting the right answer on the first try.

### Query Syntax

- **Words** use AND logic: `rate limit` finds docs containing both "rate" AND "limit"
- **Quoted phrases** require exact position: `"infinite scroll"` matches those words adjacent and in order
- **Combine both**: `middleware "rate limit"` requires "middleware" AND the phrase "rate limit"
- **Multiple queries** act as OR: `queries: ["authentication", "authorization"]` returns results matching either

### Best Practices

- Use multiple broad queries instead of one narrow one: `["routing", "route middleware", "rate limiting"]`
- Scope with `packages` when you know which package you need: `packages: ["livewire/livewire", "laravel/framework"]`
- Don't include package names in the query text — package info is shared automatically. Use `"toggle switch"`, not `"livewire toggle switch"`
- Increase `token_limit` (default 3,000) when you need more complete documentation, e.g., `token_limit: 10000` for complex topics
- Search before every code change — the API surface changes between versions and assumptions from training data may be outdated

### Examples

**Looking up Livewire form validation:**
```
queries: ["form validation", "real-time validation", "validate"]
packages: ["livewire/livewire"]
```

**Understanding Pest testing features:**
```
queries: ["datasets", "test expectations", "higher order testing"]
packages: ["pestphp/pest"]
```

**Exploring Laravel Fortify 2FA:**
```
queries: ["two factor authentication", "2FA setup", "recovery codes"]
packages: ["laravel/fortify"]
```

## Tool Selection Guide

When multiple tools could accomplish the same thing, prefer the Boost tool:

| Task | Prefer | Over | Why |
|------|--------|------|-----|
| Read data from DB | `database-query` | `tinker` with Eloquent | Faster, read-only safe, structured output |
| Check table structure | `database-schema` | `php artisan migrate:status` or reading migration files | Shows the actual current schema, not migration history |
| Look up Laravel API | `search-docs` | Web search or reading vendor source | Version-specific, curated, faster |
| Get config value | `get-config` | `php artisan config:show` | Structured output, no shell needed |
| Check last exception | `last-error` | Reading `storage/logs/laravel.log` | Parsed, formatted, immediate |
| See app routes | `list-routes` | `php artisan route:list` | Structured output, no shell needed |
| Resolve a URL | `get-absolute-url` | Hardcoding localhost | Handles scheme, domain, port correctly |
| Check env vars | `list-available-env-vars` | Reading `.env` file | Includes all resolved vars, not just `.env` file |

## Anti-Patterns

These are common mistakes that waste time or produce wrong results:

**Skipping `application-info` at conversation start** — Without knowing the installed packages and their versions, you risk writing code for the wrong API version. Livewire 3 vs 4, Pest 2 vs 3, Flux v1 vs v2 — these have significant API differences.

**Skipping `search-docs` before code changes** — Training data may be outdated. The docs tool returns version-specific content for what's actually installed. A 10-second search prevents a 10-minute debugging session.

**Using `tinker` for pure SQL queries** — `database-query` is purpose-built for read-only SQL. It's faster, returns structured JSON, and can't accidentally mutate data. Use `tinker` only when you need PHP/Eloquent logic.

**Hardcoding URLs** — The app might run on any port, domain, or scheme. Always use `get-absolute-url` before sharing a URL with the user.

**Reading migration files to understand the schema** — Migrations show intent, not current state. Tables may have been modified outside of migrations. Use `database-schema` for the truth.

**Reading log files manually** — `last-error` and `read-log-entries` parse multi-line PSR-3 and JSON log formats correctly. Reading the raw file often gives you a jumbled mess.

**Querying `database-schema` without `summary: true` first** — On large databases, the full schema dump is massive. Start with summary mode to see all tables at a glance, then use `filter` to zoom into specific tables.

## Detailed Tool Reference

For complete parameter documentation, accepted values, and advanced usage patterns for each tool, read `references/tool-reference.md`.
