<?php
  // ==========================================================================
  // file: FormsException.class.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/5/2021
  // Description: 
  //     Custom exception for when an issue was found when obtaining contact
  //     forms from the database.
  // ==========================================================================

  namespace CustomExceptions;

  // ==== FormsException ======================================================
  // ==========================================================================
  class FormsException extends \Exception {

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
      . '</b><br>Exception Type: FormsException';
      return $errMsg;
    } // end of getErrMsg()

    // ==== End of Method Declarations ========================================
    // ========================================================================

  } // end of FormsException