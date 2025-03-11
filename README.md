
# The Border Beagle Theme

A Twig for WordPress theme using the [Timber library](https://wordpress.org/plugins/timber-library/), [WebPack](https://webpack.js.org/), and [TailwindCSS](https://tailwindcss.com/).


## Installing the Theme

Install this theme as you would any other, and run `composer install` to install the Timber dependency, alternatively you can install the Timber library plugin. But hey, let's break it down into some bullets:

1. Make sure you have installed Timber via composer or the plugin for the [Timber library](https://wordpress.org/plugins/timber-library/) (and Advanced Custom Fields - they [play quite nicely](https://timber.github.io/docs/guides/acf-cookbook/#nav) together).
2. Download the zip for this theme (or clone it) and move it to `wp-content/themes` in your WordPress installation.
3. Activate the theme in Appearance >  Themes.

## What's here?

`static/` is where you can keep your static front-end scripts, styles, or images. In other words, your Sass files, JS files, fonts, and SVGs would live here.

`functions/` is where you can keep your site specific functions. In other words, things you'd normally stuff into `functions.php`. ಠ_ಠ

`views/` contains all of your Twig templates. These pretty much correspond 1 to 1 with the PHP files that respond to the WordPress template hierarchy. At the end of each PHP template, you'll notice a `Timber::render()` function whose first parameter is the Twig file where that data (or `$context`) will be used. Just an FYI.

`bin/` and `tests/` ... basically don't worry about (or remove) these unless you know what they are and want to.

## Twig for WordPress Resources

* The [main Timber Wiki](https://github.com/jarednova/timber/wiki) is super great, so reference those often.
* [Twig for Timber Cheatsheet](http://notlaura.com/the-twig-for-timber-cheatsheet/)
* [Timber and Twig Reignited My Love for WordPress](https://css-tricks.com/timber-and-twig-reignited-my-love-for-wordpress/) on CSS-Tricks
* [A real live Timber theme](https://github.com/laras126/yuling-theme).
* [Timber Video Tutorials](http://timber.github.io/timber/#video-tutorials) and [an incomplete set of screencasts](https://www.youtube.com/playlist?list=PLuIlodXmVQ6pkqWyR6mtQ5gQZ6BrnuFx-) for building a Timber theme from scratch.

## WordPress Resources

* The functions found in `functions/disable-comments.php` disable comments and 'open pings' throughout the site. Simply remove the line `require_once( __DIR__ . '/functions/disable-comments.php' );` in the `functions.php` to 'enable' comments again. Some reasons you may want to disable comments can be found via this [Kinsta article](https://kinsta.com/blog/wordpress-disable-comments/).
* The functions found in `functions/disable-posts.php` disable WordPress' default posts but do not currently disable trackpacks and pings for posts. Simply remove the line `require_once( __DIR__ . '/functions/disable-posts.php' );` in the `functions.php` to 'enable' WordPress' default posts again.
	* Note: non-admins will be redirected if trying to access `{site-url}/edit.php` explicitly, admins can view `{site-url}/edit.php` but will be redirected when trying to add a new post.
* The commented functions found in `functions/custom-roles.php` are to create a custom role for your site. Simply remove the line `require_once( __DIR__ . '/functions/custom-roles.php' );` in the `functions.php` and remove the file if it will not be used. Information regarding creating custom roles and capabilities can be found in the [WordPress support guide](https://wordpress.org/support/article/roles-and-capabilities/).
* For custom post types, review the code in `functions/custom-post-types.php` and read the [Post Types documention in the WordPress plugin handbook](https://developer.wordpress.org/plugins/post-types/). For the really lazy use [Custom Post Type UI](https://wordpress.org/plugins/custom-post-type-ui/).
* The functions found in `functions/taxonomy-functions.php` prevent non-admins from adding a new post tag.

## In Memoriam

Louie 2008 - 2025

* [The Beagle Bungalow](https://beaglebungalow.org/)
* [Houston Beagle Rescue](https://www.houstonbeaglerescue.org/)
* [Texas Collie Rescue](http://www.texascollierescue.org/)
