<head>
    <link rel="stylesheet" href="/styling/default.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<?php

    session_start();
    include "navbar.php";
    

    /*
    spl_autoload_register('myAutoLoader');
    function myAutoLoader($className) {
        $path = "../classes/";
        $extension = ".class.php";
        $fullPath = $path . $className . $extension;

        if (!file_exists($fullPath)) {
            return false;
        }

        include_once $fullPath;
    }
    */
?>