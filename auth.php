<?php
if (empty($_SESSION['userid'])) {
    header('location:loginpage.php');
    exit();
}
?>