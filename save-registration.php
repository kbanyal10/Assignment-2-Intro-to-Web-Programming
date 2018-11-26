<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving your Registration</title>
</head>
<body>

<?php

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

$ok = true;

if (empty($username))
{
    echo 'Username is required<br />';
    $ok = false;
}

if (strlen($password) < 8)
{
    echo 'Password is invalid<br />';
    $ok = false;
}
if ($password != $confirm)
{
    echo 'Passwords do not match<br />';
    $ok = false;
}
if ($ok)
{

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try
    {
        require('db.php');

        $sql = "INSERT INTO userdata (username, password) VALUES (:username, :password)";

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 100);
        $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 100);
        $cmd->execute();

        $db = null;

        header('location:loginpage.php');
    }
    catch (Exception $e)
    {

        mail('kbanyal10@gmail.com', 'Academic Records', $e);

        header('location:Error.php');
    }
}
?>

</body>
</html>