<?php
  require_once('connector.php');

  $err = '';

  if(isset($_POST['submit'])) {
    if ( !empty($_POST['user']) ) {
      $qUserName = 'select * from `pdologger`
                    where `user` = :user';
      $pdologger = $con->prepare($qUserName);
      $pdologger->execute(array(
        ':user' => $_POST['user']
      ));

      if( $pdologger->rowCount() == 1) {

      } else if ($pdologger -> rowCount() >= 2){
        $err .= 'Error <br>';
      } else {
        $err .= 'User not found';
      }
    } else {
      $err .= 'Enter Username <br>';
    }

    if (!empty($_POST['pass'])) {
      if(isset($_POST['user'])) {
        $qAcount = 'select *from `pdologger`
                    where `user` = :user
                    and `password` = :pass';
      }
      $pdologger = $con->prepare($qAcount);
      $pdologger->execute(array(
        ':user' => $_POST['user'],
        ':pass' => md5($_POST['pass'])
      ));
      if( $pdologger->rowCount() == 1) {
        echo 'hello';
      } else if ($pdologger -> rowCount() >= 2){
        $err .= 'Something went wrong<br>';
      } else {
        $err .= 'Check password';
      }
    } else {
      $err .= 'Enter password <br>';
    }

    if($err == '') {
      echo 'Hi';
      $qLog = $pdologger->fetchAll(PDO::FETCH_OBJ);
      foreach($qLog as $acount) {
        $nalog = $acount -> id;
      }
      $_SESSION['id'] = $nalog;
      header('Location:index.php');
    } else {
      echo $err;
    }
  }
?>
<form class="" action="index.php?option=login" method="post">
  <table>
    <tr>
      <td>Username</td>
      <td>
        <input type="text" name="user" value="">
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td>
        <input type="password" name="pass" value="">
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" name="submit" value="Войти">
      </td>
    </tr>
  </table>
</form>
