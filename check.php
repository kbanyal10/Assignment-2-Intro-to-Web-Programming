<?php
$username = $_POST['username'];
$password = $_POST['password'];
try {
    require('db.php');
    $sql = "SELECT * FROM userdata WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
    $cmd->execute();
    $user = $cmd->fetch();
    if (!password_verify($password, $user['password'])) {
        header('location:loginpage.php?invalid=true');
        exit();
    } else {
        // the 3 missing lines go here
        session_start(); // connect to existing session so we can write to it
        $_SESSION['userid'] = $user['userid'];
        $_SESSION['username'] = $username;
        // header('location:restaurants.php');
    }
    $db = null;
    header('location:ShowingRecord.php');

}
catch (Exception $e) {
    // send
    mail('kbanyal10@gmail.com', 'Academic Records', $e);
    // show generic error page
    header('location:Error.php');
}
?>
