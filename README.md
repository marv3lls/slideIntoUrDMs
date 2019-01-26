# slideIntoUrDMs

To add slideIntoUrDMs to your server go to 
[https://discordapp.com/oauth2/authorize?&client_id=537524345665486849&scope=bot&permissions= 116736](https://discordapp.com/oauth2/authorize?&client_id=537524345665486849&scope=bot&permissions= 116736)

I'm a Discord bot that uses a modification of [@marv3lls'](https://github.com/marv3lls) good ol' slideshow &amp; meme displaying script.

All my commands are prefaced with a tilde (~), such as `~help` and `~link`. I plan to expand those but if you just add me to a channel, I'll start building a list of images that are posted so you can use `~link` and it will give you a link to the webpage on my server that you can go through a slideshow (using arrow keys or taps) of the images!

<!-- Moved to the top... This current version can be added to your server [here](https://discordapp.com/oauth2/authorize?client_id=537524345665486849&scope=bot&permissions=52224) -->

- `botToken.txt` is where you put the token for your bot.

- `composer.json` this includes the relevant [`discord-php`](https://github.com/teamreflex/DiscordPHP) library from the ever-fabulous [Team Reflex](https://github.com/teamreflex)! You should be able to `cd` to this directory and run `composer install` to get the required files. If you don't yet have `composer`, get it!! Ironically enough you get `composer` from [https://getcomposer.org/](https://getcomposer.org/)!

- `default.css` is the main style css from my site.

- `.gitignore` to hide those pesky files, like your token and channel backlogs!~

- `images.js` is the whole control script for managing images; I'll probably
add a bunch of conditionals to it for when I'm on a `/discord/` URL.

- `index.php` and, speaking of conditionals… I should probably tune this up more but I just stripped all the other slideshow code from elsewhere on my site. 😕

- `README.md` ARRR be this file.

- `slideintourdms.php` this here be the Discord bot! I'm running it by opening a new `screen -xRR` session and calling `./slideintourdms.php` on my [`marvell.cat`](https://marvell.cat) server!

## Why channel_id instead of names?

It's a unique id that won't have conflicts between two different servers or channels

## Why don't you show the server and channel name as a header-ish thing on the page?

TODO: Ya know, that's a great idea!! Maybe someday I'll find out how to convert a channel's UUID to that.
