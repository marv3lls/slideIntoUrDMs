# slideIntoUrDMs

A Discord bot that uses a modification of my good ol' slideshow & meme displaying
script.

- `composer.json` this includes the relevant `discord-php` library from the
ever-fabulous [Team Reflex](https://github.com/teamreflex/DiscordPHP)!

- `default.css` is the main style css from my site.

- `images.js` is the whole control script for managing images; I'll probably
add a bunch of conditionals to it for when I'm on a `/discord/` URL.

- `index.php` and, speaking of conditionals… I should probably tune this up
more but I just stripped all the other slideshow code from elsewhere on my site. 😕

- `slideintourdms.php` This here be the Discord bot!

## Why channel_id instead of names?

It's a unique id that won't have conflicts between two different servers or
channels

## Why don't you show the server and channel name as a header-ish thing on the page?

TODO: Ya know, that's a great idea!! Maybe someday I'll find out how to convert
a channel's UUID to that.
