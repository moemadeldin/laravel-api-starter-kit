# Laravel API Starter Kit

A production-ready Laravel API starter kit with Sanctum authentication, Pest testing, PHPStan static analysis, and Laravel Boost AI-assisted development.

## Tech Stack

| Package | Version |
|---------|---------|
| PHP | 8.5+ |
| Laravel | 13.x |
| Laravel Sanctum | 4.x |
| Pest | 5.x |
| PHPStan / Larastan | 3.x |
| Laravel Boost | 2.x |

## Requirements

- PHP >= 8.5
- Composer
- MySQL 8.0+ / PostgreSQL 15+
- Node.js / Bun (for frontend assets)

## Installation

### Via Composer Create Project

```bash
composer create-project moemadeldin/laravel-api-starter-kit my-api
```

### Post Installation

```bash
cd my-api

# Copy environment file and generate key
cp .env.example .env
php artisan key:generate

# Configure your database in .env, then run migrations
php artisan migrate

# Install dependencies
composer install
bun install
bun run build
```

## Environment Variables

Configure these in your `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```

## API Endpoints

All endpoints are versioned under `/api/v1`.

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| POST | `/api/v1/register` | Guest | Register a new user |
| POST | `/api/v1/login` | Guest | Login and get token |
| DELETE | `/api/v1/logout` | Bearer | Logout (revoke token) |

### Authentication

Use Laravel Sanctum tokens. Include the token in the `Authorization` header:

```
Authorization: Bearer {your-token}
```

## Development Commands

```bash
# Start full dev environment (server, queue, logs, vite)
composer run dev

# Format code with Pint
vendor/bin/pint --dirty

# Lint (Rector + Pint)
composer lint

# Static analysis
composer test:types

# Run tests
composer test

# Run specific test
php artisan test --compact --filter=TestName
```

## Testing

This project uses [Pest](https://pestphp.com/) for testing with 100% type coverage enforced.

```bash
# Run all tests with type coverage and static analysis
composer test

# Run only feature tests
php artisan test tests/Feature

# Run only unit tests
php artisan test tests/Unit
```

## Project Structure

```
app/
├── Actions/Auth/          # Business logic actions
├── Controllers/API/V1/    # Versioned API controllers
├── Enums/                 # Database-level enums
├── Exceptions/            # Custom exceptions
├── Http/
│   ├── Middleware/        # HTTP middleware
│   ├── Requests/          # Form request validators
│   └── Resources/         # API resources
├── Models/                # Eloquent models
├── Services/              # Reusable services
└── Utilities/             # Constants, traits, helpers
```

## AI-Assisted Development

This project includes [Laravel Boost](https://laravel.com/docs/boost) for AI-powered development with Opencode.

### Setup

1. Install Laravel Boost:
```bash
composer require laravel/boost --dev
php artisan boost:install
```

2. Add MCP server to `~/.config/opencode/opencode.json`:
```json
{
  "$schema": "https://opencode.ai/config.json",
  "mcp": {
    "laravel-boost": {
      "type": "local",
      "command": ["php", "artisan", "boost:mcp"],
      "enabled": true
    }
  }
}
```

3. Run `/mcps` in Opencode to verify the connection.

### Available Tools

- `database-schema` - Inspect table structures
- `database-query` - Run read-only SQL queries
- `search-docs` - Version-aware Laravel documentation
- `tinker` - Execute PHP code in the app context
- `read-log-entries` - Read application logs
- `browser-logs` - Read browser console logs

## Code Quality

| Check | Command |
|-------|---------|
| Static Analysis | `composer test:types` |
| Lint Check | `composer test:lint` |
| Type Coverage | `composer test:type-coverage` |
| All Checks | `composer test` |

## License

MIT
