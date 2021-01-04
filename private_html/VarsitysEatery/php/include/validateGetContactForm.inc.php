<?php
    // Check if any errors in $inputFlags
    function chkFlags($arr){
        foreach($arr as $flag){
            if(!$flag){
                return FALSE;
            }
        }
        return TRUE;
    } // end of "chkFlags()"

    // Clean input from potential whitespace, quotes, &/or malicious code
    function cleanInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } // end of "cleanInput()"

    if(isset($hdlGetContactForm) && $hdlGetContactForm){
        session_start();

        $inputFlags = array(
            'getfName' => FALSE,
            'getEmail' => FALSE
        );

        $fName = cleanInput($_POST['getfName']);
        $email = $_POST['getEmail'];

        // Check required values before uploading

        // Validate first name
        if(empty($fName)){
            $_SESSION['getfName'] = 'nofName';
        } elseif(!preg_match("/^[a-zA-Z]*$/", $fName)){
            $_SESSION['getfName'] = 'nofName';
        } elseif(strlen($fName) > 18){
            $_SESSION['getfName'] = 'lenfName';
        } else {
            $inputFlags['getfName'] = TRUE;
            $_SESSION['getfName'] = $fName;
        }

        // Validate email
        if(empty($email)){
            $_SESSION['getEmail'] = 'noEmail';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['getEmail'] = 'notEmail';
        } else {
            $inputFlags['getEmail'] = TRUE;
            $_SESSION['getEmail'] = $email;
        }

        // Upload data or redirect back to contact page
        if(chkFlags($inputFlags)){ // No errors found; upload to database
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/assets/php/include/autoloader.inc.php')){
                include_once($_SERVER['DOCUMENT_ROOT'] . '/assets/php/include/autoloader.inc.php');
                $formsViewObj = new FormsView();
                $formExists = $formsViewObj->isForm($fName, $email);
                if($formExists){
                    $_SESSION['formFound'] = TRUE;
                    header("Location: /form-viewer.php");
                    exit();
                } else { // no rows found in database
                    $_SESSION['formNotFound'] = TRUE;
                    header("Location: /contact.php?aaa");
                    exit();
                }
            } else { // class loader file not found
                $_SESSION['getServiceDown'] = TRUE;
                header("Location: /contact.php");
                exit();
            }
        } else { // Errors found; prompt user to fix
            $_SESSION['getFormErr'] = TRUE;
            header("Location: /contact.php");
            exit();
        }
    } else { // handler variable not declared
        header("Location: /contact.php");
        exit();
    }
?>