<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>


<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="Homepage.php">Academic Success</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="AcademicRecords.php">Add Record</a></li>

            <li><a href="ShowingRecord.php">Show Academic Details</a></li>


        </ul>

        <ul class="nav navbar-nav navbar-right">
            <?php
            try {
                // access the current session
                session_start();
                if (empty($_SESSION['userid'])) {
                    echo '<li><a href="register.php">Register</a></li>
                        <li><a href="loginpage.php">Login</a></li>';
                } else {
                    echo '<li><a href="#">' . $_SESSION['username'] . '</a></li>
                        <li><a href="logout.php">Logout</a></li>';
                }
            }
            catch (Exception $e) {
                // send
                mail('kbanyal10@gmail.com', 'Academic Records', $e);
                // show generic error page
                header('location:Error.php');
            }
            ?>
        </ul>
    </div>
</nav>