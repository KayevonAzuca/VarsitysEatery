<?php
  // ==========================================================================
  // file: getSecretArt.inc.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description: 
  // ==========================================================================

  // ==== Script Execution Check ==============================================
  //
  // Hard-coded script execution toggle.
  //
  // ==========================================================================

  if(FALSE){exit();}

  // ==== End of Script Execution Check =======================================
  // ==========================================================================

  // ==== Script Include Check ================================================
  //
  // Restrict other scripts from using this script.
  // Verify that the script that "include()"s this script has declared
  // a handle variable as "TRUE".
  //
  // ==========================================================================

  if(!isset($getSecretArtHan) || !$getSecretArtHan) {
    throw new Exception('Script Include Check: Could not find handler variable');
  }

  unset($getSecretArtHan);

  // ==== End of Script Include Check =========================================
  // ==========================================================================

  // ==== Main Execution ======================================================
  // ==========================================================================

  header("Content-Type: image/jpeg");
  $pic = file_get_contents(realpath($_SERVER['DOCUMENT_ROOT'] . '/../protected_html/images/secretArt.png'));
  if($pic){
    echo($pic);
  } else {
    throw new Exception('Main Execution: No secret found');
  }

  // ==== End of Main Execution ===============================================
  // ==========================================================================
?>