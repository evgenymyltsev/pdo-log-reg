<?php
  session_start();

  require_once('connector.php');
  if(isset($_SESSION['id'])) {
    ?>
      <a href="index.php">Main</a> |
      <a href="index.php?option=list">list</a> |
      <a href="index.php?option=profile">Profile</a> |
      <a href="index.php?option=logout">logout</a><hr>
    <?php
    if(isset($_GET['option'])) {
      $file = $_GET['option'] .'.php';
      if(file_exists($file)) {
        include_once($file);
      } else {
        echo 'page doesn`t exist. please go to <a href="index.php">Main</a>';
      }
    } else {

    }
  } else {
    ?>
      <a href="index.php">Main</a> |
      <a href="index.php?option=register">registration</a> |
      <a href="index.php?option=login">login</a> <hr>
    <?php
    if(isset($_GET['option'])) {
      $file = $_GET['option'] .'.php';
      if(file_exists($file)) {
        include_once($file);
      } else {
        echo 'page doesn`t exist. please go to <a href="index.php">Main</a>';
      }
    } else {
      include_once('login.php');
      include_once('register.php');
    }
  }
?>
