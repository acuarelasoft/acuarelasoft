# Laravel Boost MCP — Tool Reference

Complete parameter documentation for all 15 Laravel Boost MCP tools. Each tool is prefixed with `mcp_laravel-boost_` when called.

## Table of Contents

1. [application-info](#application-info)
2. [database-connections](#database-connections)
3. [database-schema](#database-schema)
4. [list-artisan-commands](#list-artisan-commands)
5. [list-routes](#list-routes)
6. [get-config](#get-config)
7. [list-available-config-keys](#list-available-config-keys)
8. [list-available-env-vars](#list-available-env-vars)
9. [search-docs](#search-docs)
10. [database-query](#database-query)
11. [last-error](#last-error)
12. [read-log-entries](#read-log-entries)
13. [browser-logs](#browser-logs)
14. [get-absolute-url](#get-absolute-url)
15. [tinker](#tinker)

---

## application-info

Get comprehensive application information including PHP version, Laravel version, database engine, all installed packages with their versions, and all Eloquent models.

**Parameters:** None

**Returns:** JSON with:
- `php_version` — e.g., `"8.4.0"`
- `laravel_version` — e.g., `"13.0.0"`
- `database_engine` — e.g., `"mysql"`, `"pgsql"`, `"sqlite"`
- `packages` — Array of `{name, version}` for all composer packages
- `models` — Array of Eloquent model class names

**Usage pattern:** Call at the start of every new conversation. Use the package versions to write compatible code.

```
application-info → check versions → write version-specific code
```

**Example output context:**
- If `livewire/livewire` shows `v4.x`, use Livewire 4 syntax (SFC, islands)
- If `pestphp/pest` shows `v4.x`, use Pest 4 features (arch testing, type coverage)
- If `laravel/framework` shows `v13.x`, use Laravel 13 patterns

---

## database-connections

List the configured database connection names for the application.

**Parameters:** None

**Returns:** JSON with:
- `default_connection` — The default connection name (e.g., `"mysql"`)
- `connections` — Array of all configured connection names

**When to use:** Before querying a non-default database. Most apps use a single connection, but multi-tenant or analytics setups may have several.

---

## database-schema

Read the database schema with progressive detail levels.

**Parameters:**

| Param | Type | Default | Description |
|-------|------|---------|-------------|
| `summary` | boolean | `false` | Return only table names and column types (quick overview) |
| `database` | string | default connection | Database connection name |
| `filter` | string | — | Filter tables by name (substring match) |
| `include_column_details` | boolean | `false` | Add nullable, default, auto_increment, comments |
| `include_views` | boolean | `false` | Include database views |
| `include_routines` | boolean | `false` | Include stored procedures, functions, sequences |

**Progressive usage pattern:**

```
Step 1: database-schema(summary: true)
        → See all tables with column names and types

Step 2: database-schema(filter: "users")
        → Full details for the users table (columns, indexes, FKs)

Step 3: database-schema(filter: "users", include_column_details: true)
        → Add nullable, defaults, auto_increment, comments
```

**Caching:** Results are cached for 20 seconds, so repeated calls with the same params are fast.

**Examples:**

Get all tables overview:
```json
{"summary": true}
```

Get specific table with full details:
```json
{"filter": "properties", "include_column_details": true}
```

Get everything including views and procedures:
```json
{"filter": "users", "include_views": true, "include_routines": true, "include_column_details": true}
```

---

## list-artisan-commands

List all available artisan commands in the application.

**Parameters:** None (or may accept filter options)

**Returns:** List of artisan command names and descriptions.

**When to use:** To discover custom commands, check if a specific command exists, or understand the app's CLI surface area. Faster than running `php artisan list` in terminal.

---

## list-routes

List all registered application routes.

**Parameters:** None (or may accept filter options)

**Returns:** Route information including HTTP method, URI, name, controller/action, and middleware.

**When to use:**
- Building navigation or links (find route names for `route()` helper)
- Debugging 404 errors (is the route registered?)
- Understanding app structure (what endpoints exist?)
- Checking middleware assignments

---

## get-config

Read a Laravel configuration value by key.

**Parameters:**

| Param | Type | Required | Description |
|-------|------|----------|-------------|
| `key` | string | yes | Config key in dot notation (e.g., `app.name`, `database.default`) |

**Returns:** The configuration value.

**Usage examples:**
```json
{"key": "app.name"}
{"key": "database.default"}
{"key": "mail.mailers.smtp.host"}
{"key": "session.driver"}
```

**Tip:** If you don't know the exact key, use `list-available-config-keys` first to browse available keys.

---

## list-available-config-keys

List all available configuration keys in the application.

**Parameters:** None

**Returns:** List of all config keys in dot notation.

**When to use:** When you need to find a config key but aren't sure of the exact path. Browse the output, then use `get-config` with the right key.

**Workflow:**
```
list-available-config-keys → find the key → get-config(key)
```

---

## list-available-env-vars

List all environment variables available to the application.

**Parameters:** None

**Returns:** List of environment variable names and their values.

**When to use:**
- Diagnosing environment-related issues
- Checking if an env var is set
- Understanding the runtime configuration
- Comparing env vars vs config values

**Note:** This shows all resolved environment variables, not just what's in the `.env` file. It includes system-level vars and computed values.

---

## search-docs

Search version-specific documentation for Laravel ecosystem packages.

**Parameters:**

| Param | Type | Required | Description |
|-------|------|----------|-------------|
| `queries` | array of strings | yes | Search queries (multiple queries act as OR) |
| `packages` | array of strings | no | Limit to specific packages (e.g., `["laravel/framework", "livewire/livewire"]`) |
| `token_limit` | integer | no | Max tokens in response (default: 3,000; max: 1,000,000) |

**Search syntax:**

| Syntax | Behavior | Example |
|--------|----------|---------|
| Words | AND logic (auto-stemmed) | `rate limit` → both words required |
| `"quoted"` | Exact phrase match | `"infinite scroll"` → adjacent, in order |
| Combined | Words + phrases | `middleware "rate limit"` |
| Multiple queries | OR logic | `["auth", "middleware"]` → matches either |

**Best practices:**
- Use broad, topic-based queries: `["routing", "route middleware", "rate limiting"]`
- Scope with `packages` to reduce noise: `packages: ["livewire/livewire"]`
- Don't put package names in query text — package context is automatic
- Increase `token_limit` for complex topics: `token_limit: 10000`
- Search before every code change — APIs change between versions

**Examples:**

Livewire form validation:
```json
{
  "queries": ["form validation", "real-time validation", "validate"],
  "packages": ["livewire/livewire"]
}
```

Laravel database query builder:
```json
{
  "queries": ["query builder", "where clauses", "joins"],
  "packages": ["laravel/framework"],
  "token_limit": 8000
}
```

Pest testing datasets:
```json
{
  "queries": ["datasets", "data providers", "parameterized tests"],
  "packages": ["pestphp/pest"]
}
```

---

## database-query

Execute a read-only SQL query against the configured database.

**Parameters:**

| Param | Type | Required | Description |
|-------|------|----------|-------------|
| `query` | string | yes | SQL query (read-only only) |
| `database` | string | no | Database connection name (defaults to app's default) |

**Allowed SQL commands:** SELECT, SHOW, EXPLAIN, DESCRIBE, DESC, WITH...SELECT, TABLE, VALUES

**Blocked:** INSERT, UPDATE, DELETE, ALTER, DROP, CREATE, TRUNCATE, and any other write operations.

**Examples:**

Count users:
```json
{"query": "SELECT COUNT(*) as total FROM users"}
```

Check recent records:
```json
{"query": "SELECT * FROM properties ORDER BY created_at DESC LIMIT 5"}
```

Explain a query:
```json
{"query": "EXPLAIN SELECT * FROM users WHERE email = 'test@example.com'"}
```

Show table info:
```json
{"query": "SHOW CREATE TABLE properties"}
```

Use a specific database connection:
```json
{"query": "SELECT * FROM analytics", "database": "analytics"}
```

**Note:** Table prefixes are handled automatically. Returns JSON array of result rows.

---

## last-error

Get details of the last error/exception on the backend.

**Parameters:** None

**Returns:** Text containing the error entry with timestamp, level, and message. Truncated to ~500 characters if very long.

**When to use:** First stop when debugging any server-side issue. Returns the most recent exception with context.

**Workflow:**
```
last-error → understand the exception → read-log-entries (for more history) → fix
```

**Note:** For browser/JavaScript errors, use `browser-logs` instead. `last-error` captures backend exceptions registered through Laravel's error logging pipeline.

---

## read-log-entries

Read the last N log entries from the application log.

**Parameters:**

| Param | Type | Required | Description |
|-------|------|----------|-------------|
| `entries` | integer | yes | Number of log entries to return (must be > 0) |

**Returns:** Text containing the last N log entries, properly parsed from PSR-3 or JSON format, separated by double newlines.

**When to use:**
- After `last-error` gives you the exception but you need more context
- To see a sequence of events leading to an error
- To check for warnings or notices before an exception

**Examples:**

Get last 5 log entries:
```json
{"entries": 5}
```

Get more history for complex debugging:
```json
{"entries": 20}
```

**Log location:** Reads from the configured log file (typically `storage/logs/laravel.log`). Handles multi-line entries correctly.

---

## browser-logs

Read the last N log entries from the browser log.

**Parameters:**

| Param | Type | Required | Description |
|-------|------|----------|-------------|
| `entries` | integer | yes | Number of log entries to return (must be > 0) |

**Returns:** Text containing the last N browser log entries, separated by double newlines.

**When to use:**
- JavaScript errors in the console
- Livewire communication failures
- Alpine.js reactivity issues
- Asset loading problems (404s for JS/CSS)
- CORS errors

**Log location:** `storage/logs/browser.log`

**Tip:** Only recent entries are useful — old browser logs are typically stale. Start with `entries: 10`.

---

## get-absolute-url

Get the absolute URL for a given relative path or named route.

**Parameters:**

| Param | Type | Required | Description |
|-------|------|----------|-------------|
| `path` | string | no | Relative URL/path (e.g., `/dashboard`) |
| `route` | string | no | Named route (e.g., `home`, `users.show`) |

At least one parameter should be provided. If both are given, `path` takes precedence. If neither is provided, returns the base URL (`/`).

**Returns:** The absolute URL as text.

**Examples:**

From a path:
```json
{"path": "/dashboard"}
→ "https://habitables.test/dashboard"
```

From a named route:
```json
{"route": "home"}
→ "https://habitables.test"
```

Base URL only:
```json
{}
→ "https://habitables.test"
```

**Important:** Always use this tool before sharing any URL with the user. Never hardcode `http://localhost` or guess the domain.

---

## tinker

Execute PHP code in the application context.

**Parameters:**

| Param | Type | Required | Description |
|-------|------|----------|-------------|
| `code` | string | yes | PHP code to execute |

**Returns:** The output of the executed PHP code.

**When to use:**
- Testing Eloquent queries with model relationships
- Calling application services or helper methods
- Checking computed values or app state
- Quick prototyping before writing permanent code

**When NOT to use:**
- Pure SQL queries → use `database-query` instead (safer, structured)
- Creating or modifying data → prefer tests with factories
- Anything that can be done with a more specific Boost tool

**Shell quoting:** When called via terminal, always wrap in single quotes to prevent shell expansion:
```bash
php artisan tinker --execute 'User::where("active", true)->count();'
```

**Note:** Prefer existing Artisan commands over custom tinker code. Do not create models in tinker without user approval — prefer tests with factories instead.
