<?php
 $user = existentaEmail($_SESSION['user']);
 $utilizator = preiaUtilizatorDupaId($user['id']);
?>
<table >
    
    <tr>
        <td>
           <img width="150px" 
             src="imagini_profil/<?php print (!empty($utilizator['poza_profil'])) ? $utilizator['poza_profil'] : 'no_pic_profile.png';?>"
             onerror ="this.onerror=null; this.src='imagini_profil/no_pc_profile.png'"
             />
        </td>
    
    </tr>
</table>
<table id="info">
    
    <tr>
        <th >Nume</th>
        <th >Prenume</th>
        <th >Email</th>
    </tr>
    
    <tr> 
        <td ><?php print $utilizator['nume']?></td>
        <td ><?php print $utilizator['prenume']?></td>
        <td ><?php print $utilizator['email']?></td>
    </tr>
   

</table>

<form method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Imagine profil</td>
            <td><input type="file" id="img" name="img"/></td>
        </tr>
        
        <tr>
            <td>
              <button type="submit" class="btn btn-info" name="incarca">Incarca</button>
            </td>
        </tr>
    </table>
</from>

<form method="post">
    <table>
        <tr>
            <td>Parola actuala</td>
            <td>
                <input  type="password" name="oldPass"/>
            </td>
        </tr>
        <tr>
            <td>Parola noua</td>
            <td>
                <input  type="password" name="newPass"/>
            </td>
        </tr>
        <tr>
            <td>
              <button type="submit" class="btn btn-info" name="actualizeaza">Actualizeaza</button>
            </td>
        </tr>
    </table>
    
</form>
<?php
 $user = existentaEmail($_SESSION['user']);
if (isset($_POST['actualizeaza'])) {
    $parolaNoua = $_POST['newPass'];
    $parolaVeche = $_POST['oldPass'];
    
    if (md5($parolaVeche) === $user['parola'])  {
        $rezActualizare = actualizeazaParola($_SESSION['user'], $parolaNoua);
         print $rezActualizare ? 'Parola actualizata cu succes' : 'Eroare la actualizare';
    } else{
        print 'Parola actuala nu este corecta!';
    }
    }
$phpFileUploadedErrors =  array (0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
);
if (isset($_POST['incarca'])) {
    
    if(isset($_FILES['img'])) {
        if ($_FILES['img']['error'] == 0) {
            
            switch ($_FILES['img']['type']) {
                case 'image/jpg';
                case 'image/jpeg';
                case 'image/png';
                case 'image/bmp';
                case 'image/gif';
                    $numeImg = uniqid() . $_FILES['img']['name'];
                    $salvarePeServer = move_uploaded_file($_FILES['img']['tmp_name'], 'imagini_profil/' . $numeImg);
                    
                    if($salvarePeServer) {
                        $salvareInBD = actualizarePoza($user['id'], $numeImg);
                        if ($salvareInBD) {
                            if(!empty($utilizator['poza_profil'])) {
                                unlink('imagini_profil/' . $utilizator['poza_profil']);
                            }
                               print 'Poza incarcata cu succes!';
                               header ("location: index.php?page=2");
                        } else {
                            unlink ('imagini_profil/' . $numeImg);
                            print 'Nu s-a putut incarca poza!';
                        }
                            
                        
                    } else {
                        print 'Nu s-a putut salva pe server';
                    }
                    break;
                default :
                    print 'Poza nu are un format acceptat';
                    break;
            }
            
        } else {
            print 'Eroare la salvarea imaginii!';
        }
    }
}
