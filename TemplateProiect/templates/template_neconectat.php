<nav class="nav flex-column">
  <a class="nav-link" href="index.php"><i class="fa fa-calendar" style="font-size:24px"></i>Despre</a>
  <a class="nav-link" href="index.php?page=1"><i class="fa fa-address-book" style="font-size:24px"></i>Conectare</a>
  <a class="nav-link" href="index.php?page=2"><i class="fa fa-address-card" style="font-size:24px"></i>Inregistrare</a>
  
</nav>
<section id="continut">
<?php
 if (isset($_GET['page'])) {
     $page = $_GET['page'];
     
     switch ($page) {
         case 1:
             require_once 'pagini/neconectat/conectare.php';
             break;
         case 2:
             require_once 'pagini/neconectat/inregistrare.php';
             break;
         default:
             require_once 'pagini/eroare.php';
             break;
     }
     
 } else {
     require_once 'pagini/neconectat/despre.php';
 }

?>
</section>
