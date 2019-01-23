#!/usr/bin/php
<?php

include __DIR__.'/vendor/autoload.php';

/* SlideIntoUrDMs in Ruby
require 'discordrb'

# https://discordapp.com/oauth2/authorize?client_id=537524345665486849&scope=bot&permissions=52224
bot = Discordrb::Commands::CommandBot.new token: 'NTM3NTI0MzQ1NjY1NDg2ODQ5.Dymg4A.hNpxeC27z5mhl7CwVohbgsBjKFs', client_id: 537524345665486849, prefix: '~'

bot.message(with_text: 'Ping!') do |event|
event.respond 'Pong!'
end

bot.command(:link) do |event|
event.respond
end

bot.command(:help) do |event|
event.respond
end

bot.command(:load) do |event|
event.respond 'Acquiring the last ten image URLs!'
end

bot.run
*/
use Discord\Discord;
error_reporting(E_ALL);

$discord = new Discord([
	'token' => preg_replace('/\n/', '', file_get_contents('botToken.txt')),
]);

$discord->on('ready', function ($discord) {
	echo "Bot is ready!", PHP_EOL;

	// Listen for messages.
	$discord->on('message', function ($message, $discord) {
		$channelid = dechex($message->channel_id);
		if ($message->content == '~link') {
			$message->reply('https://marvell.cat/discord/' . $channelid);
		} elseif ($message->content == '~halp' || $message->content == '~help') {
			$message->reply('The only yet implemented command is "~link", and it should give you a marv3lls link to view a slideshow of channel images!!');
		} else {
			$imgs = fopen($channelid . '.sld', 'a');
			if(isset($message->content) && $message->content != '') {
				$mess = $message->content;
			} elseif (isset($message->attachments[0])) {
				$mess = 'adding - ' . $message->attachments[0]->url;
				fputs($imgs, $message->attachments[0]->url . "\n");
			} else { $mess = ''; }
			echo "{$message->author->username}: {$mess}",PHP_EOL;
			fclose($imgs);
		}
	});
});

$discord->run();

?>
