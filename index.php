<?php

    //general php connectiong handling
    include("functions.php");

    // headers of html application
    include("views/header.php");

    if(isset($_GET['page']) && $_GET['page'] == 'timeline') {
        include("views/timeline.php");
    } else {
        // body of html application
        include("views/home.php");
    }

    //footer of html application
    include("views/footer.php")

?>