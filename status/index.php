<?php
function printUptime() {
	$str   = @file_get_contents('/proc/uptime');
	$num   = (int)floatval($str);
	$dtF = new \DateTime('@0');
	$dtT = new \DateTime("@$num");
	return $dtF->diff($dtT)->format('%a days %h:%i:%s');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta http-equiv="refresh" content="10" />
	<title>Status | ChandlerSwift at Duluth</title>
	<style>body{margin:1em auto;max-width:40em;padding:0 .62em;font:1.2em sans-serif; line-height: 1.62em;}h1,h2,h3{line-height:1.2em;}@media print{body{max-width:none}}</style>
	<style>.up { background-color: #bfb; } .down { background-color: #fbb; }</style>
	<link rel="shortcut icon" href="https://chandlerswift.com/favicon.ico" />
</head>
<body>
<header>
	<!-- TODO: green when good -->
	<h1>Status | <a href="../">ChandlerSwift.com &ndash; Duluth</a></h1>
</header>
<section>
<h2>Servers</h2>
<ul>
<li>Web: <span class="up">Up <?= printUptime() ?></span></li>

<li>UPS: <?php $ups_info = json_decode(file_get_contents('http://ups-monitor/')); ?>
<ul>
<?php foreach ($ups_info as $key => $stat): ?>
	<li><?= $key ?>: <?= $stat ?></li>
<?php endforeach; ?>
</ul>
</li>
</ul>
</section>
</body>
</html>
