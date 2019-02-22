<?php
ob_start();
require_once('/var/www/she/swo.re/includes/functions.php');
if (isset($_REQUEST['ext'])) {
	$type = preg_replace('//\/(.+?)\/.*/', '$1', $_REQUEST['ext']);
	// echo $type;
	if ($type == 'css') {
		header('Content-Type: text/css;');
	} else {
		header('Content-Type: application/x-javascript;');
	}
	include('/home/she/http/marvell.cat' . $_REQUEST['ext']);
	ob_end_flush();
	exit();
} elseif (!isset($_REQUEST['num'])) {
	$_REQUEST['num'] = 0;
}
$actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') .
'://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// echo $_SERVER['REQUEST_URI'];
$site = preg_replace('/^https?:\/\/' . $_SERVER['HTTP_HOST'] .
'\/(.+?)\/.*/', '$1', $actual_link);
$discord = false;
// echo $_SERVER['HTTP_HOST'];
if ($site == 'discord') {
	$discord = true;
	$title = 'Discord Slideshow';
	$bclass = 'discord mono';
}

if (preg_match('/mono/', $_REQUEST['q'])) {
	$_REQUEST['q'] = str_replace('mono', '', $_REQUEST['q']);
	if (isset($bclass)) $bclass .= 'mono';
	else $bclass = 'mono';
}
$convert = array('+', '-', "/$site/", "$site/", '%20');
$_REQUEST['q'] = strtolower(ltrim(str_replace($convert, ' ',
preg_replace('|^/|', '', $_REQUEST['q']))));
error_reporting(E_ALL);
$items = Array();
if (preg_match('/ /', $_REQUEST['q'])) {
	$items = explode(' ', $_REQUEST['q']);
}
if (sizeof($items) == 0 && $_REQUEST['q'] != '') {
	$items = Array(0 => $_REQUEST['q']);
}
$sizeitems = sizeof($items);
sm_head($title, '', $bclass, 'img');
?>
	<div class="left"><div>&lt;</div></div>
	<div class="right"><div>&gt;</div></div>
	<h1>Please choose a channel!!</h1><br />
	<div class="flexbox">
			<?php
			if (!$_REQUEST['q'] || $_REQUEST['q'] == '') :
				$files = array_reverse(scandir('.', 1));
				array_shift($files);
				array_shift($files);
				// echo '<pre>' . print_r($files) . '</pre>';
				foreach ($files as $key => $value) :
					if (!preg_match('/.*\.sld/', $files[$key])) :
						unset($files[$key]);
					endif;
				endforeach;
				// echo '<pre>' . print_r($files) . '</pre>';
				if ($sizeitems <= 1) :
					foreach (array_values($files) as $key => $file) :
						$fileextless = preg_replace('/\.sld/', '', $file);
						echo '<div ' . ($key == 0 ? 'class="visible"' : '') . '><a href="//marvell.cat/discord/?q=' . $fileextless . '" style="text-align: center">' .
						'<img src="' . fgets(fopen($file, 'r')) . '" /></a></div>';
						// echo '<a href="//marvell.cat/discord/?q=' . $file . '">' . $file . 'kh</a>';
					endforeach; ?>
					<script>
					$()
					</script>
				<?php endif;
			else:
				$channelid = $_REQUEST['q'];
				$file = new SplFileObject($channelid . '.sld');
				$fileIterator = new LimitIterator($file, 0, 99);
				foreach($fileIterator as $key => $line) :
					if ($line != '') echo ( $key == $_REQUEST['num'] ? '<div class="visible">' : '<div>' ) . '<center><img src="' . $line . '" /></center></div>';
				endforeach;
			endif;
			?>
	</div>
	<div class="overlay">
		<div class="help">
			<dl>
				<h1>Key Commands</h1>
				<dt>a</dt><dd>Switch between View All and One At A Time</dd>
				<hr>
				<h2>One At A Time Mode</h2>
				<dt>Up Arrow</dt><dd>Advance 5 Pictures</dd>
				<dt>Right Arrow</dt><dd>Advance 1 Picture</dd>
				<dt>Down Arrow</dt><dd>Go Back 5 Pictures</dd>
				<dt>Left Arrow</dt><dd>Go Back 1 Picture</dd>
				<dt>Escape</dt><dd>Exit to View All</dd>
				<hr>
				<h2>View All Mode</h2>
				<dt>Enter</dt><dd>In search box, does a search</dd>
				<hr>
				<h2>Tagging Mode</h2>
				<dt>Enter</dt><dd>In Name box, submits new name</dd>
			</dl>
		</div>
	</div>
</body>
