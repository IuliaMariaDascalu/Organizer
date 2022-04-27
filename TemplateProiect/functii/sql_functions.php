<?php

function conectareBD ($host = 'localhost',
                      $user = 'root',
                      $password = '',
                      $database = 'agenda') 
{
    return mysqli_connect($host, $user, $password, $database);
}

function clearData ($input, $link)
{
    $input = trim ($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = mysqli_real_escape_string($link, $input);
    
    return $input;
}

//verific daca exista email-ul in baza de date

function existentaEmail ($adrEmail) 
{
    $link = conectareBD();
    $query = "SELECT * FROM utilizator WHERE email = '$adrEmail'";
    
    $rezultat = mysqli_query($link, $query);
    $utilizator = mysqli_fetch_array($rezultat);
    
    return $utilizator;
}

//functie de inregistrare a utilizatorului

function inregistrareUtilizator ($email, $parola, $nume, $prenume, $pozaProfil)
{
   $link = conectareBD();
   $email = clearData($email, $link);
   $parola = clearData($parola, $link);
   $nume = clearData($nume, $link);
   $prenume = clearData($prenume, $link);
   $parola = md5($parola);
   
   $utilizator = existentaEmail($email);
   if ($utilizator) {
       return false;
   }
   $query = "INSERT INTO utilizator VALUES(NULL, '$nume', '$prenume', '$email', '$parola', NULL)";
   
   $rezultat = mysqli_query($link, $query);
   return $rezultat;
   
}

//functie pentru conectarea utilizatorului

function conectareUtilizator ($email, $parola) {
    $link = conectareBD();
    $email = clearData($email, $link);
    $parola = clearData($parola, $link);
    
    $user = existentaEmail($email);
     if ($user){
         if (md5($parola) === $user['parola']) {
              return true;
          } else {
              return false;
          }
     }
     return false;
}

function actualizeazaParola ($email, $newPass) {
    $link = conectareBD();
    
    $newPass = clearData($newPass, $link);
    $newPass = md5($newPass);
    
    $query = "UPDATE utilizator  SET parola = '$newPass' WHERE  email ='$email'";
    return mysqli_query($link, $query);
}

function adaugaTask ($userId, $titlu, $data, $tip, $descriere, $status = 0) 
{
    $link = conectareBD();
    $titlu = clearData($titlu, $link);
    $desciere = clearData($descriere, $link);
    
    $query = "INSERT INTO task VALUES(NULL, $userId, '$titlu', '$data', '$tip', '$descriere', 0)";
    //var_dump($query);die();
    return mysqli_query($link, $query);
}



function stergeTask ($id) 
{
    $link = conectareBD();
    $id = clearData($id, $link);
    
    $query = "DELETE FROM task WHERE id = '$id'";
    return mysqli_query($link, $query);
}

function preiaUtilizatorDupaId ($id)
{
    $link = conectareBD();
    $id = clearData($id, $link);
    $query = "SELECT * FROM utilizator WHERE id = '$id'";
    
    $rez = mysqli_query($link, $query);
    $utilizator = mysqli_fetch_array($rez, MYSQLI_ASSOC);
    
    return $utilizator;
}

function actualizarePoza ($id, $img) 
{
    $link = conectareBD();
    $img = clearData($img, $link);
    
    $query = "UPDATE utilizator SET poza_profil = '$img' WHERE id='$id'";
    return mysqli_query($link, $query);
                
}
function preiaTask () 
{
    $link = conectareBD();
    $query = "SELECT * FROM task";
    
   $rezultat = mysqli_query($link, $query);
   $taskuri = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
   return $taskuri;
}

function preiaTaskDupaUserId ($idUser)
{
    $link = conectareBD();
    $query = "SELECT * FROM task WHERE id_user = $idUser";
    
    $rezultat = mysqli_query($link, $query);
    $taskuri = mysqli_fetch_all($rezultat, MYSQLI_ASSOC);
    
    return $taskuri;
}

function schimbaStatus ($id, $status)
{
    $link = conectareBD();
    $query = "UPDATE task SET status = $status WHERE id = $id";
    
    return mysqli_query($link, $query);

}