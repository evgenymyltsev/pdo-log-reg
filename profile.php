<?php
  if(isset($_GET['pid'])) {
    $qKor = 'select * from `pdologger`
             where `id` = :id'; //?????
    $profile = $con -> prepare($qKor);
    $profile -> execute(array(
      ':id' => $_GET['pid']
    ));
  } else {
    $qKor = 'select * from `pdologger`
             where `id` = :id'; //?????
    $profile = $con -> prepare($qKor);
    $profile -> execute(array(
      ':id' => $_SESSION['id']
    ));
  }

  if(isset($_SESSION['id'])) {
    if($profile->rowCount()) {
      $fetchProf = $profile -> fetchAll(PDO::FETCH_OBJ);
      foreach($fetchProf as $p) {
        echo '<h3>'. $p->name .'</h3>';
        echo '<img src="'. $p->avatar .'" width="200" /> <br>';
        echo $p -> user .'<br>';
        echo $p -> email .'<br>';
      }
    } else {
      echo 'User not found';
    }
  } else {
    echo 'You do not have permission';
  }
?>
