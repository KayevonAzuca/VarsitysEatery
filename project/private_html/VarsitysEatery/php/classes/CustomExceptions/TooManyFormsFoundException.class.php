<?php
  // ==========================================================================
  // file: TooManyFormsFoundException.class.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/5/2021
  // Description: 
  //     Custom exception for when too many contact forms were found in the 
  //     database.
  // ==========================================================================

  namespace CustomExceptions;

  // ==== TooManyFormsFoundException ==========================================
  // ==========================================================================
  class TooManyFormsFoundException extends \Exception {

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
      . '<br><b>Message: ' . $this->getMessage()
      . '</b><br>Exception Type: TooManyFormsFoundException';
      return $errMsg;
    } // end of getErrMsg()

    // ==== getErrCode() =======================================================
    //
    // Return a specific error code that explains the type of error for this
    // class.
    //
    // Parameters:
    //   none
    //
    // Return:
    //   $errMsg    -- detailed error message
    // ========================================================================
    public function getErrCode() {
      return "noService";
    } // end of getErrCode()

    // ==== End of Method Declarations ========================================
    // ========================================================================

  } // end of TooManyFormsFoundException