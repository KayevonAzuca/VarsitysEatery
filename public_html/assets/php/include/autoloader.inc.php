<?php
  spl_autoload_register('myAutoLoader');

  function myAutoLoader($className) {
    $path = realpath($_SERVER['DOCUMENT_ROOT'] . '/../') . "/private_html/VarsitysEatery/php/classes/";
    $ext = ".class.php";
    $fullPath = $path . $className . $ext;

    if(!file_exists($fullPath)){
      return FALSE;
    }
    
    include_once($fullPath);
  } // end of "myAutoLoader()"
?>