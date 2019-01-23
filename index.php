<?php
ob_start();
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
?>
<!DOCTYPE html>
<html>
<head>
	<!-- <script type="text/javascript" src="/js/custom.js"></script> -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
	</script>
	<script src="/js/images.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/default.css" />
	<link rel="stylesheet" type="text/css" href="/css/images.css" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="<?php echo $_SERVER['HTTP_HOST'];
	?>" />
	<meta property="fb:admins" content="1057980117" />
	<meta property="fb:profile_id" content="1057980117" />
	<meta property="fb:app_id" content="966242223397117" />
	<meta name="viewport" content="width=340, initial-scale=1">
</head>
<body class="<?php echo ( isset($bclass) ? $bclass . ' ' : '' ); ?>">
	<div class="left"><div>&lt;</div></div>
	<div class="right"><div>&gt;</div></div>
	<?php $channelid = $_REQUEST['q']; ?>
	<div class="flexbox">
		<?php
		$file = new SplFileObject($channelid . '.sld');
		$fileIterator = new LimitIterator($file, 0, 99);
		foreach($fileIterator as $key => $line) {
			if ($line != '') echo ( $key == $_REQUEST['num'] ? '<div class="visible">' : '<div>' ) . '<center><img src="' . $line . '" /></center></div>';
		}
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
