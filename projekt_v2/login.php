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
    <h1>Login</h1>
    <?php
        @include('login.inc.php');   // Formular Login

        class Login {
            public function _login() {
                if ($this->plausibilisieren()) {
                    $this->anmelden_db();
                }
            }
            private function plausibilisieren() {
                $anmelden = 0;                  // Fehlervariable

                $p = new Plausi();
                $anmelden += $p->nutzerdatentest($_POST['userid']);
                $anmelden += $p->nutzerdatentest($_POST['pw']);

                // Testausgaben
                echo "Ihre Eingaben: <hr>";
                print_r($_POST);
                echo "<br>Fehleranzahl: " . $anmelden . "<hr>";
                if ($anmelden == 0)
                    return true;
                else
                    return false;
            }
            private function anmelden_db() {
                @include("db.inc.php");
                $vorhanden = false;

                if ($stmt = $pdo -> prepare("SELECT userid, pw FROM mitglieder")) {
                    $stmt -> execute();
                    while ($row = $stmt -> fetch()) {
                        if (isset($_POST["userid"])
                            && $_POST["userid"] == $row['userid']
                            && md5($_POST["pw"]) == $row['pw']) {
                            $vorhanden = true;
                            break;
                        }
                    }
                }
                if ($vorhanden) {
                    $_SESSION["name"] = $_POST["userid"];
                    $_SESSION["login"] = "true";
                    $dat = "index.php";
                } else {
                    $dat = "loginfehler.php";
                }
                header("Location: $dat");
            }
        }
        $loginObj = new Login();
        if (sizeof($_POST) > 0 ) {
            $loginObj->_login();
        }
    ?>
</div>
</body>
</html>