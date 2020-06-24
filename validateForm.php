<?php
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];
        $favFood = $_POST['favFood'];
        $custMessage = $_POST['custMessage'];
        $rating = $_POST['rating'];
        $returningCust = $_POST['returningCust'];
        $favCateg = $_POST['favCateg'];

        $uErrors = array(
            'uEr' => array()
        );
        $uData = array(
            'uIn' => array(),
            'uFavCategory' => array()
        );
        
        //Validate name
        if(empty($name)){
            array_push($uErrors['uEr'], 'noName');
        } elseif(!preg_match("/^[a-zA-Z]*$/", $name)){
            array_push($uErrors["uEr"], 'notName');
        } elseif(strlen($name) > 18){
            array_push($uErrors["uEr"], 'lenName');
        }

        //Validate email
        if(empty($email)){
            array_push($uErrors['uEr'], 'noEmail');
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($uErrors["uEr"], 'notEmail');
        }

        //Validate phone number
        if(!empty($phoneNum)){
            if(!preg_match("/^[0-9]*$/", $phoneNum)){
                array_push($uErrors["uEr"], 'notPhNum');
            } elseif(strlen($phoneNum) !== 10){
                array_push($uErrors["uEr"], 'lenPhNum');
            }
        }

        //Validate personal favorite food
        if(!empty($favFood)){
            if(!preg_match("/^[a-zA-z0-9]*$/", $favFood)){
                array_push($uErrors["uEr"], 'notFood');
            } elseif(strlen($favFood) > 12){
                array_push($uErrors["uEr"], 'lenFood');
            }
        }

        //Validate customer message
        if(empty($custMessage)){
            array_push($uErrors['uEr'], 'noCustMessage');
        } elseif(strlen($custMessage) > 128){
            array_push($uErrors["uEr"], 'lenCustMessage');
        }

        //Check if errors in $uErrors
        if(empty($uErrors['uEr'])){
            $uData['uIn']['name'] = $name;
            /*
            $uData['uIn']['email'] = $email;
            $uData['uIn']['phoneNum'] = $phoneNum;
            $uData['uIn']['favFood'] = $favFood;
            $uData['uIn']['custMessage'] = $custMessage;
            $uData['uIn']['rating'] = $rating;
            $uData['uIn']['returningCust'] = $returningCust;
            $uData['uIn']['favCateg'] = $favCateg;
            */
            
            $uData = http_build_query($uData);
            header("Location: /submitted.php?$uData");
            exit();
        } else {
            $uData['uIn']['name'] = $name;
            $uData['uIn']['email'] = $email;
            $uData['uIn']['phoneNum'] = $phoneNum;
            $uData['uIn']['favFood'] = $favFood;
            $uData['uIn']['custMessage'] = $custMessage;
            $uData['uIn']['rating'] = $rating;
            $uData['uIn']['returningCust'] = $returningCust;
            $uData['uIn']['favCateg'] = $favCateg;

            $uErrors = http_build_query($uErrors);
            $uData = http_build_query($uData);
            header("Location: /contact.php?$uErrors&$uData");
            exit();
        }
    } else {
        array_push($uErrors["uEr"], 'cheat');

        $uErrors = http_build_query($uErrors);
        $uData = http_build_query($uData);
        header("Location: /contact.php?$uErrors&$uData");
        exit();
    }
?>