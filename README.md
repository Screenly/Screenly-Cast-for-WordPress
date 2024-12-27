# Screenly Cast for WordPress

A WordPress plugin to enable easy and beautiful casting of pages, posts and image media on [Screenly](https://www.screenly.io) digital signage devices.

The Screenly Cast plugin optimizes your website content for beautiful, easy-to-read display on TVs and other non-interactive devices.

Without Screenly Cast for WordPress:
![Without Screenly Cast for WordPress](/assets/screenshot-1.png)

With Screenly Cast for WordPress:
![With Screenly Cast for WordPress](/assets/screenshot-2.png)

## Installing

* Search for *Screenly Cast* in the WordPress plugin directory
* Activate the plugin

## Usage with [Screenly](https://www.screenly.io)

Check out our video introduction to Screenly Cast for WordPress:

[![An introduction to Screenly Cast for WordPress](https://img.youtube.com/vi/rX6b9ZAYi34/0.jpg)](https://www.youtube.com/watch?v=rX6b9ZAYi34)

To make use of the plugin on your **Screenly Screen** you just need to follow these simple steps:

1. Make sure the **plugin is activated**.
2. **Copy and Paste** the URL of your website, post, page or attachment.
3. Change the URL, adding a parameter called `srly`, like this:
   - `https://www.mydomain.com/?srly`
   - `https://www.mydomain.com/my-post-url?srly`
   - `https://www.mydomain.com/my-page-url?srly`
   - `https://www.mydomain.com/my-attachment-url?srly`
   - `https://www.mydomain.com/?somevar=1&anothervar=2&srly` - In case you're using more than one parameter
   - **Note:** There is no need to apply any value to the parameter. It just needs to exist in the query.
4. [Login to Screenly](https://login.screenlyapp.com) and navigate to **Assets** on the top menu.
5. Click on the button **+ Add Asset**.
6. Select the tab **URL**.
7. **Paste** the edited URL (from step 3).
8. Hit **Save**.
9. On the asset detail page, make sure to set a **recognizable title** since this is what you will see in Screenly later.
10. Go to the **Playlists** section and **add the new asset**. Make sure to pick an appropriate **Duration** for a good reading experience.
11. Hit **Save**.

For detailed instructions, check out this [blog post](https://news.screenly.io/introducing-screenly-cast-for-wordpress-a27ff26667b7).

Screenly Cast for WordPress works with both [Screenly](https://www.screenly.io) and [Anthias](https://anthias.screenly.io/), and should also work just fine with most other digital signage solutions, but the usage will vary.

## How it works

The plugin comes with a simple theme that will be used specifically for Screenly content. The plugin detects the `srly` parameter in your URL, like in `http://www.myblog.com/?srly`, and applies the template. A `template_include` filter is used to activate the plugin's theme files. Your content will be rendered using the Screenly theme, without affecting your normal theme still in use for the rest of your site.

Because the plugin targets Screenly devices with no end user interaction, content will be laid out in a simple and TV friendly layout. Just the title, content and featured image are used. The plugin automatically simplifies the markup and removes functionality not appropriate for the medium. For example, since there is no interaction, any clickable links is simplified to just the title text.

For the best experience for your reader you should assume that no more than 250 characters or so will be displayed. Screenly Cast does not try to automatically scroll the content because for these non-interactive, often large TV displays, fixed unmoving content usually looks and reads the best.

## Development

### Requirements

- Docker
- Docker Compose
- PHP 7.4 or higher (for local development without Docker)
- WordPress 6.2.4 or higher
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
