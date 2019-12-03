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

<li>Router: Up <?php echo file_get_contents('https://pfsense.duluth.chandlerswift.com/get_uptime.php', false, stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]])); ?></li>

<li>Web: Up <?= printUptime() ?> (<a href="self.php">status</a>)</li>

<li>UPS: <?php $ups_info = json_decode(file_get_contents('http://ups-monitor/')); ?>
<ul>
<?php foreach ($ups_info as $key => $stat): ?>
	<li><?= $key ?>: <?= $stat ?></li>
<?php endforeach; ?>
</ul>
</li>

<li>NAS: <?php $nas_info = json_decode(file_get_contents('http://root:Vq6CS1gW@freenas/api/v1.0/storage/volume/')); echo $nas_info[0]->status; ?>, <?php echo $nas_info[0]->used_pct; ?> used (<?php echo round($nas_info[0]->used / 10e11, 2); ?>/<?php echo round($nas_info[0]->avail / 10e11, 2); ?>TB)
</li>

</ul>
</section>
</body>
</html>
