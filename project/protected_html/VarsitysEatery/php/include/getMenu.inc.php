<?php
  // ==========================================================================
  // file: getMenu.inc.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description: Load and echo the menu.json file
  // ==========================================================================

  // ==== Script Include Check ================================================
  //
  // Restrict other scripts from using this script.
  // Verify that the script that "include()"s this script has declared
  // a handle variable as "TRUE".
  //
  // ==========================================================================

  if(!isset($getMenuHan) || !$getMenuHan) {
    throw new Exception('Script Include Check: Could not find handler variable');
  }

  unset($getMenuHan);

  // ==== End of Script Include Check =========================================
  // ==========================================================================

  // ==== Main Execution ======================================================
  // ==========================================================================

  header('Content-Type: application/json');

  // Get JSON food menu & echo its contents
  $menuFullPath = realpath($_SERVER['DOCUMENT_ROOT'] . '/../protected_html/VarsitysEatery/json/menu.json');
  if(file_exists($menuFullPath)){
    $menuJSON = file_get_contents($menuFullPath, TRUE);
    echo($menuJSON);
  } else {
    throw new Exception('Script Setup: JSON menu file not found');
  }

  // ==== End of Main Execution ===============================================
  // ==========================================================================