<?php
class Plausi {
    public function namentest($wert) {
        if (preg_match("/^\w{2,30}$/", $wert)) {
            return 0;
        } else {
            return 1;
        }
    }
    public function emailtest($wert) {
        $fehler = 0;
        // Test notwendige E-Mail-Struktur
        if (!preg_match("/\w+@\w+\.\w{2}/", $wert)) {
            $fehler++;
        }
        // nichtalphanumerische Zeichen - außer dem Zeichen @
        if (preg_match("/\W/", $wert, $ergarray)) {
            if ($ergarray[0] != "@")
                $fehler++;
        }
        return $fehler;
    }
    public function nutzerdatentest($wert) {
        $fehler = 0;
        if (!preg_match("/^\w{8,20}$/", $wert)) {
            $fehler++;
        }
        // Keine Zahl
        if (!preg_match("/\d/", $wert)) {
            $fehler++;
        }
        // Kein Großbuchstabe
        if (!preg_match("/[A-Z]/", $wert)) {
            $fehler++;
        }
        // Kein Kleinbuchstabe
        if (!preg_match("/[a-z]/", $wert)) {
            $fehler++;
        }
        return $fehler;
    }
}