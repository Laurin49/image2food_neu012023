<?php
session_start();
if (0 > version_compare(PHP_VERSION, '7')) {
    die('<h1>Für diese Anwendung ' . 'ist mindestens PHP 7 notwendig</h1>');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Image2Food – Sag mir, was ich daraus kochen kann – Upload </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="nav">
    <?php
        @require ("navmitglieder.php");
    ?>
</div>
<div id="content">
    <h1>Upload Fehler</h1>
    <?php
        class UpLoadFehler {
            public function fehler() {
                $meldung = "<h4>Der Upload und die Registrierung der Datei im System hat leider nicht funktioniert.</h4>";
                $meldung .= "<h5>Versuchen Sie es bitte erneut.</h5>";
                echo $meldung;
            }
        }
        $uploadFehlerobj = new UpLoadFehler();
        $uploadFehlerobj->fehler();
    ?>
    <hr>
    <a href='index.php'>Zur Homepage</a>
</div>
</body>
</html>
