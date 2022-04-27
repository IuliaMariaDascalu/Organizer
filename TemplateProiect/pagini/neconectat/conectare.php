<h1>Conectare</h1>

<form method="post" id="conect">
    <table>
        <tr>
            <td>Email</td>
            <td>
                <input type="email" name="email"/>
            </td>
        </tr>
        <tr>
            <td>Parola</td>
            <td>
                <input type="password" name="pass"/>
            </td>
        </tr>
        <tr>
            <td>
            <button type="submit" class="btn btn-primary"  name="conectare">Conectare</button>
            </td>
        </tr>
    </table>
</form>

<?php
if (isset($_SESSION['fail_login'])) {
    print $_SESSION['fail_login'];
}

