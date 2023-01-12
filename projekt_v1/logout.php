<?php
// Start der Session
session_start();
// Logout-Klasse
class Off {
    function ausloggen() {
        session_destroy();
        $dat = "index.php";
        header("Location: $dat");
    }
}

$obj = new Off();
$obj->ausloggen();