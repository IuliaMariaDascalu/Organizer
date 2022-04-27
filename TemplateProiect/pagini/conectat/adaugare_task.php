<?php
$user = existentaEmail($_SESSION['user']);
?>

<h1>Adauga urmatorul tau eveniment/task/reminder!</h1>
<form method="post">
    <table>
        <tr>
            <td><label for="titlu">Titlu</label></td>
            <td> <input type="text" name="titlu"/></td>
        </tr>
        <tr>
             <td><label for="data">Data</label></td>
            <td><input type="date" name="data"/></td>
        </tr>
        <tr>
             <td><label for="tip">Tip</label></td>
        <td>
            <select name="tip">
                <option value="1">Task</option>
                <option value="2">Eveniment</option>
                <option value="3">Reminder</option>
            </select>
        </td>
        </tr>
        <tr>
             <td><label for="descriere">Descriere</label></td>
            <td> <input type="text" name="descriere"/></td>
        </tr>
        <tr>
            <td><button type="submit" class="btn btn-dark" name="adauga">Adauga</button></td>
        </tr>
    </table>
    
</form>
<?php

if (isset($_POST['adauga'])) {
    $titlu = $_POST['titlu'];
    $data = $_POST['data'];
    $tip = $_POST['tip'];
    $descriere = $_POST['descriere'];

    $adaugareInBD = adaugaTask ($user['id'], $titlu, $data, $tip, $descriere);
    
    if ($adaugareInBD) {
        print 'Adaugat cu succes';
    } else {
        print 'Nu s-a putut efectua adaugarea';
    }
}
