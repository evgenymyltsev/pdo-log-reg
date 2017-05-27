<?php
  require_once('connector.php');

  $qKor = 'select * from `pdologger`';

  $pdologger = $con->query($qKor);

  $fKor = $pdologger -> fetchAll(PDO::FETCH_OBJ);

  // echo '<pre>', print_r($fKor), '</pre>'
  ?>
    <table border="1">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>email</th>
      </tr>
  <?php
        foreach($fKor as $k) {
          ?>
            <tr>
              <td>
                <a href="index.php?option=profile&pid= <?php echo $k->id?>">
                  <?php echo $k->id ?>
                </a>
              </td>
              <td>
                <a href="index.php?option=profile&pid= <?php echo $k->id?>">
                  <?php echo $k->user ?>
                </a>
              </td>
              <td>
                <a href="index.php?option=profile&pid= <?php echo $k->id?>">
                  <?php echo $k->name ?>
                </a>
              <td>
                <a href="index.php?option=profile&pid= <?php echo $k->id?>">
                  <?php echo $k->email ?>
                </a>
              </td>
            </tr>
          <?php
        }
      ?>
    </table>
  <?php
