<form action="registrieren.php" method="post">
    <label class="reg_label">Name</label><span class="pflichtmarker"> * </span>
    <input name="name" maxlength="30"
        <?php
        if (isset($_POST['name']))
            echo "value='" . $_POST['name'] . "'";
        ?>
    />
    <br>
    <label class="reg_label">Vorname</label><span class="pflichtmarker"> * </span>
    <input name="vorname" maxlength="30"
        <?php
        if (isset($_POST['vorname']))
            echo "value='" . $_POST['vorname'] . "'";
        ?>
    />
    <br>
    <label class="reg_label">E-Mail</label><span class="pflichtmarker"> * </span>
    <input name="email" maxlength="30"
        <?php
        if (isset($_POST['email']))
            echo "value='" . $_POST['email'] . "'";
        ?>
    />
    <br>
    <label class="reg_label">Userid</label><span class="pflichtmarker"> * </span>
    <input name="userid"  maxlength="20"/>
    <br>
    <label class="reg_label">Passwort</label><span class="pflichtmarker"> * </span>
    <input name="pw" type="password"  maxlength="50"/>
    <br>
    <label class="reg_label">Zusatzinfos</label><span class="pflichtmarker"> </span>
    <textarea name="zusatzinfos" rows="5" cols="30"><?php
        if (isset($_POST['zusatzinfos']))
            echo $_POST['zusatzinfos'];
        ?></textarea>
    <br>
    <br>
    <img src="captchagenerieren.php" alt="Captcha"><br>
    <label class="reg_label">Captcha</label>
    <span class="pflichtmarker"> * </span>
    <input name="captcha">
    <br>
    <input type="submit">
</form>