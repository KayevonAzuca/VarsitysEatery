<?php
  // ==========================================================================
  // file: FormsContr.class.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description: This is the Controller of the ContactForm MVC pattern.
  // ==========================================================================

  declare(strict_types = 1);
  namespace ContactForm;

  // ==== FormsContr ==========================================================
  //
  // Provides a way to indirectly interact with the database. 
  //
  // ==========================================================================
  class FormsContr extends FormsModel {

    // ==== Property Declarations =============================================
    // ========================================================================

    // ==== End of Property Declarations ======================================
    // ========================================================================

    // ==== Method Declarations ===============================================
    // ========================================================================

    // ==== uploadForm() ======================================================
    //
    // Upload contact form data to the database.
    //
    // Parameters:
    //   $arr       -- associated array of contact form data
    //
    // Return:
    //   return     -- TRUE if successful upload or FALSE if failed upload
    // ========================================================================
    public function uploadForm(array $arr) {
      return $this->setForm($arr);
    } // end of uploadForm()  

    // ==== downloadForm() ====================================================
    //
    // Download contact form data from the database using a name and email.
    //
    // Parameters:
    //   $name       -- string of a name
    //   $email      -- string of a email
    //
    // Return:
    //   return      -- rows containing matching contact form
    // ========================================================================
    public function downloadForm(string $name, string $email) {
      return $this->getForm($name, $email);
    } // end of downloadForm()

    // ==== chkRecByEmail() ===================================================
    //
    // Call function in Model to obtain the number of contact forms with a
    // certain email.
    // 
    // Parameters:
    //   $email      -- string of a email
    //
    // Return:
    //   return      -- integer that represents the number of rows found
    //   FALSE       -- error found
    // ========================================================================
    public function chkRecByEmail(string $email) {
      try {
        return (int)$this->getRecByEmail($email);
      } catch(Exception $e){
        return FALSE;
      }
    } // end of chkRecByEmail()

      // ==== chkRecByNameEmail() ===================================================
    //
    // Call function in Model to obtain the number of contact forms with a 
    // certain email.
    // 
    // Parameters:
    //   $name       -- string of a name
    //   $email      -- string of a email
    //
    // Return:
    //   return      -- integer that represents the number of rows found
    //   FALSE       -- error found
    // ========================================================================
    public function chkRecByNameEmail(string $name, string $email) {
      try {
        return (int)$this->getRecByNameEmail($name, $email);
      } catch(Exception $e){
        return FALSE;
      }
    } // end of chkRecByNameEmail()
   
    // ==== rmRecByEmail() ===================================================
    //
    // Call function in Model to find and delete the oldest form with a certain
    // email.
    //
    // Parameters:
    //   $email      -- string of a email
    //
    // Return:
    //   return      -- TRUE if row deletion successful
    //   FALSE       -- row deletion failed
    // ========================================================================
    public function rmRecByEmail(string $email) {
      try {
        return $this->delRecByEmail($email);
      } catch(Exception $e){
        return FALSE;
      }
    } // end of rmRecByEmail()

    // ==== End of Method Declarations ========================================
    // ========================================================================

  } // end of FormsContr

  // ==== End of FormsContr ===================================================
  // ==========================================================================