<?php
  // ==========================================================================
  // file: getMenu.han.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description:
  //     Handle JavaScript's "fetch()" request to obtain the JSON file
  //     containing the food menu.
  // ==========================================================================

  // ==== Main Execution ======================================================
  //
  // ======== Form Data Check =================================================
  //  * Make sure certain "$_POST[]" data is set/not set before "include()"ing
  //    the code that will validate and download the contact form(s).
  //
  // ======== Load Include File ===============================================
  //  * Set the handler variable.
  //  * Append the include file for this script.
  //
  // ==========================================================================

  try {
    $getMenuHan = TRUE;
    $includeFullPath = realpath($_SERVER['DOCUMENT_ROOT'] . '/../protected_html/php/include/getMenu.inc.php');
    if(file_exists($includeFullPath)){
      include_once($includeFullPath);
    } else {
      throw new Exception('Load Include File: Could not find include file');
    }
  } catch(Exception $e) {
    echo(json_encode(
      array(
        'form' => 'noService',
        'name' => 'defaultName',
        'email' => 'defaultEmail'
      )
    ));
    exit();
  }

  // ==== End of Main Execution ===============================================
  // ==========================================================================