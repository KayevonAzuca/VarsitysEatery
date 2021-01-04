<?php
    if(isset($_POST['submit'])){
      $hdlGetContactForm = TRUE;
      define('ROOT', realpath($_SERVER['DOCUMENT_ROOT'] . '/../'));
      include_once(realpath(ROOT . '/private_html/VarsitysEatery/php/include/validateGetContactForm.inc.php'));
    } else {
      header("Location: /contact.php");
      exit();
    }
?>