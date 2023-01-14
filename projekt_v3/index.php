<?php
session_start();

// Cookie setzen mit Gültigkeitsdauer von 120 Tagen
// 60 Sekunden = 1 Minute, 60 Minuten = 1h => 3600s,  24 h = 1 Tag
$currTime = time();
setcookie("Image2Food", $currTime, $currTime + (3600 * 24 * 120));

if (0 > version_compare(PHP_VERSION, '7')) {
    die('<h1>Für diese Anwendung ' . 'ist mindestens PHP 7 notwendig</h1>');
}

// Eigene Exeption Klasse definieren, Exception erweitern
class MeineAusnahme extends Exception {}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Image2Food – Sag mir, was ich daraus kochen kann – Index </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="nav">
    <?php
        try {
            if (isset($_SESSION["login"]) && ($_SESSION["login"] == "true")) {
                if (!@include("navmitglieder.php")) {
                    throw new MeineAusnahme();
                }
            } else {
                if (!@include("nav.php")) {
                    throw new MeineAusnahme();
                }
            }
        } catch (MeineAusnahme $me) {
            $meldung = "<h2>Image2Food – Sag mir, was ich daraus kochen kann</h2>";
            $meldung .= "<h3>Leider gibt es ein Problem mit der Webseite. ";
            $meldung .= "Wir arbeiten daran mit Hochdruck.</h3> ";
            $meldung .= "<p>Besuchen Sie uns in Kürze wieder neu.</p>";
            die($meldung);
        }
    ?>
</div>
<div id="content">
    <h1>Image2Food – Sag mir, was ich daraus kochen kann</h1>
    <h2>Das soziale, multimediale Netzwerk für Kochideen</h2>
    <?php
    class Index {
        function besucher() {
            if (isset($_SESSION['login']) && $_SESSION['login'] == "true") {
                // Benutzer erfolgreich angemeldet => login
                echo "<div id='indextext'>Sie sind erfolgreich angemeldt.</div>";
                @include("uploadformular.inc.php");
            }
            else if (isset($_SESSION['login']) && $_SESSION['login'] == "false") {
                // Benutzer registriert aber nicht eingeloggt
                $meldung = "<div id='indextext'>Willkommen auf unserer Webseite. <br/>";
                $meldung .= "Sie können sich jetzt zum Migliederbereich anmelden.</div>";
                echo $meldung;
            }
            else if (isset($_COOKIE['Image2Food'])) {
                // Benutzer schon mal auf der Seite, weder registriert noch eingeloggt
                $meldung = "<div id='indextext'>Willkommen <b>zurück</b> auf unserer Webseite. <br/> ";
                $meldung .= "Sie können sich hier registrieren und dann in einem geschlossenen ";
                $meldung .= "Mitgliederbereich anmelden.</div>";
                echo $meldung;
            }
            else {
                // Benutzer unbekannt => Gast
                $meldung = "<div id='indextext'>Willkommen auf unserer Webseite. Schauen Sie sich um. <br/>";
                $meldung .= "Sie können sich hier registrieren und dann ";
                $meldung .= "in einem geschlossenen Mitgliederbereich anmelden.</div>";
                echo $meldung;
            }
        }
    }
    $indexObj = new Index();
    $indexObj->besucher();
    ?>
</div>
</body>
</html>