# Screenly Cast for WordPress
WordPress plugin to enable direct cast of pages, posts and image media on Screenly devices without you having to uninstall your current theme.
The **Screenly Cast for WordPress plugin optimizes your website content for a better display on devices that don't rely on any user interaction - **Zero UX**.

## Installing
To install the plugin just install it on you WordPress **plugins** folder. Go to your WordPress administration under the plugins section, scroll to the **Screenly Cast for WordPress** plugin and hit **activate**.

## Usage
To make use of the plugin on your **Screenly Screen** you just need to follow these simple steps:

  1. Make sure the **plugin is activated**.
  2. **Copy & Paste** the URL of your website, post, page or attachment.
  3. Pre-edit that same URL you selected with a **var** called `srly` like:
    - `http://www.mydomain.com/?srly`
    - `http://www.mydomain.com/my-post-url?srly`
    - `http://www.mydomain.com/my-page-url?srly`
    - `http://www.mydomain.com/my-attachment-url?srly`
    - `http://www.mydomain.com/?somevar=1&anothervar=2&srly` - In case your using more than one var
    - **Note** There is no need to apply any value to the var. It just needs to exist on the query.
  4. **[Login** to Screenly](https://login.screenlyapp.com) and navigate to **Assets** on the top menu.
  5. Click on the button **+ Add Asset**
  6. Select the tab **URL**
  7. **Paste** the pre-edited URL(step 3)
  8. Hit **Save**
  9. Once prompt to edit the new asset details, make sure to define a **recognizable title** since Screenly will not display any vars later.
  10. Go to the menu **Playlists** and **add the new asset** - Make sure to select a nice **Duration** for better user reading.
  11. Hit **Save**
  12. *Voila. Have fun.**

## How it works
The plugin is packed with a simple theme that will display the content. Once the plugin catches a var `srly` on your url, ex: `http://www.myblog.com/?srly`, a `template_include` filter is activated to redirect to the plugin's theme files. This means that your content will be treated by the plugin's theme and not with the theme you previously installed.

Because the plugin is targeting Screenly devices with no end user interaction, content will be treated with the basics of WordPress. This means the use of the title, content and featured image. A reduction in markup and functionalities is applied. Example of that is the fact that a text link becomes obsolete since there will be no direct interaction. Providing the extended link would consume plenty of space not available. You must assume a maximum of 250 characters if you want all content to fit on screen. Screenly doesn't rely on automatic page scrolling giving the fact that each assets has it's own timing and that would create conflict with the page script.

## Development

To setup a local development, simply install Docker and:
 * Run `docker-compose up` from the root of the repository
 * Navigate to https://localhost:8000
