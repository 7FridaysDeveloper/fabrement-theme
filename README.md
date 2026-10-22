# Fabrement Base

A minimal classic WordPress theme for sites built with the [Fabrement](https://fabrement.com/) plugin.
The plugin draws the pages (templates, blocks, headers, footers); the theme only gives them a frame —
`wp_head()`, `wp_body_open()`, `wp_footer()` — and shows a welcome page on a fresh site.

- Requires WordPress 6.9+, PHP 8.0+
- Text domain: `fabrement-theme`
- License: GPL-2.0-or-later

## Installing

**From the plugin.** The full Fabrement plugin shows administrators a notice on its own admin
screens (Fabrement menu):

1. **Install theme** — downloads the latest release
   (`https://github.com/7FridaysDeveloper/fabrement-theme/releases/latest/download/fabrement-theme.zip`).
2. **Activate theme** — switches the site to it, as a separate step.

Closing the notice (×) hides it for every administrator of the site. It is not shown once the theme
is active.

**By hand.** Download `fabrement-theme.zip` from the latest release and upload it in
*Appearance → Themes → Add New → Upload Theme*.

## The welcome page

While *Settings → Reading* shows the latest posts on the front page (a fresh site), the front page is
a welcome screen (`home.php`):

- **Administrators** see "Welcome to your New Site", a **Connect MCP** button (the plugin's
  MCP Connection screen; fabrement.com when the plugin is off), **Visit fabrement.com**, the steps
  Connect → Describe → Publish and a link to *Settings → Reading*.
- **Visitors** see the site name, "Something new is on its way" and **Visit fabrement.com**.

Once a page is set as the homepage, or the Fabrement plugin assigns a template to the front page, the
welcome page and its CSS and fonts are gone; the posts page then uses the plain `index.php` list.

There is intentionally no `front-page.php`: it would outrank the templates the plugin assigns.

## What the theme turns off

Only in `<head>` on the front end (`functions.php`):

| Removed | Why |
|---|---|
| Emoji detection script and styles | Browsers draw emoji themselves |
| `<meta name="generator">` | Shows the WordPress version |
| RSD link | Only for XML-RPC blog clients |
| Shortlink (`<link rel="shortlink">` and the HTTP header) | `?p=123` links nobody uses |

Kept on purpose: block library styles, global styles (Fabrement templates and local fonts rely on
them), classic theme styles, REST API link, oEmbed and RSS feed links.

## Files

```
style.css            theme header
functions.php        theme supports, head cleanup, welcome page CSS and body class
header.php           <head>, wp_head(), <body>, wp_body_open()
footer.php           wp_footer()
index.php            fallback: single entry or a list with pagination
home.php             the welcome page (falls back to index.php when not the front page)
screenshot.png       1200×900 picture for Appearance → Themes
assets/css/welcome.css   welcome page styles, loaded only there
assets/fonts/        Oxanium 400 and Montserrat 700 (woff2, latin + latin-ext), OFL licenses
assets/images/       logo and decorative shapes of the welcome page
```

## Fonts

Oxanium and Montserrat are served from the theme (no Google Fonts request) under the
SIL Open Font License 1.1 — the license texts are in `assets/fonts/`. Buttons ask for Gotham Pro
first (fabrement.com's font, commercial, not bundled) and fall back to Montserrat.

## Screenshot

`screenshot.png` is a 1200×900 capture of the welcome page (admin view, admin bar hidden). To
change it, replace the file with any 1200×900 PNG or JPG.

## Releasing

The plugin installs from the asset `fabrement-theme.zip` of the **latest** release; the zip must hold
the folder `fabrement-theme/` (GitHub's own source archive holds `fabrement-theme-main/` and would
install as a different theme).

The first release is `v1.0.0`. For each next one (`X.Y.Z` below is its version):

1. Raise `Version` in `style.css` to `X.Y.Z` (it also busts the cache of the welcome page CSS and images).
2. Commit and tag: `git tag vX.Y.Z && git push origin main --tags`.
3. Build the zip — `.gitattributes` keeps the README and git files out of it:

   ```
   git archive --format=zip --prefix=fabrement-theme/ -o fabrement-theme.zip HEAD
   ```

4. Create the release from the tag and attach `fabrement-theme.zip` under exactly that name:

   ```
   gh release create vX.Y.Z fabrement-theme.zip --title "X.Y.Z" --notes "…"
   ```

Installed sites are not updated automatically: the theme has no update checker.
