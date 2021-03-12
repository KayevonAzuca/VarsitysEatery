<?php
  // ==========================================================================
  // file: getSecretArt.han.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 2/4/2021
  // Description: Handle Javascript's data request.
  // ==========================================================================

  // ==== Main Execution ======================================================
  // ==========================================================================

  try {
    $getSecretArtHan = TRUE;
    include_once(realpath($_SERVER['DOCUMENT_ROOT'] . '/../protected_html/VarsitysEatery/php/include/getSecretArt.inc.php'));
  } catch (Exception $e) {
    exit();
  }
  
  // ==== End of Execution ====================================================
  // ==========================================================================
?>