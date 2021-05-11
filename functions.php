<?php

    session_start(); //for login

    $link = mysqli_connect("localhost", "root", "", "twitter");

    if(mysqli_connect_errno()) {
        print_r(mysqli_connect_error());
        exit();
    }

    if(isset($_GET['function']) && $_GET['function'] == "logout") {
        session_unset(); //logut by ending session variables
        header("Location: http://localhost/twitter_clone/"); //redirect to home page after logout 
        exit();
    }

    // function displayTweets($type) {

    // }
?>