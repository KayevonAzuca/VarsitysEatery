<?php
  // ==========================================================================
  // file: sendContactForm.inc.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description:
  //    Load the validation file to be used agaisnt the form data. 
  // ==========================================================================

  // ==== Main Execution ======================================================
  //
  // ======== Script Include Check ============================================
  //  * Restrict other scripts from using this script.
  //  * Verify that the script that "include()"s this script has declared
  //    "$sendContactFormHan" as "TRUE".
  //
  // ======== Include Validation File =========================================
  //  * Set the include variable.
  //  * Append the validation file for this script.
  //
  // ==========================================================================

  if(!isset($sendContactFormHan) || !$sendContactFormHan){
    throw new Exception('Script Include Check: Handler variable not found');
  }

  unset($sendContactFormHan);

  $sendContactFormInc = TRUE;
  $validationFullPath = realpath($_SERVER['DOCUMENT_ROOT'] . '/../private_html/VarsitysEatery/php/include/contact_form/validateSendContactForm.inc.php');
  if(file_exists($validationFullPath)){
    include_once($validationFullPath);
  } else {
    throw new Exception('Load Verificaiton File: Could not find validation file');
  }

  // ==== End of Main Execution ===============================================
  // ==========================================================================