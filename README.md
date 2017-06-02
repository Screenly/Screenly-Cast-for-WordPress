# Screenly Cast for WordPress

A WordPress plugin to enable easy and beautiful casting of pages, posts and image media on [Screenly](https://www.screenly.io) digital signage devices.

The Screenly Cast plugin optimizes your website content for beautiful, easy to read display on TVs and other non-interactive devices.

Without Screenly Cast for WordPress:
![Without Screenly Cast for WordPress](/assets/screenshot-1.png)

With Screenly Cast for WordPress:
![With Screenly Cast for WordPress](/assets/screenshot-2.png)

## Installing

 * Search for *Screenly Cast* in the WordPress plugin directory
 * Activate the plugin

You can also check out our video introduction to the plugin:

[![An introduction to Screenly Cast for WordPress](https://img.youtube.com/vi/rX6b9ZAYi34/0.jpg)](https://www.youtube.com/watch?v=rX6b9ZAYi34)

## Usage with Screenly

To make use of the plugin on your **Screenly Screen** you just need to follow these simple steps:

  1. Make sure the **plugin is activated**.
  2. **Copy and Paste** the URL of your website, post, page or attachment.
  3. Change the URL, adding a parameter called `srly`, like this::
    - `https://www.mydomain.com/?srly`
    - `https://www.mydomain.com/my-post-url?srly`
    - `https://www.mydomain.com/my-page-url?srly`
    - `https://www.mydomain.com/my-attachment-url?srly`
    - `https://www.mydomain.com/?somevar=1&anothervar=2&srly` - In case your using more than one parameter
    - **Note:** There is no need to apply any value to the parameter. It just needs to exist on the query.
  4. [Login to Screenly](https://login.screenlyapp.com) and navigate to **Assets** on the top menu.
  5. Click on the button **+ Add Asset**.
  6. Select the tab **URL**.
  7. **Paste** the edited URL (from step 3).
  8. Hit **Save**.
  9. On the asset detail page, make sure to set a **recognizable title** since this is what you will see in Screenly later.
  10. Go to the **Playlists** section and **add the new asset**. Make sure to pick an appropriate **Duration** for a good reading experience.
  11. Hit **Save**.
  12. Profit.

For detailed instructions, check out this [Medium post](https://news.screenly.io/introducing-screenly-cast-for-wordpress-a27ff26667b7).

Screenly Cast for WordPress should also work just fine with most other digital signage solutions, but the usage will vary.

## How it works

The plugin comes with a simple theme that will be used specifically for Screenly content. The plugin detects the `srly` parameter in your URL, like in `http://www.myblog.com/?srly`, and applies the template. A `template_include` filter is used to activate the plugin's theme files. Your content will be rendered using the Screenly theme, without affecting your normal theme still in use for the rest of your site.

Because the plugin targets Screenly devices with no end user interaction, content will be laid out in a simple and TV friendly layout. Just the title, content and featured image are used. The plugin automatically simplifies the markup and removes functionality not appropriate for the medium. For example, since there is no interaction, any clickable links is simplified to just the title text.

For the best experience for your reader you should assume that no more than 250 characters or so will be displayed. Screenly Cast does not try to automatically scroll the content because for these non-interactive, often large TV displays, fixed unmoving content usually looks and reads the best.

## Development

To setup a local development, simply install Docker and:
 * Run `docker-compose up` from the root of the repository.
 * Navigate to https://localhost:8000.
 * Create your account and activate the plugin.

Please note that you do not need to install the plugin from the plugin directory. The code plugin folder is automatically added to the WordPress installation. All you need to do is to activate the plugin.
