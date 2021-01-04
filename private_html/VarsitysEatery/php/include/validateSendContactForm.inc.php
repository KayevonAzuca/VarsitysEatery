<?php
    function chkFlags($arr) {
        foreach($arr as $flag) {
            if(!$flag) {
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

    if(isset($hdlSendContactForm) && $hdlSendContactForm) {
        session_start();

        $inputFlags = array(
            'fName' => FALSE,
            'email' => FALSE,
            'custMsg' => FALSE,
            'telNum' => FALSE,
            'persFavFood' => FALSE,
            'rating' => FALSE,
            'retCust' => FALSE,
            'favCat' => FALSE
        );

        // User inputs
        
        // input: text
        $fName = cleanInput($_POST['fName']);
        // input: email
        $email = $_POST['email'];
        // input: tel
        $telNum = $_POST['telNum'];
        // input: text
        $persFavFood = cleanInput($_POST['persFavFood']);
        // input: textarea
        $custMsg = cleanInput($_POST['custMsg']);
        // input: range
        $rating = $_POST['rating'];
        // input: radio
        $retCust = $_POST['retCust'];
        // input: checkbox
        $favCat = $_POST['favCat'];

        // The following are required inputs

        // Validate first name
        if(empty($fName)){
            $_SESSION['fName'] = 'nofName';
        } elseif(!preg_match("/^[a-zA-Z]*$/", $fName)){
            $_SESSION['fName'] = 'nofName';
        } elseif(strlen($fName) > 18){
            $_SESSION['fName'] = 'lenfName';
        } else {
            $inputFlags['fName'] = TRUE;
            $_SESSION['fName'] = $fName;
        }

        // Validate email
        if(empty($email)){
            $_SESSION['email'] = 'noEmail';
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['email'] = 'notEmail';
        } else {
            $inputFlags['email'] = TRUE;
            $_SESSION['email'] = $email;
        }

        // Validate customer message
        if(empty($custMsg)){
            $_SESSION['custMsg'] = 'noCustMsg';
        } elseif(strlen($custMsg) > 256){
            $_SESSION['custMsg'] = 'lenCustMsg';
        } else {
            $inputFlags['custMsg'] = TRUE;
            $_SESSION['custMsg'] = $custMsg;
        }

        // The following are not required inputs but will be validated if value was given

        // Check phone number
        if(empty($telNum)){ // No phone number given; don't validate
            $inputFlags['telNum'] = TRUE;
            $_SESSION['telNum'] = NULL;
        } else { // Validate
            if(!preg_match("/^[0-9]*$/", $telNum)){
                $_SESSION['telNum'] = 'notTelNum';
            } elseif(strlen($telNum) !== 10){
                $_SESSION['telNum'] = 'lenTelNum';
            } else {
                $inputFlags['telNum'] = TRUE;
                $_SESSION['telNum'] = $telNum;
            }
        }

        // Check personal favorite food
        if(empty($persFavFood)){ // No personal favorite food given; don't validate
            $inputFlags['persFavFood'] = TRUE;
            $_SESSION['persFavFood'] = NULL;
        } else { // Validate
            if(!preg_match("/^[a-zA-Z]*$/", $persFavFood)){
                $_SESSION['persFavFood'] = 'notFood';
            } elseif(strlen($persFavFood) > 12){
                $_SESSION['persFavFood'] = 'lenFood';
            } else {
                $inputFlags['persFavFood'] = TRUE;
                $_SESSION['persFavFood'] = $persFavFood;
            }
        }

        // Validate rating
        if(is_numeric($rating) && $rating >= 1 && $rating <= 10){
            $inputFlags['rating'] = TRUE;
            $_SESSION['rating'] = $rating;
        } else {
            $_SESSION['rating'] = 'uknRating';
        }
        
        // Validate returning customer
        if(empty($retCust)){ // user choice not given; don't validate
            $inputFlags['retCust'] = TRUE;
            $_SESSION['retCust'] = NULL;
        } elseif($retCust == 'yes' || $retCust == 'maybe' || $retCust == 'no'){
            $inputFlags['retCust'] = TRUE;
            $_SESSION['retCust'] = $retCust;
        } else { // unknown value given
            $_SESSION['retCust'] = 'uknRetCust';
        }

        // Validate category names
        if(is_array($favCat) && count($favCat) > 0){
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/assets/json/menu.json')){
                $inputFlags['favCat'] = TRUE;
                $_SESSION['favCat'] = array();
                $menuCat = array();
                $menuJSON = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/assets/json/menu.json'), TRUE);

                foreach($menuJSON as $obj){
                    array_push($menuCat, $obj['category']);
                }

                foreach($favCat as $userFavCat) {
                    if(!in_array($userFavCat, $menuCat)){
                        $inputFlags['favCat'] = FALSE;
                        break;
                    } else {
                        array_push($_SESSION['favCat'], $userFavCat);
                    }
                }

            } else {
                $inputFlags['favCat'] = TRUE;
                $_SESSION['favCat'] = NULL;
            }
        } else {
            $inputFlags['favCat'] = TRUE;
            $_SESSION['favCat'] = NULL;
        }

        // Upload data or redirect back to contact page
        if(chkFlags($inputFlags)){ // No errors found; upload to database
            date_default_timezone_set("America/Los_Angeles");
            $ts = date("Y-m-d") . " " . date("h:i:s") . date("a") . " PST";
            $_SESSION['formSuccess'] = TRUE;
            $_SESSION['formTS'] = $ts;
            try {
                include_once($_SERVER['DOCUMENT_ROOT'] . '/assets/php/include/autoloader.inc.php');

                // Make comma separated categories array
                if(isset($_SESSION['favCat']) && count($_SESSION['favCat']) > 0) {
                    $commaSeparatedCatArr = implode(",", $_SESSION['favCat']);
                }

                $formArr = [
                    'fName' => $_SESSION['fName'],
                    'email' => $_SESSION['email'],
                    'custMsg' => $_SESSION['custMsg'],
                    'telNum' => $_SESSION['telNum'], 
                    'persFavFood' => $_SESSION['persFavFood'],
                    'rating' => $_SESSION['rating'],
                    'retCust' => $_SESSION['retCust'],
                    'favCat' => $commaSeparatedCatArr,
                    'ts' => $ts
                ];
                
                $formsContrObj = new FormsContr();
                $formsContrObj->uploadForm($formArr);
            } catch(exception $e) {
                $_SESSION['sendServiceDown'] = TRUE;
                header("Location: /contact.php");
                exit();
            }
            header("Location: /submitted.php");
            exit();
        } else { // Errors found; prompt user to fix
            $_SESSION['formSuccess'] = FALSE;
            header("Location: /contact.php");
            exit();
        }
    } else { // handler variable not declared
        header("Location: /contact.php");
        exit();
    }
?>