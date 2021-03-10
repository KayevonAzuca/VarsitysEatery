<?php
  // ==========================================================================
  // file: validateSendContactForm.inc.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description:
  //     Validate inputs from a contact form before uploading to the database.
  // ==========================================================================

  // ==== Script Include Check ================================================
  //
  // Restrict other scripts from using this script.
  // Verify that the script that "include()"s this script has declared
  // "$sendContactFormInc" as "TRUE".
  //
  // ==========================================================================

  if(!isset($sendContactFormInc) || !$sendContactFormInc) {
    throw new Exception('Script Include Check: Include variable not found');
  }

  unset($sendContactFormInc);

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
    'email' => FALSE,
    'msg' => FALSE,
    'telNum' => FALSE,
    'persFavFood' => FALSE,
    'rating' => FALSE,
    'retCust' => FALSE,
    'favCat' => FALSE
  );

  $inputCodes = array(
    'form' => NULL,
    'name' => NULL,
    'email' => NULL,
    'msg' => NULL,
    'telNum' => NULL,
    'persFavFood' => NULL
  );

  $JSONMenuCategories;

  // ==== End of Variable Declarations ========================================
  // ==========================================================================

  try {

    // ==== Script Setup ======================================================
    //
    // Make sure this script has all resources needed to execute:
    // Find and "include()" the class autoloader.
    // Find and save the JSON food menu.
    //
    // ========================================================================

    header('Content-Type: application/json');

    // Get & load the class auto loader
    $autoLoaderFullPath = realpath($_SERVER['DOCUMENT_ROOT'] . '/../private_html/php/include/autoloader.inc.php');
    if(file_exists($autoLoaderFullPath)){
      include_once($autoLoaderFullPath);
    } else {
      throw new Exception('Script Setup: Autoloader not found');
    }
    unset($autoLoaderFullPath);

    // Get JSON food menu
    $menuFullPath = realpath($_SERVER['DOCUMENT_ROOT'] . '/../protected_html/json/menu.json');
    if(file_exists($menuFullPath)){
      $JSONMenuCategories = array_keys(json_decode(file_get_contents($menuFullPath), TRUE));
    } else {
      throw new Exception('Script Setup: JSON menu file not found');
    }
    unset($menuFullPath);

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
    // Obtain text input of a phone number
    $telNum = cleanInput($_POST['telNum']);
    // Obtain text input of a personal favorite food
    $persFavFood = cleanInput($_POST['persFavFood']);
    // Obtain textarea input of a message
    $msg = cleanInput($_POST['msg']);
    // Obtain a number input of representing a rating
    $rating = cleanInput($_POST['rating']);
    // Obtain radio button input
    $retCust = cleanInput($_POST['retCust']);
    // Obtain an array of favorite food categories

    if(is_array($_POST['favCat']) && count($_POST['favCat']) > 0){
      $favCat = [];
      $selCat = $_POST['favCat'];
      foreach($selCat as $cat){ // Clean each element
        array_push($favCat, cleanInput($cat));
      }
      unset($selCat);
    } else {
      $favCat = NULL;
    }

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

    // Validate customer message
    if(empty($msg)){
      $inputCodes['msg'] = 'noMsg';
    } elseif(strlen($msg) > 256){
      $inputCodes['msg'] = 'lenMsg';
    } else {
      $inputFlags['msg'] = TRUE;
      $inputCodes['msg'] = 'validMsg';
    }

    // Check phone number
    if(empty($telNum)){ // No phone number given; don't validate
      $telNum = NULL;
      $inputFlags['telNum'] = TRUE;
      $inputCodes['telNum'] = 'validTelNum';
    } else { // Validate
      if(strlen($telNum) !== 10){
        $inputCodes['telNum'] = 'lenTelNum';
      } else if(!preg_match("/^[0-9]*$/", $telNum)){
        $inputCodes['telNum'] = 'notTelNum';
      } else {
        $inputFlags['telNum'] = TRUE;
        $inputCodes['telNum'] = 'validTelNum';
      }
    }

    // Check personal favorite food
    if(empty($persFavFood)){ // No personal favorite food given; don't validate
      $persFavFood = NULL;
      $inputFlags['persFavFood'] = TRUE;
      $inputCodes['persFavFood'] = 'validPersFavFood';
    } else { // Validate
      if(strlen($persFavFood) < 2 || strlen($persFavFood) > 12){
        $inputCodes['persFavFood'] = 'lenPersFavFood';
      } else if(!preg_match("/^[a-zA-Z]{2,}[\s]{0,1}[a-zA-Z]{0,}[\s]{0,1}[a-zA-Z]{0,}$/", $persFavFood)){
        $inputCodes['persFavFood'] = 'notPersFavFood';
      } else {
        $inputFlags['persFavFood'] = TRUE;
        $inputCodes['persFavFood'] = 'validPersFavFood';
      }
    }

    // Validate rating
    if(is_numeric($rating) && $rating >= 1 && $rating <= 10){
      $inputFlags['rating'] = TRUE;
    } else { // unknown value given
      throw new Exception('User Input: rating value error');
    }
    
    // Validate returning customer
    if($retCust == 'yes' || $retCust == 'maybe' || $retCust == 'no'){
      $inputFlags['retCust'] = TRUE;
    } else { // unknown value given
      throw new Exception('User Input: Returning customer value error');
    }

    // Validate category names
    if(is_array($favCat)){
      $inputFlags['favCat'] = TRUE;

      foreach($favCat as $userFavCat) {
        if(!in_array($userFavCat, $JSONMenuCategories)){
          $inputFlags['favCat'] = FALSE;
          break;
        }
      } // end of for(as)

      if(!$inputFlags['favCat']){ // unknown value found
        throw new Exception('User Input: Favorite food categories value error');
      }
    } else { // Favorite categories is null not an array; Valid input
      $inputFlags['favCat'] = TRUE;
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
    if(chkFlags($inputFlags)){ // No errors found; upload to database
      date_default_timezone_set("UTC");
      $ts = date("Y-m-d") . " " . date("h:i:s");
      $inputCodes['form'] = 'acceptedForm';

      // Make comma separated categories array
      if(isset($favCat) && is_array($favCat) && count($favCat) > 0){
        $commaSeparatedCatArr = implode(",", $favCat);
      } else {
        $commaSeparatedCatArr = NULL;
      }

      $formData = [
        'name' => $name,
        'email' => $email,
        'msg' => $msg,
        'telNum' => $telNum, 
        'persFavFood' => $persFavFood,
        'rating' => $rating,
        'retCust' => $retCust,
        'favCat' => $commaSeparatedCatArr,
        'ts' => $ts
      ];

      // Create Controller instance
      $formsContrObj = new ContactForm\FormsContr();

      // Check number of contact forms saved in database with user's email
      $numOfRows = $formsContrObj->chkRecByEmail($email);

      if($numOfRows > 3) { // Too many forms submitted with current "$email"
        throw new CustomExceptions\TooManyFormsFoundException('Too many forms submitted');
      } else if($numOfRows === 3) { // Delete oldest contact form
        if(!$formsContrObj->rmRecByEmail($email)){
          throw new Exception('Could not delete oldest form');
        }
      }

      // Attempt to upload contact form to database
      if(!$formsContrObj->uploadForm($formData)){
        throw new CustomExceptions\UploadFormException('Could not upload to database');
      }
      echo(json_encode($inputCodes));
    } else { // Errors found; Reject the form
      if(!isset($inputCodes['form'])){
        $inputCodes['form'] = 'rejectedForm';
      }

      echo(json_encode($inputCodes));
    }

    // ==== End of Accept or Reject Form ======================================
    // ========================================================================

  } catch(CustomExceptions\TooManyFormsFoundException $e) {
    throw new CustomExceptions\FormsException($e->getErrCode());
  } catch(CustomExceptions\UploadFormException $e) {
    throw new CustomExceptions\FormsException($e->getErrCode());
  } catch(Exception $e) {
    throw new Exception($e->getMessage());
  } finally { // Close/finalize this script accordingly:

    // Discard instance if created
    if(isset($formsContrObj)){
      $formsContrObj = NULL;
    }
  }