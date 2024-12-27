# Screenly Cast for WordPress

A WordPress plugin to enable easy and beautiful casting of pages, posts and image
media on [Screenly](https://www.screenly.io) digital signage devices.

The Screenly Cast plugin optimizes your website content for beautiful,
easy-to-read display on TVs and other non-interactive devices.

Without Screenly Cast for WordPress:
![Without Screenly Cast for WordPress](/assets/screenshot-1.png)

With Screenly Cast for WordPress:
![With Screenly Cast for WordPress](/assets/screenshot-2.png)

## Installing

* Search for *Screenly Cast* in the WordPress plugin directory (or you can find it
  [here](https://wordpress.org/plugins/screenly-cast/))
* Activate the plugin

## Usage with [Screenly](https://www.screenly.io)

Check out our video introduction to Screenly Cast for WordPress:

[![An introduction to Screenly Cast for WordPress](https://img.youtube.com/vi/rX6b9ZAYi34/0.jpg)](https://www.youtube.com/watch?v=rX6b9ZAYi34)

To make use of the plugin on your **Screenly Screen** you just need to follow
these simple steps:

1. Make sure the **plugin is activated**.
2. **Copy and Paste** the URL of your website, post, page or attachment.
3. Change the URL, adding a parameter called `srly`, like this:
   * `https://www.mydomain.com/?srly`
   * `https://www.mydomain.com/my-post-url?srly`
   * `https://www.mydomain.com/my-page-url?srly`
   * `https://www.mydomain.com/my-attachment-url?srly`
   * `https://www.mydomain.com/?somevar=1&anothervar=2&srly` - In case you're
     using more than one parameter
   * **Note:** There is no need to apply any value to the parameter. It just
     needs to exist in the query.
4. [Login to Screenly](https://login.screenlyapp.com) and navigate to **Assets**
   on the top menu.
5. Click on the button **+ Add Asset**.
6. Select the tab **URL**.
7. **Paste** the edited URL (from step 3).
8. Hit **Save**.
9. On the asset detail page, make sure to set a **recognizable title** since this
   is what you will see in Screenly later.
10. Go to the **Playlists** section and **add the new asset**. Make sure to pick
    an appropriate **Duration** for a good reading experience.
11. Hit **Save**.

For detailed instructions, check out this [blog post](https://news.screenly.io/introducing-screenly-cast-for-wordpress-a27ff26667b7).

Screenly Cast for WordPress works with both [Screenly](https://www.screenly.io)
and [Anthias](https://anthias.screenly.io/), and should also work just fine with
most other digital signage solutions, but the usage will vary.

## How it works

The plugin comes with a simple theme that will be used specifically for Screenly
content. The plugin detects the `srly` parameter in your URL, like in
`http://www.myblog.com/?srly`, and applies the template. A `template_include`
filter is used to activate the plugin's theme files. Your content will be
rendered using the Screenly theme, without affecting your normal theme still in
use for the rest of your site.

Because the plugin targets Screenly devices with no end user interaction, content
will be laid out in a simple and TV friendly layout. Just the title, content and
featured image are used. The plugin automatically simplifies the markup and
removes functionality not appropriate for the medium. For example, since there is
no interaction, any clickable links is simplified to just the title text.

For the best experience for your reader you should assume that no more than 250
characters or so will be displayed. Screenly Cast does not try to automatically
scroll the content because for these non-interactive, often large TV displays,
fixed unmoving content usually looks and reads the best.

## Development

### Requirements

* Docker
* Docker Compose
* PHP 7.4 or higher (for local development without Docker)
* WordPress 6.2.4 or higher
* Composer for dependency management

### Setup

1. Clone this repository
1. For local development:

```bash
composer install
```

1. For running tests:

```bash
docker compose up wordpress-test
```

### Release Process

1. Update version and changelog:
   * Update version information in plugin header (`screenly-cast.php`):
     * `Version`
     * `Requires at least`
     * `Requires PHP`
   * Run `npm run version:sync` to sync package.json version with the plugin
   * Add detailed changelog entry in `readme.txt` under the `== Changelog ==`
     section
     * Follow the existing format (e.g., `= 1.0.0 =`)
     * List all changes with proper categorization (Major/Feature/Fix)
     * Include any breaking changes, new features, and bug fixes

1. Test the changes locally:

```bash
# Run the test suite
docker compose run --rm wordpress-test composer test
```

1. Build and verify the release locally:

```bash
# Clean install dependencies without dev packages
composer install --no-dev --optimize-autoloader

# Build the release
./bin/build.sh

# Verify the build output in build/screenly-cast/
```

1. Commit changes and push to GitHub:

```bash
git add .
git commit -m "Prepare release vX.Y.Z"
git push origin master
```

1. Create and push a new tag:

```bash
# Create a new tag
git tag -a vX.Y.Z -m "Version X.Y.Z"

# Push the tag
git push origin vX.Y.Z

# If you need to delete a tag locally and remotely (e.g., if made a mistake):
git tag -d vX.Y.Z               # Delete local tag
git push --delete origin vX.Y.Z # Delete remote tag
```

1. The GitHub Actions workflow will automatically:
   * Run tests across supported PHP versions
   * Build the release package without dev dependencies
   * If tests pass, deploy to WordPress.org plugin repository
   * The plugin will be available in the WordPress.org plugin directory after
     deployment

### Version Numbers

We use [Semantic Versioning](https://semver.org/):

* MAJOR version for incompatible API changes
* MINOR version for backwards-compatible functionality additions
* PATCH version for backwards-compatible bug fixes

### Creating a WordPress Plugin ZIP

Running the build script will:

* Create a clean build in the `build/` directory for WordPress.org deployment
* Generate an installable ZIP file in the `dist/` directory

```bash
./bin/build.sh
```

The resulting `dist/screenly-cast.zip` file can be uploaded via WordPress's "Add New Plugin" interface.

## License

GPLv2
