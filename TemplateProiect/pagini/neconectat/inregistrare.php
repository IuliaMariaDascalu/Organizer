<h2>Inregistrare</h2>

<form method="post" id="inreg">
    <table>
        <tr>
            <td>Nume</td>
            <td>
                <input type="text" name="nume"/>
            </td>
        </tr>
        <tr>
            <td>Prenume</td>
            <td>
                <input type="text" name="prenume"/>
            </td>
        </tr>
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
            <button type="submit" class="btn btn-success" name="inregistrare">Inregistrare</button>
            </td>
        </tr>
    </table>
</form>


<?php

if (isset($_POST['inregistrare'])) {
    $email = $_POST['email'];
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $pass = $_POST['pass'];
   
    $rezInregistrare = inregistrareUtilizator($email, $pass, $nume, $prenume, NULL);
  
    if ($rezInregistrare) {
        $_SESSION['user'] = $email;
        $_SESSION['welcome'] = "Bine ai venit $nume $prenume! Iti multumim ca ai ales site-ul nostru! Spor la organizat :)!";
        header('location:index.php');
    } else {
         print '<div style="color: red">Eroare la inregistrare!Incearca inca o data!</div>';
    }
    
}


