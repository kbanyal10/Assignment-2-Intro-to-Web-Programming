
<?php
$title = "Register";
require('Header.php');

?>



<main class="container jumbotron">

    <h1>User Registration</h1>

    <div class="alert alert-info jumbotron" id="message">Please create your account

    <form method="post" action="save-registration.php"><!--Register form-->

        <fieldset class="form-group">

            <label for="username" class="col-sm-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="write you email"/>

        </fieldset>

        <fieldset class="form-group">

            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>

        </fieldset>

        <fieldset class="form-group">
            <label for="confirm" class="col-sm-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>

        </fieldset>

        <div class="col-sm-offset-2">
            <input type="submit" value="Register" class="btn btn-success" />
        </div>

    </form>
    </div>
</main>

<!--linking scripts-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>