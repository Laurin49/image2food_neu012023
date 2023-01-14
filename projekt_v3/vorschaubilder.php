<!DOCTYPE html>
<html>
	<head>
		<title>Vorschau</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<h1>Vorschau</h1>
		<?php
		class Thumb {
			function thumbnail_erstellen() {
				$bv = "images";
				$vb = "thumb";
				$verzeichnis = opendir($bv);
				$bilder = array();
				while (($datei = readdir($verzeichnis)) !== false) {
					if ((preg_match("/\.jpe?g$/i", $datei)) || (preg_match("/\.png$/i", $datei))) {
						$bilder[] = $datei;
					}
				}
				closedir($verzeichnis);
				$verzeichnis = opendir($vb);
			

					//Schleife, bis alle Files im Verzeichnis ausgelesen wurden
					while (($datei = readdir($verzeichnis)) !== false) {
						//Oft werden auch die Standardordner . und .. ausgelesen, diese sollen ignoriert werden
						if ($datei != "." AND $datei != "..") {
							//Files vom Server entfernen
							@unlink("$vb/$datei");
						}
					}
					closedir($verzeichnis);
			
				foreach ($bilder as $bild) {
					if (preg_match("/\.png$/i", $bild)) {

						$b = imagecreatefrompng("$bv/$bild");
					} else {
						$b = imagecreatefromjpeg("$bv/$bild");
					}

					$originalbreite = imagesx($b);
					$originalhoehe = imagesy($b);
					$neuebreite = 120;
					$neuehoehe = floor($originalhoehe * ($neuebreite / $originalbreite));
					$neuesbild = imagecreatetruecolor($neuebreite, $neuehoehe);
					imagecopyresampled($neuesbild, $b, 0, 0, 0, 0, $neuebreite, $neuehoehe, $originalbreite, $originalhoehe);
					imagejpeg($neuesbild, "$vb/$bild");
					imagedestroy($neuesbild);
				}
			}

			function thumbnail_anzeigen() {
				$bv = "thumb";
				$verzeichnis = opendir($bv);
				while (($datei = readdir($verzeichnis)) !== false) {
					if (preg_match("/\.jpe?g$/i", $datei)) {
						echo "<a href=''><img src='$bv/$datei' " . "alt='Vorschaubild'></a> ";

					}
				}
				closedir($verzeichnis);
			}

		}

		$obj = new Thumb();

		$obj -> thumbnail_erstellen();
		$obj -> thumbnail_anzeigen();
		?>
	</body>
</html>