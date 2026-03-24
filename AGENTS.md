<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

These guidelines are specifically curated for this Laravel API application. Follow them closely.

## Foundational Context

This is a Laravel API-only application. Its packages & versions are below — be an expert with all of them.

**Runtime**

- php - 8.5
- laravel/framework (LARAVEL) - v13
- laravel/sanctum (SANCTUM) - v4
- laravel/prompts (PROMPTS) - v0
- laravel/mcp (MCP) - v0
- laravel/tinker - v3
- nunomaduro/essentials - v1

**Development**

- laravel/boost (BOOST) - v2
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- larastan/larastan (LARASTAN) - v3
- pestphp/pest (PEST) - v5
- rector/rector (RECTOR) - v2
- driftingly/rector-laravel - v2
- barryvdh/laravel-ide-helper - v3

## Conventions

- Follow all existing code conventions in the application. When creating or editing a file, check sibling files for correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing classes to reuse before writing a new one.

## Application Structure & Architecture

- This is an API-only application. Do not create or suggest views, Blade templates, frontend assets, or anything UI-related.
- Stick to the existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Verification Scripts

- Do not create one-off verification scripts. Write proper tests instead.

## Replies

- Be concise — focus on what matters, skip obvious details.

## Documentation Files

- Only create documentation files if explicitly requested.

=== boost rules ===

# Laravel Boost

- Laravel Boost is an MCP server with powerful tools designed for this application. Use them.

## Artisan Commands

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`).
- Use `php artisan list` to discover commands and `php artisan [command] --help` to check parameters.

## URLs

- Use the `get-absolute-url` tool whenever you share a project URL to ensure the correct scheme, domain/IP, and port.

## Debugging

- Use the `database-query` tool when you only need to read from the database.
- Use the `database-schema` tool to inspect table structure before writing migrations or models.
- Execute PHP for debugging via `php artisan tinker --execute "your code here"`.
- Read config values via config files directly or `php artisan config:show [key]`.
- Inspect routes via `php artisan route:list`.
- Check environment variables by reading `.env` directly.

## Browser Logs

- Use the `browser-logs` tool to read browser logs, errors, and exceptions. Only recent logs are useful.

## Searching Documentation (Critically Important)

- Use the `search-docs` tool before any other approach when working with Laravel or its ecosystem packages. It returns version-specific documentation for this project's exact package versions. Pass an array of packages to filter when you know which packages are relevant.
- Search before making code changes to ensure the correct approach.
- Use multiple broad, simple, topic-based queries at once. For example: `['rate limiting', 'routing rate limiting', 'routing']`.
- Do not include package names in queries — package context is already shared automatically.

### Available Search Syntax

1. Simple Word Searches with auto-stemming — `authentication` finds "authenticate" and "auth".
2. Multiple Words (AND Logic) — `rate limit` finds docs containing both words.
3. Quoted Phrases (Exact) — `"infinite scroll"` — words must be adjacent and in order.
4. Mixed — `middleware "rate limit"` — AND logic with an exact phrase.
5. Multiple Queries — `["authentication", "middleware"]` — matches ANY term.

=== opencode rules ===

## Opencode

- This project uses Opencode as the AI coding assistant.
- Opencode is configured via `opencode.json` at the project root. Follow its configuration for model selection, tools, and behavior.

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.

## Constructors

- Use PHP 8 constructor property promotion in `__construct()`.
    - `public function __construct(public MyService $service) { }`
- Do not allow empty `__construct()` methods with zero parameters unless the constructor is private.

## Type Declarations

- Always use explicit return type declarations for methods and functions.
- Always use appropriate type hints for parameters.

```php
protected function isAccessible(User $user, ?string $path = null): bool
{
    // ...
}
```

## Enums

- Enum keys should be TitleCase. For example: `ActiveStatus`, `Monthly`, `AdminRole`.

## Comments

- Prefer PHPDoc blocks over inline comments. Only use inline comments for genuinely complex logic.

## PHPDoc Blocks

- Add array shape type definitions where appropriate.

=== tests rules ===

## Test Enforcement

- Every change must be covered by a test. Write or update a test, then run it to confirm it passes.
- Run the minimum number of tests needed. Use `php artisan test --compact` with a specific file or filter.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to scaffold new files (migrations, controllers, models, etc.).
- Use `php artisan make:class` for generic PHP classes.
- Pass `--no-interaction` to all Artisan commands.

## API

- All responses must be JSON. Never return views or redirects.
- Always use Eloquent API Resources for structured responses.
- Default to API versioning: `routes/api/v1.php`, `App\Http\Resources\V1\`.
- Return correct HTTP status codes: `200` OK, `201` Created, `204` No Content, `422` Validation Error, `401` Unauthenticated, `403` Forbidden, `404` Not Found.

## Authentication & Authorization

- Use Laravel Sanctum for API authentication (token-based).
- Use Gates and Policies for authorization.

## MCP

- Use `laravel/mcp` to expose application functionality as MCP tools and resources.
- Define MCP tools in dedicated tool classes under `app/MCP/Tools/`.
- Define MCP resources in dedicated resource classes under `app/MCP/Resources/`.
- Use `laravel/prompts` when building interactive Artisan commands that support MCP setup or tooling.

## Database

- Always use Eloquent relationships with proper return type hints.
- Avoid `DB::`; prefer `Model::query()`.
- Prevent N+1 problems with eager loading.
- Use the query builder only for genuinely complex operations.

### Model Creation

- When creating new models, also create factories and seeders.

## Controllers & Validation

- Always create Form Request classes for validation — never validate inline in controllers.
- Include both validation rules and custom error messages in Form Requests.
- Controllers should be thin: delegate logic to actions, services, or jobs.

## Queues

- Use queued jobs with `ShouldQueue` for time-consuming operations.

## Configuration

- Never call `env()` outside of config files. Always use `config('key')`.

## URL Generation

- Use named routes and the `route()` helper for all URL generation.

## Testing

- Use factories when creating models in tests. Check for existing factory states before setting attributes manually.
- Follow existing conventions for Faker: `$this->faker->word()` or `fake()->randomDigit()`.
- Use `php artisan make:test --pest {name}` for feature tests, add `--unit` for unit tests. Most tests should be feature tests.

=== laravel/v13 rules ===

## Laravel 13

### Structure

- Middleware is configured in `bootstrap/app.php` via `Application::configure()->withMiddleware()` — not in a Kernel.
- `bootstrap/providers.php` contains application service providers.
- `app\Console\Kernel.php` does not exist; use `bootstrap/app.php` or `routes/console.php`.
- Console commands in `app/Console/Commands/` are auto-registered.

### Database

- When modifying a column in a migration, include all previously defined attributes or they will be dropped.
- Eager load limiting is native: `$query->latest()->limit(10);` — no extra packages needed.

### Models

- Define casts in a `casts()` method on the model, not the `$casts` property. Follow existing model conventions.

=== linting rules ===

## Linting & Static Analysis

### Pint

- Run `vendor/bin/pint --dirty --format agent` before finalizing any changes.
- Never run `--test`; just fix formatting directly.

### Rector

- Run `rector` as part of the lint step.
- Use `rector --dry-run` only when previewing changes without applying them.
- The project uses `driftingly/rector-laravel` — Rector rules are Laravel-aware.

### PHPStan / Larastan

- Run `phpstan` to check types. Fix type issues rather than suppressing them.

### Full Lint & Test Pipeline

Use these Composer scripts — don't call tools individually when a script covers it:

- `composer lint` — runs Rector + Pint
- `composer test:types` — runs PHPStan
- `composer test:lint` — dry-run Pint + Rector
- `composer test:type-coverage` — Pest type coverage (min 100%)
- `composer test` — runs all of the above

=== pest/core rules ===

## Pest v5

### Writing Tests

- All tests must use Pest. Use `php artisan make:test --pest {name}`.
- Do not remove any existing tests or test files without approval.
- Cover happy paths, failure paths, and edge cases.
- Tests live in `tests/Feature` and `tests/Unit`. Most tests should be feature tests.

```php
it('does something', function () {
    expect(true)->toBeTrue();
});
```

### Running Tests

- `php artisan test --compact` — all tests
- `php artisan test --compact tests/Feature/ExampleTest.php` — single file
- `php artisan test --compact --filter=testName` — filtered

### Assertions

- Use named assertion methods, not raw status codes:

```php
it('creates a resource', function () {
    $this->postJson('/api/v1/resources', [...])->assertCreated();
});
```

### Mocking

- Import `use function Pest\Laravel\mock;` before using `mock(...)`, or use `$this->mock()` following existing test conventions.

### Datasets

- Use datasets to reduce duplication, especially for validation rule tests.

```php
it('rejects invalid email', function (string $email) {
    $this->postJson('/api/v1/register', ['email' => $email])
        ->assertUnprocessable();
})->with(['not-an-email', '', 'missing@']);
```

### Type Coverage

- Pest type coverage must stay at 100%. Run `composer test:type-coverage` to verify.

</laravel-boost-guidelines>
