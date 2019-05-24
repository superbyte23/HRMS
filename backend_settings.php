
<?php

include 'includes/config.php';

  if (isset($_POST)) {
    $id = $_POST['id'];
    $value = $_POST['value'];

    switch ($value) {
      case '1':
        $value = '0';
        break;

      case '0':
        $value = '1';
        break;

      default:
        # code...
        break;
    }
    $sql =mysqli_query($conn, "UPDATE `settings` SET `value`= '$value'  WHERE `id` = '$id'");
    
  }

?>

