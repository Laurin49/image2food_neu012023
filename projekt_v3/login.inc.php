<form action="login.php" method="post">
    <label class="reg_label">Userid</label>
    <span class="pflichtmarker"> * </span>
    <input name="userid" maxlength="20"	/>
    <span class="fehlermeldung"></span>
    <br>
    <label class="reg_label">Passwort</label>
    <span class="pflichtmarker"> * </span>
    <input name="pw"  type="password"  maxlength="50"/>
    <span class="fehlermeldung"></span>
    <br>
    <img src="captchagenerieren.php" alt="Captcha"><br>
    <label class="reg_label">Captcha</label>
    <span class="pflichtmarker"> * </span>
    <input name="captcha">
    <br>
    <input type="submit">
</form>
