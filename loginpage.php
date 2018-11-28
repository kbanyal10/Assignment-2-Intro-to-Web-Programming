
<?php
$title = "Login";
require('Header.php');
?>

<main class="container jumbotron">

    <h1>Log In</h1>

    <?php

    //If login details are invalid, error is showed


    if (isset($_GET['invalid']))
    {
        echo '<div class="alert alert-danger">Invalid Login</div>';
    }
    else
        {
        echo '<div class="alert alert-info">Please enter your credentials</div>';
    }
    ?>
    <form method="post" action="check.php">

        <fieldset class="form-group">
            <label for="username" class="col-sm-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="Write your email" />
        </fieldset>

        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" required />
        </fieldset>

        <fieldset class="col-sm-offset-2">
            <input type="submit" value="Login" class="btn btn-success" />
        </fieldset>
    </form>
</main>


<script src="js/jquery-3.3.1.min.js"></script>


<script src="js/bootstrap.min.js"></script>

</body>
</html>