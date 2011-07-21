<?php

require('top.php');

if (isset($_GET['v'])) {
	$_SESSION['volume'] = intval($_GET['v']);
}

$radio = new Lib_Radio();
$stations = $radio->stations();

foreach ($stations as $group_name => &$group_stations) {
	foreach ($group_stations as &$station) {
		$s = Lib_Station_Factory::create($group_name, $station);
		
		$station = array(
			'id' => $s->id(),
			'name' => $s->name(),
			'playing' => $s->playing()
		);
		
		if (isset($_GET['v']) && $station['playing']) {
			$s->stop();
			$s->play($_SESSION['volume']);
		}
	}
	
	// Destroy reference
	unset($station);
}

// Destroy reference
unset($group_stations);

if (isset($_GET['v'])) {
	header('Location: ./');
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Music Web Remote</title>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="refresh" content="30" />
	<link href="resource/css/main.css" rel="stylesheet" media="all" />
</head>
<body>

<h2>Radio</h2>

<form action="./" method="get">
	<label>
		Volume:
		
		<select name="v">
			<? foreach (array_fill(0, 10, '') as $i => $t): ?>
				<? $v = 100 - $i * 10 ?>
				
				<? if (isset($_SESSION['volume']) && $_SESSION['volume'] === $v): ?>
					<option selected="selected" value="<?= $v ?>"><?= $v ?></option>
				<? else: ?>
					<option value="<?= $v ?>"><?= $v ?></option>
				<? endif ?>
			<? endforeach ?>
		</select>
	</label>
	
	<input type="submit" value="Set" />
</form>


<? foreach ($stations as $group => $group_stations): ?>
	<h3><?= ucfirst($group) ?></h3>
	
	<ul>
	<? foreach ($group_stations as $station): ?>
		<li>
			<?= $station['name'] ?>
			
			<?
				if ($station['playing']) {
					$command = 'stop';
				} else {
					$command = 'play';
				}
				
				$href = "command.php?c={$command}&amp;g={$group}&amp;s={$station['id']}";
				
				if (isset($_SESSION['volume'])) {
					$href .= "&amp;v={$_SESSION['volume']}";
				}
			?>
			
			<? if ($command === 'play'): ?>
				(<a href="<?= $href ?>">Start</a>)
			<? else: ?>
				(Playing... <a href="<?= $href ?>">Stop</a>)
			<? endif ?>
		</li>
	<? endforeach ?>
	</ul>
	
<? endforeach ?>

</body>
</html>