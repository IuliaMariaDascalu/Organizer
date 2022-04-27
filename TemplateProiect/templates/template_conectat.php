<!--meniu cu adaugare task, lista taskuri, vizualizare profil, deconectare
sablonare pt paginile din meniu, nu intra si deconectare aici la sablonare -->

<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index.php">Adaugă task</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="index.php?page=1">Listă taskuri</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active " href="index.php?page=2">Vizualizare profil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="index.php?deconectare">Deconectare</a>
  </li>
</ul>
<?php

if (isset($_GET['deconectare'])) {
    session_destroy();
    header('location:index.php');
}

if (isset( $_SESSION['welcome'])) {
    print $_SESSION['welcome'];
    unset ($_SESSION['welcome']);
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    
    switch ($page) {
        case 1:
            require_once 'pagini/conectat/lista_taskuri.php';
            break;
        case 2:
            require_once 'pagini/conectat/vizualizare_profil.php';
            break;
        default:
            require_once 'pagini/eroare.php';
            break;
    } 
} else {
     require_once 'pagini/conectat/adaugare_task.php';  
}


