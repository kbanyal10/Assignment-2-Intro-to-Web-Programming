<?php
try {

    session_start();
    session_destroy();
    header('location:loginpage.php');
}
catch (Exception $e) {

    mail('kbanyal10@gmail.com', 'Academic Records', $e);

    header('location:Error.php');
}
?>