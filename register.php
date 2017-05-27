<?php
  require_once('connector.php');

  $err = '';

  if(isset($_POST['submit'])) {
    if (!empty($_POST['user'])) {
      $qUserName = 'select * from `pdologger` where `user` = :user';
      $pdologger = $con->prepare($qUserName);
      $pdologger->execute(array(
        ':user' => $_POST['user']
      ));
      if($pdologger->rowCount()) {
        $err .='- Username already exist <br>';
      } else {
        $user = $_POST['user'];
      }
    } else {
      $err .= 'Enter Username <br>';
    }

    if (!empty($_POST['pass'])) {

    } else {
      $err .= 'Enter password <br>';
    }

    if (!empty($_POST['repass'])) {

    } else {
      $err .= 'Enter your password again  <br>';
    }

    if(!empty($_POST['pass']) && !empty($_POST['repass'])) {
      if($_POST['pass'] == $_POST['repass']) {
        $password = md5($_POST['pass']);
      } else {
        $err .='- Wrong password.';
      }
    }

    if (!empty($_POST['name'])) {
      $name = $_POST['name'];
    } else {
      $err .= 'Enter your name <br>';
    }

    if (!empty($_POST['email'])) {
      $qUserName = 'select * from `pdologger` where `email` = :email';
      $pdologger = $con->prepare($qUserName);
      $pdologger->execute(array(
        ':email' => $_POST['email']
      ));
      if($pdologger->rowCount()) {
        $err .='- email already exist <br>';
      } else {
        $email = $_POST['email'];
      }
    } else {
      $err .= 'Enter your email <br>';
    }

    if(!empty($_FILES['avatar']['tmp_name'])) {
      $folder = 'profile/';
      $folder = $folder . basename($_FILES['avatar']['name']);

      $tmpNaziv = $_FILES['avatar']['tmp_name'];

      $delovi_naziva = pathinfo($_FILES['avatar']['name']);
      $extenzija = $delovi_naziva['extension'];

      $prva = rand(1, 100000);
      $druga = rand(1, 100000);
      $treca = rand(1, 100000);

      $slucajni_naziv = $prva .'-'. $druga .'-'. $treca .'.'.$extenzija;

      $konacno = 'profile/'.$slucajni_naziv;
    } else {
      $err .= 'Choose file';
    }

    if ($err <> "") {
      echo $err;
    } else {
      if (move_uploaded_file($tmpNaziv, $konacno)) {
        $qk = '
          insert into `pdologger`
          set `user` = :user,
              `password` = :password,
              `name` = :name,
              `email` = :email,
              `avatar` = :avatar
        ';

        $k = $con -> prepare($qk);
        $k -> execute (array(
          ':user' => $user,
          ':password' => $password,
          ':name' => $name,
          ':email' => $email,
          ':avatar' => $konacno
        ));
      } else {
        $qk = '
          insert into `pdologger`
          set `user` = :user,
              `password` = :password,
              `name` = :name,
              `email` = :email,
              `avatar` = :avatar
        ';

        $k = $con -> prepare($qk);
        $k -> execute (array(
          ':user' => $user,
          ':password' => $password,
          ':name' => $name,
          ':email' => $email,
          ':avatar' => 'profile/orfeya.png'
        ));
      }

      echo 'Успешно зарегистрировались';
      header('Location:index.php');
    }
  }

?>

<form class="" action="index.php?option=register" method="post" enctype="multipart/form-data">
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
      <td>RePassword</td>
      <td>
        <input type="password" name="repass" value="">
      </td>
    </tr>
    <tr>
      <td>Name</td>
      <td>
        <input type="text" name="name" value="">
      </td>
    </tr>
    <tr>
      <td>email</td>
      <td>
        <input type="text" name="email" value="">
      </td>
    </tr>
    <tr>
      <td>Avatar</td>
      <td>
        <input type="file" name="avatar" id="avatar">
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" name="submit" value="Register">
      </td>
    </tr>
  </table>
</form>
