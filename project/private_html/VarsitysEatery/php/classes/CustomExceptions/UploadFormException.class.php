<?php
  // ==========================================================================
  // file: UploadFormException.class.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/5/2021
  // Description: 
  //     Custom exception thrown when a contact form being uploaded to a
  //     database failed.
  // ==========================================================================

  namespace CustomExceptions;
  
  // ==== UploadFormException =================================================
  // ==========================================================================
  class UploadFormException extends \Exception {
    
    // ==== Property Declarations =============================================
    // ========================================================================

    // ==== End of Property Declarations ======================================
    // ========================================================================

    // ==== Method Declarations ===============================================
    // ========================================================================

    // ==== getErrMsg() =======================================================
    //
    // Create and return a more detailed error message.
    //
    // Parameters:
    //   none
    //
    // Return:
    //   $errMsg    -- detailed error message
    // ========================================================================
    public function getErrMsg() {
      $errMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
      . '<br><b>' . $this->getMessage() . ' </b><br>' . 'Upload Form Exception';
      return $errMsg;
    } // end of getErrMsg()
  } // end of UploadFormException
?>