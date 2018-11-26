<?php
try {
// local db connection
    $db = new PDO('mysql:host=aws.computerstudi.es;dbname=gc200395834', 'gc200395834', 'RfOMQChbzO');
}
catch (Exception $e) {
    // send
    mail('kbanyal10@gmail.com', 'Academic Records', $e);
    // show generic error page
    header('location:Error.php');
}
?>