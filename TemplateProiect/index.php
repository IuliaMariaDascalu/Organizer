<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once 'functii/sql_functions.php';
//var_dump(conectareUtilizator('elena@2.ro', '123')); die();

session_start();
if (isset($_POST['conectare'])) {
    $email = $_POST['email'];
    $parola = $_POST['pass'];
    
    $rezConectare = conectareUtilizator($email, $parola);
    if ($rezConectare) {
        if (isset($_SESSION['fail_login'])) {
            unset($_SESSION['fail_login']);
        }
        $_SESSION['user'] = $email;
    } else {
        $_SESSION['fail_login'] = 'Eroare la conectare!Verifica credentialele!';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    
    <body>
        <header id="banner"></header>
        <?php
        //momentan comentati/decomentati unul din template-uri in functie de sectiunea la care vreti sa lucrati
            if (isset($_SESSION['user'])) {
            require_once 'templates/template_conectat.php';
        }else {
            require_once 'templates/template_neconectat.php';
        }
        ?>
        <footer id="subsol">&COPY;Agenda ta</footer>
    </body>
</html>
