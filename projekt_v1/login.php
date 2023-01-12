<?php
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
        require("nav.php");
        require ("plausi.inc.php");
    ?>
</div>
<div id="content">
    <h1>Login</h1>
    <?php
        require('login.inc.php');   // Formular Login

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