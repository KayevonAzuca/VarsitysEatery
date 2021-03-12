<?php
  // ==========================================================================
  // file: validateGetContactForm.inc.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description:
  //     Validate inputs from a contact form before downloading contactforms
  //     from database.
  // ==========================================================================

  // ==== Script Include Check ================================================
  //
  // Restrict other scripts from using this script.
  // Verify that the script that "include()"s this script has declared
  // "$getContactFormInc" as "TRUE".
  //
  // ==========================================================================

  if(!isset($getContactFormInc) || !$getContactFormInc) {
    throw new Exception('Script Include Check: Include variable not found');
  }

  unset($getContactFormInc);

  // ==== End of Script Include Check =========================================
  // ==========================================================================

  // ==== Function Declarations ===============================================
  // ==========================================================================

  // ==== chkFlags() ==========================================================
  //
  // Recieve an associated array and check values for "FALSE". 
  //
  // Parameters:
  //   $arr      -- associated array with "TRUE" or "FALSE" values
  //
  // Return:
  //   TRUE      -- no "FALSE" value was found in the array
  //   FALSE     -- at least one "FALSE" value was found in the array
  //
  // ==========================================================================
  function chkFlags($arr) {
    foreach($arr as $flag) {
      if(!$flag) {
        return FALSE;
      }
    }
    return TRUE;
  } // end of chkFlags()

  // ==== cleanInput() ========================================================
  //
  // Clean input for potential whitespace, quotes, and/or other special
  // special characters/malicious code.
  //
  // Parameters:
  //   $data         -- string/text input from a contact form
  //
  // Return:
  //   $data         -- sanitized string/text
  //
  // ==========================================================================
  function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  } // end of cleanInput()

  // ==== End of Function Declarations ========================================
  // ==========================================================================

  // ==== Variable Declarations ===============================================
  // ==========================================================================

  $inputFlags = array(
    'name' => FALSE,
    'email' => FALSE
  );

  $inputCodes = array(
    'form' => NULL,
    'name' => NULL,
    'email' => NULL,
    'data' => NULL,
  );

  // ==== End of Variable Declarations ========================================
  // ==========================================================================

  try {

    // ==== Script Setup ======================================================
    //
    // Make sure this script has all resources needed to execute:
    // Find and "include()" the class autoloader.
    //
    // ========================================================================

    header('Content-Type: application/json');

    // Get & load the class auto loader
    $autoLoaderFullPath = $_SERVER['DOCUMENT_ROOT'] . '/../private_html/VarsitysEatery/php/include/autoloader.inc.php';
    if(file_exists($autoLoaderFullPath)){
      include_once($autoLoaderFullPath);
    } else {
      throw new Exception('Script Setup: Autoloader not found');
    }

    unset($autoLoaderFullPath);

    // ==== End of Script Setup ===============================================
    // ========================================================================

    // ==== Obtain User Inputs ================================================
    //
    // Get and save form data that contains contact form inputs. 
    // Use "cleanInput()" to strip potential malicious characters.
    //
    // ========================================================================

    // Obtain text input of a name
    $name = cleanInput($_POST['name']);
    // Obtain text input of an email
    $email = cleanInput($_POST['email']);

    // ==== End of Obtain User Inputs =========================================
    // ========================================================================

    // ==== User Input Validation =============================================
    //
    // Validate all contact form inputs and set appropriate code & flags that
    // represent the input's current status.
    //
    // ========================================================================

    // Validate name
    if(empty($name)){
      $inputCodes['name'] = 'noName';
    } elseif(!preg_match("/^[a-zA-Z]{2,}[\s]{0,1}[a-zA-Z]{0,}[\s]{0,1}[a-zA-Z]{0,}$/", $name)){
      $inputCodes['name'] = 'notName';
    } elseif(strlen($name) > 20){
      $inputCodes['name'] = 'lenName';
    } else {
      $inputFlags['name'] = TRUE;
      $inputCodes['name'] = 'validName';
    }

    // Validate email
    if(empty($email)){
      $inputCodes['email'] = 'noEmail';
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $inputCodes['email'] = 'notEmail';
    } else {
      $inputFlags['email'] = TRUE;
      $inputCodes['email'] = 'validEmail';
    }

    // ==== End of User Input Validation ======================================
    // ========================================================================

    // ==== Accept or Reject Form =============================================
    //
    // Check if any values in "$inputFlags" are "FALSE". If so echo the
    // "$inputCodes" back to JavaScript's "fetch()" so it can adjust the form
    // interface for the user to correct the necessary inputs. Otherwise,
    // attempt to upload the form data to the database using the ContactForm
    // MVC pattern.
    //
    // ========================================================================

    // Upload data or redirect back to contact page
    if(chkFlags($inputFlags)){ // attempt download from database
      $inputCodes['form'] = 'acceptedForm';

      $formData = [
        'name' => $name,
        'email' => $email
      ];

      // Create FormsView instance
      $formsViewObj = new ContactForm\FormsView();

      // Check number of contact forms saved in database with user's email
      $numOfRows = $formsViewObj->getNumForms($name, $email);

      if($numOfRows > 3) { // Too many forms submitted with current "$email"
        throw new CustomExceptions\TooManyFormsFoundException('Too many contact forms were found in the database');
      } else if($numOfRows > 0) { // 1, 2, or 3 forms found
        // Attempt to download contact form(s) from the database

        $formData = $formsViewObj->getFormatedForms($name, $email);

        if($formData){
          $inputCodes['data'] = $formData;
          echo(json_encode($inputCodes));
        } else {
          throw new Exception('No contact form(s) found');
        }
      } else { // no forms found
        throw new CustomExceptions\NoFormsFoundException('No contact forms found in database');
      }
    } else { // Errors found; Reject the form
      if(!isset($inputCodes['form'])){
        $inputCodes['form'] = 'rejectedForm';
      }

      echo(json_encode($inputCodes));
    }

  // ==== End of Accept or Reject Form ========================================
  // ==========================================================================

  // ==== Exception Handling ==================================================
  // 
  // ======== Custom Exceptions ===============================================
  //  * Catch any custom exceptions. These exceptions are specific errors that
  //    will be be re-thrown into a more vauge custom exception for the last
  //    "try{}catch(){}" to obtain.
  //
  //  * The built-in exception will be called when something goes wrong that
  //    the developer did not setup correctly or an natural occuring 
  //    exception within the code triggerd it.
  // ==========================================================================

  } catch(CustomExceptions\TooManyFormsFoundException $e) {
    throw new CustomExceptions\FormsException($e->getErrCode());
  } catch(CustomExceptions\NoFormsFoundException $e) {
    throw new CustomExceptions\FormsException($e->getErrCode());
  } catch(Exception $e) {
    throw new Exception($e->getMessage());
  } finally { // Close/finalize this script accordingly:

    // Discard instance if created
    if(isset($formsViewObj)){
      $formsViewObj = NULL;
    }
  }

  // ==== End of Exception Handling ===========================================
  // ==========================================================================