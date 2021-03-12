<?php
  // ==========================================================================
  // file: autoloader.inc.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description: Automatically "include()" any classes that are referenced.
  // ==========================================================================

  spl_autoload_register('autoloadClass');

  // ==== autoloadClass() =====================================================
  //
  // Attempt to "include()" a class file if it exists.
  //
  // Parameters:
  //   $className   -- name of the desired class
  //
  // Return:
  //   FALSE        -- the class file does not exist
  // ==========================================================================
  function autoloadClass($className) {
    $path = $_SERVER['DOCUMENT_ROOT'] . "/../private_html/VarsitysEatery/php/classes/";
    $ext = ".class.php";
    $fullPath = realpath($path . $className . $ext);

    if(!file_exists($fullPath)){
      return FALSE;
    }
    
    include_once($fullPath);
  } // end of "autoloadClass()"