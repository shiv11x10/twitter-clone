<?php 
    include("functions.php");

    if($_GET['action'] == "loginSignup") {
        
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $password = mysqli_real_escape_string($link, $_POST['password']);

        $error = "";

        if(!$email) {
            $error = "Email address is required\n";
        } if(!$password) {
            $error .= "Password is required\n";
        } if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Invalid email format\n";
          }

        if($error != "") {
            echo $error;
            exit();
        }

        if($_POST['loginActive'] == "0"){ //for signup requests

            $pass_hash = password_hash($password, PASSWORD_DEFAULT, array('cost'=>9));

            $query = "SELECT * FROM users WHERE email = '". $email . "' LIMIT 1";
            $result = mysqli_query($link, $query);
            if(mysqli_num_rows($result) > 0) 
                $error = "Email Already taken";

            else {
                $query = "INSERT INTO users (email, password) VALUES ('". $email . "', '". $pass_hash . "')";
                if(mysqli_query($link, $query)) {
                    $_SESSION['id'] = mysqli_insert_id($link); // for login . session data is stored on server side
                    echo 1;
                }
                else {
                    $error = "Couldn't create user - please try again";
                }
            }
        }
        else { // for login request
            $query = "SELECT * FROM users WHERE email = '". $email . "' LIMIT 1";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])) { //replace with bcrypt password_verify
                echo 1;

                $_SESSION['id'] = $row['id'];

            } else {
                $error = "Could not find email/password. Please try again.";
            }
        }

        if($error != "") {
            echo $error;
        }
    }

    mysqli_close($link);
?>