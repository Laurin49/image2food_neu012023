<?php
// Start der Session
session_start();

// Festlegung der Untergrenze für die PHP-Version
if (0 > version_compare(PHP_VERSION, '7')) {
    die('<h1>Für diese Anwendung ' . 'ist mindestens PHP 7 notwendig</h1>');
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Image2Food – Sag mir, was ich daraus kochen kann – Registrierung </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="nav">
    <?php
        @include("nav.php");
    ?>
</div>
<div id="content">
    <h1>Registrierung - Fehler</h1>
    <?php
    // Registrierung Formular
    @include("registrieren.inc.php");

    class RegFehler {
        public function fehler() {
            $msg = "<h4>Die Registrierung hat leider nicht funktioniert.</h4>";
            $msg .= "<h5>Wählen Sie eine andere Userid und versuchen Sie es erneut.</h5>";
            echo $msg;
        }
    }
    $regobj = new RegFehler();
    $regobj->fehler();
    ?>
</div>
</body>
</html>
