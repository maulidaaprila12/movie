# AI Agent Instructions for Laravel Movie DB

This is a **Laravel 10** course project that demonstrates clean architecture patterns for a movie database system. AI agents should understand the compact, layered folder structure and follow the established patterns.

## Project Overview

**Purpose**: Educational project for "Konstruksi dan Evolusi Perangkat Lunak" course (TRPL, Politeknik Negeri Padang)  
**Stack**: Laravel 10, PHP 8.1+, MySQL, Blade templating  
**Domain**: Movie catalog with categories, search, and CRUD operations

## Folder Structure & Architecture

The project follows a **clean architecture pattern** with clear separation of concerns:

```
app/
├── Http/Controllers/        # Request handlers (MovieController)
├── Services/                # Business logic orchestration (MovieService)
├── Repositories/            # Data access layer (MovieRepository)
├── Interfaces/              # Contracts (MovieRepositoryInterface)
├── Models/                  # Eloquent models (Movie, Category, User)
└── Providers/               # DI container configuration
```

### Key Pattern: Dependency Injection

Services and Repositories use **constructor injection** via Laravel's service container:
- Controllers inject Services → Services inject Repositories (via Interface)
- All repositories implement an Interface contract
- See `app/Providers/AppServiceProvider.php` for DI binding

Example flow:
```
MovieController → MovieService → MovieRepository (via MovieRepositoryInterface)
```

## Data Model

- **Movie**: id (string UUID), judul, sinopsis, category_id, tahun, pemain, foto_sampul
- **Category**: Categories that movies belong to
- **Relationships**: Movie `belongsTo` Category

## Common Tasks & Commands

### Setup & Database
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate          # Creates tables
php artisan db:seed          # Populates with sample data
php artisan serve            # Runs on http://localhost:8000
```

### Development
- **Controllers**: Handle HTTP requests, validate input, delegate to services
- **Services**: Orchestrate business logic, file handling, call repositories
- **Repositories**: Query database via Eloquent models
- **Migrations**: Located in `database/migrations/` (auto-discovered by Laravel)
- **Seeders**: Use Factory pattern for test data (`database/factories/`)
- **Views**: Blade templates in `resources/views/` (use partials for reusable components)

### Common Operations When Coding

1. **Adding a new feature**:
   - Create Controller method
   - Create Service method
   - Add Repository method
   - Create/update migration if needed
   - Create Blade view(s)

2. **Database changes**: 
   - Create migration via artisan: `php artisan make:migration <name>`
   - Update Model fillable/relationships
   - Run `php artisan migrate`

3. **File uploads**: 
   - MovieService handles file storage (uses `storage/app/` directory)
   - Reference: `app/Services/MovieService.php` for upload patterns

## Testing

- Test files: `tests/Feature/` and `tests/Unit/`
- Run: `php artisan test` or `./vendor/bin/phpunit`
- Uses PHPUnit 10, Mockery for mocking

## Key Conventions

1. **Naming**: 
   - Models: Singular (Movie, Category)
   - Controllers: Singular + "Controller" (MovieController)
   - Services: Singular + "Service" (MovieService)
   - Repositories: Singular + "Repository" (MovieRepository)

2. **Blade Templates**:
   - Main layout: `resources/views/layouts/app.blade.php`
   - Feature views: `resources/views/movies/` folder
   - Reusable partials: `resources/views/movies/partials/`

3. **Routes**: 
   - Web routes: `routes/web.php` (Blade views)
   - API routes: `routes/api.php` (JSON responses)

## Common Pitfalls & Tips

- **Mass assignment**: Remember `protected $fillable` in models
- **UUID vs auto-increment**: Movie model uses string UUID, not auto-increment
- **Search feature**: Movie repository supports `?search=` query parameter for full-text search
- **Pagination**: Uses `paginate(6)` per page, supports `?page=` parameter
- **Validation**: MovieService validates all incoming data before repository calls
- **File paths**: Uses Illuminate\Support\Facades\File for file operations

## Documentation

For more details, see:
- [README.md](README.md) - Setup instructions
- [Laravel Documentation](https://laravel.com/docs/10.x)
- Database schema: Check migrations in `database/migrations/`
