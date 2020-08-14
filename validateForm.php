<?php
    // Clean input from potential whitespace, quotes, &/or malicious code
    // https://www.w3schools.com/php/php_form_validation.asp
    function cleanInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uData = array(
        'uIn' => array(),
        'uEr' => array()
    );

    if(isset($_POST['submit'])){
        $fName = cleanInput($_POST['fName']); // text
        $email = $_POST['email']; // email
        $phoneNum = $_POST['phoneNum']; // tel
        $persFavFood = cleanInput($_POST['persFavFood']); // text
        $custMessage = cleanInput($_POST['custMessage']); // textarea
        $rating = $_POST['rating']; // range
        $visitAgain = $_POST['visitAgain']; // radio
        $favCateg = $_POST['favCateg']; // checkbox

        // Required values before uploading

        // Validate first name
        if(empty($fName)){
            array_push($uData['uEr'], 'nofName');
        } elseif(!preg_match("/^[a-zA-Z]*$/", $fName)){
            array_push($uData["uEr"], 'notfName');
        } elseif(strlen($fName) > 18){
            array_push($uData["uEr"], 'lenfName');
        }

        // Add name to $uData if it was given
        if(!in_array('nofName', $uData['uEr'])){
            $uData['uIn']['fName'] = $fName;
        }

        // Validate email
        if(empty($email)){
            array_push($uData['uEr'], 'noEmail');
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($uData["uEr"], 'notEmail');
        }

        // Add email to $uData if it was given
        if(!in_array('noEmail', $uData['uEr'])){
            $uData['uIn']['email'] = $email;
        }

        // Validate customer message
        if(empty($custMessage)){
            array_push($uData['uEr'], 'noCustMessage');
        } elseif(strlen($custMessage) > 256){
            array_push($uData['uEr'], 'lenCustMessage');
        }

        // Add customer message to $uData if it was given
        if(!in_array('noCustMessage', $uData['uEr'])){
            $uData['uIn']['custMessage'] = $custMessage;
        }

        // Values not required for upload
        // Only validate if value was given

        // Validate phone number
        if(empty($phoneNum) && empty($uData['uEr'])){ // Add phone to $uData if it was given
            $uData['uIn']['phoneNum'] = NULL;
        } elseif(!empty($phoneNum)) { // Validate
            if(!preg_match("/^[0-9]*$/", $phoneNum)){
                array_push($uData["uEr"], 'notPhNum');
            } elseif(strlen($phoneNum) !== 10){
                array_push($uData["uEr"], 'lenPhNum');
            }
            $uData['uIn']['phoneNum'] = $phoneNum;
        }

        // Validate personal favorite food
        if(empty($persFavFood) && empty($uData['uEr'])){ // Add personal favorite food to $uData if it was given
            $uData['uIn']['persFavFood'] = NULL;
        } elseif(!empty($persFavFood)) { // Validate
            if(!preg_match("/^[a-zA-Z]*$/", $persFavFood)){
                array_push($uData["uEr"], 'notFood');
            } elseif(strlen($persFavFood) > 12){
                array_push($uData["uEr"], 'lenFood');
            }
            $uData['uIn']['persFavFood'] = $persFavFood;
        }

        // Validate rating
        if($rating >= 1 && $rating <= 10){
            $uData['uIn']['rating'] = $rating;
        } else {
            array_push($uData["uEr"], 'uknRating');
        }
        
        // Validate returning customer radio button
        if($visitAgain == 'yes' || $visitAgain == 'maybe' || $visitAgain == 'no'){
            $uData['uIn']['visitAgain'] = $visitAgain;
        } elseif($visitAgain == ''){ // user didn't specify rdo button
            $uData['uIn']['visitAgain'] = '';
        } else { // user modified HTML
            array_push($uData["uEr"], 'uknRetCust');
        }
        
        // Validate category names
        $uData['uIn']['favCateg'] = $favCateg;

        // Check if errors in $uData
        if(empty($uData['uEr'])){ // No errors found: upload to database
            session_start();
            $_SESSION['formSuccess'] = TRUE;
            $_SESSION['fName'] = $fName;

            // mySQL database implementation...
            // include_once('assets/php/include/db/dbConnect.php');

            // $sql = "INSERT INTO ve_forms (fName, email, phoneNum, persFavFood, custMessage, rating, visitAgain, favCateg)
            // VALUES ('$fName', '$email', '$phoneNum', '$persFavFood', '$custMessage', '$rating', '$visitAgain', '$favCateg');";
            // mysqli_query($conn, $sql);

            // mysqli_stmt_close();
            // mysqli_close($conn);

            header("Location: submitted.php");
            exit();
        } else { // Errors found: Prompt user to fix
            $uData = http_build_query($uData);
            header("Location: contact.php?$uData");
            exit();
        }
    } else { // User tried to directly on page without submitting a form
        array_push($uData["uEr"], 'noForm');
        $uData = http_build_query($uData);
        header("Location: contact.php?$uData");
        exit();
    }
?>