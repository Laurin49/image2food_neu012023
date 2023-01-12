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
    <title>Image2Food – Sag mir, was ich daraus kochen kann – Registrierung </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="nav">
        <?php
            @include("nav.php");
            @include("plausi.inc.php");
        ?>
    </div>
    <div id="content">

        <h1>Registrierung</h1>
        <?php
            // Registrierung Formular
            @include("registrieren.inc.php");

            class Registrierung {
                public function registrieren() {
                    if ($this->plausibilisieren()) {
                        $this->eintragen_db();
                    }
                }
                private function plausibilisieren() {
                    // Fehlervariable
                    $anmelden = 0;
                    $p = new Plausi();

                    $anmelden += $p -> namentest($_POST['name']);
                    $anmelden += $p -> namentest($_POST['vorname']);
                    $anmelden += $p -> emailtest($_POST['email']);

                    $anmelden += $p -> nutzerdatentest($_POST['userid']);
                    $anmelden += $p -> nutzerdatentest($_POST['pw']);

                    // Kritische Zeichen auf der freien Eingabe der Zusatzinfos eleminieren
                    $_POST['zusatzinfos'] = preg_replace("/[<|>|$|%|&|§]/", "#", $_POST['zusatzinfos']);

                    // Testausgaben für den derzeitigen Stand des Projekts
                    echo "Die Eingaben: <hr>";
                    print_r($_POST);
                    echo "<br>Fehleranzahl: " . $anmelden . "<hr>";
                    if ($anmelden == 0)
                        return true;
                    else
                        return false;

                }
                private function eintragen_db() {
                    @include("db.inc.php");
                    $sql = "INSERT INTO mitglieder (name, vorname, email, zusatzinfos, rolle, userid, pw)";
                    $sql .= " VALUES (:name, :vorname, :email, :zusatzinfos, :rolle, :userid, :pw)";
                    // echo "SQL: " . $sql . "<br />";
                    $param = [
                        ':name' => $_POST['name'],
                        ':vorname' => $_POST['vorname'],
                        ':email' => $_POST['email'],
                        ':zusatzinfos' => $_POST['zusatzinfos'],
                        ':rolle' => "Mitglied",
                        ':userid' => $_POST['userid'],
                        ':pw' => md5($_POST['pw'])
                    ];
                    try {
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute($param);
                        $_SESSION['name'] = $_POST['userid'];
                        $_SESSION['login'] = false;
                        $dat = "index.php";
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                        $dat = "regfehler.php";
                    }
                    header("Location: $dat");
                }
            }

            $regobj = new Registrierung();
            if (sizeof($_POST) > 0 ) {
                $regobj->registrieren();
            }
        ?>
    </div>
</body>
</html>