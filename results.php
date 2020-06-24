<?php
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phoneNum = $_POST['phoneNum'];
        $favFood = $_POST['favFood'];

        $data = array(
            'errors' => array(),
            'name' => '',
            'email' => '',
            'success' => false
        );
        
        if(empty($name) || empty($email)){
            array_push($data["errors"], 'empty');

            if(empty($name)){
                array_push($data["errors"], 'noName');
            } else {
                $data['name'] = $name;
            }
            if(empty($email)){
                array_push($data["errors"], 'noEmail');
            } else {
                $data['email'] = $email;
            }
            $data = http_build_query($data);
            header("Location: /contact.php?form=$data");
            exit();
        } else {
            if(!preg_match("/^[a-zA-Z]*$/", $name)){
                array_push($data["errors"], 'char');
                $data['name'] = $name;
                $data['email'] = $email;

                $data = http_build_query($data);
                header("Location: /contact.php?form=$data");
                exit();
            } else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($data["errors"], 'notEmail');
                    $data['name'] = $name;
                    $data['email'] = $email;

                    $data = http_build_query($data);
                    header("Location: /contact.php?form=$data");
                    exit();
                } else {
                    $data['success'] = true;
                    $data = http_build_query($data);

                    header("Location: /contact.php?form=$data");
                    exit();
                }
            }
        }
    } else {
        array_push($data["errors"], 'cheat');

        $data = http_build_query($data);
        header("Location: /contact.php?form=$data");
        exit();
    }
?>