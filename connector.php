<?php
  try {
    $con = new PDO('mysql:host=localhost;dbname=simpledata', 'root', '');
    $con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOexception $e){
    echo $e->getMessage();
    die();
  }
?>
