# Screenly Cast for WordPress

A WordPress plugin to enable easy and beautiful casting of pages, posts and image media on [Screenly](https://www.screenly.io) digital signage devices.

## Development

### Requirements

- Docker
- Docker Compose
- PHP 7.4 or higher (for local development without Docker)
- WordPress 6.4 or higher
- Composer for dependency management

### Setup

1. Clone this repository
2. For local development:
   ```bash
   composer install
   ```
3. For running tests:
   ```bash
   docker compose up wordpress-test
   ```

### Release Process

1. Update version numbers in:
   - Plugin header in `screenly-cast.php`
   - `Configuration::VERSION` constant
   - `Stable tag` in `readme.txt`
   - Add entry to changelog in `readme.txt`

2. Commit changes and push to GitHub

3. Create a new GitHub Release:
   - Create a new tag following semantic versioning (e.g., `v1.0.0`)
   - Set release title (e.g., "Version 1.0.0")
   - Add changelog entry to release description
   - Publish release

4. GitHub Actions will automatically:
   - Run tests across supported PHP versions
   - If tests pass, deploy to WordPress.org plugin repository

### Version Numbers

We use [Semantic Versioning](https://semver.org/):
- MAJOR version for incompatible API changes
- MINOR version for backwards-compatible functionality additions
- PATCH version for backwards-compatible bug fixes

## License

GPLv2
