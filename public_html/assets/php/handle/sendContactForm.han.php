<?php
    if(isset($_POST['submit'])){
      $hdlSendContactForm = TRUE;
      define('ROOT', realpath($_SERVER['DOCUMENT_ROOT'] . '/../'));
      include_once(realpath(ROOT . '/private_html/VarsitysEatery/php/include/validateSendContactForm.inc.php'));
    } else {
      header("Location: /contact.php");
      exit();
    }
?>