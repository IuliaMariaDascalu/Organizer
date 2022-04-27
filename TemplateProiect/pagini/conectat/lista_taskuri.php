
<?php
$user = existentaEmail($_SESSION['user']);
$taskuri = preiaTaskDupaUserId ($user['id']);
if (count($taskuri) ==0) {
    print 'Nu exista taskuri/evenimente/remindere!';
     print '<br>';
    ?>
<a href="index.php">Adauga un task</a>
<?php
    return;
}

?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Titlu</th>
      <th scope="col">Data</th>
      <th scope="col">Tip</th>
      <th scope="col">Descriere</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
   <?php foreach($taskuri as $task) {?>
  <tbody>
    <tr>
      
        <td><?php print $task['titlu'];?></td>
        <td><?php print $task['data'];?></td>
        <td><?php print $task['tip'];?></td>
        <td><?php print $task['descriere'];?></td>
        <td><?php if ($task['status'] == 0) { print "in asteptare"; } else { print "terminat"; }?></td>
        <td><a href="index.php?page=1&sterge=<?php print $task['id'];?>">Sterge task</a></td>
        <td><?php if ($task['status'] == 0) {?> <a href="index.php?page=1&termina_task=<?php print $task['id'];?>"> Termina Task</a><?php }?></td>
    </tr>
    
  </tbody>
  <?php } 
    ?>
</table>


<?php 
if (isset($_GET['sterge'])) {
    $id = $_GET['sterge'];
    $stergereBD = stergeTask($id);
    if ($stergereBD) {
        header ('location:index.php?page=1');
    } else {
        print 'Nu s-a putut efectua stergerea!';
    }
}
if (isset($_GET['termina_task'])) {
    $id = $_GET['termina_task'];
    
    $schimbareStatus = schimbaStatus($id, 1 );
    if ($schimbareStatus) {
        header('location:index.php?page=1');
    } else {
        print 'A aparut o eroare!';
    }
}
?>

    
    

