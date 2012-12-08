<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="et">
<head>
<title>Roundcube - Nightly Builds</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="styles.css" type="text/css" media="screen" />
</head>
<body>

<div id="banner">
  <div class="banner-bg"></div>
  <div class="banner-logo"><a href="http://roundcube.net"><img src="http://roundcube.net/template/images/rcube_logo.gif" width="210" height="55" border="0" alt="Roundcube - Open source webmail project" /></a></div>
</div>

<div id="topnav">
 
</div>

<div id="content">

<h1>Nightly Builds</h1>

<p>
<?php

$list = scandir('./trunk/');
usort($list, 'sortbyrev');
$latest = $list[0];
//$version = preg_match('/-r(\d+)/', $latest, $rev);
if (preg_match('/-(\d+)\./', $latest, $date))
   $time = strtotime($date[1]);

//printf('<a href="./trunk/%s">Download latest (r%d)</a>', $latest, $rev[1]);
printf('<a href="./trunk/%s">Download latest</a> <span class="date">(%s)</span>', $latest, date('Y-m-d', $time));

function sortbyrev($a, $b)
{
	preg_match('/-(\d+)\./', $a, $rev_a);
	preg_match('/-(\d+)\./', $b, $rev_b);
	return intval($rev_b[1]) - intval($rev_a[1]);
}

?>
</p>

<h3>Older builds:</h3>
<ul>
<?php

for ($i=1; $i < min(11, count($list)); $i++) {
	$mtime = filemtime("./trunk/" . $list[$i]);
//	$version = preg_match('/-r(\d+)/', $list[$i], $rev);
	printf('<li><a href="./trunk/%s">%s</a></li>'."\n",
		$list[$i],
		date('Y-m-d', $mtime)
	);
}

?>
</ul>

</div>

</body>
</html>
