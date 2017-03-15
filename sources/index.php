<?php
// Der Code ist scheisse! Niemand ist stolz drauf.

function get_db() {
	require('config.php');
	$db = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
	$db->set_charset('utf8');
	return $db;
}

function bauernregel() {
	$db = get_db();
	$texts = [];
	$res = $db->query("SELECT text FROM bauernregeln;");
	while($row = $res->fetch_assoc()) {
		$texts[] = $row['text'];
	}
	return $texts[array_rand($texts)];
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Bauernregel des Tages</title>
	</head>
	<body>
		<section id="content">
		<?php
		$db = get_db();
		if ($db->connect_errno) {
			echo "<h1>Fehler</h1>";
			echo "<p>Oh je, ich komm nicht an meine Datenbank ran. Parameter waren:</p>";
			require('config.php');
			echo var_dump($config);
		} else {
			echo "<h1>Erfolg</h1>";
			echo "<p>Datenbankverbindung OK. Eine zufällige Bauernregel:</p>";
			echo "<p>";
			echo bauernregel($db);
			echo "</p>";
		}

		?>
		</p>

		</section>
	</body>
</html>
