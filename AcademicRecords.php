<?php
$title = "Academic Details";//This gives the title of the page to Academic Details

require('Header.php');//This includes the header
require('auth.php');//This is for the authorization



// initialize variables to null
$courseName = null;
$studentNumber = null;
$name = null;
$work = null;
$grade = null;
$studentId = null;
$logo = null;

//This runs when studentid is not empty

if (!empty($_GET['studentId'])) {

    $studentId = $_GET['studentId'];
    // connect
    try {
        require('db.php');
        // set up and execute query
        $sql = "SELECT * FROM academicss WHERE studentId = :studentId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $cmd->execute();
        $x = $cmd->fetch();

        $courseName = $x['courseName'];
        $studentNumber = $x['studentNumber'];
        $name = $x['name'];
        $work = $x['work'];
        $grade = $x['grade'];
        $logo = $x['logo'];



        $db = null;
    }
    catch (Exception $e) {
        // send
        mail('kbanyal10@gmail.com', 'Academic Records', $e);
        // show generic error page
        header('location:Error.php');
    }
}
?>



<h1>Student Details</h1>

<link rel="stylesheet" href="css/bootstrap.min.css"/> <!--Connects with bootstrap-->
<meta charset="UTF-8">




<!--This will show the student records by going on the ShowingRecord.php page -->
<div class="jumbotron">
    <h3><a href="ShowingRecord.php" class="label label-default">Show Student Academics </a></h3><br>
<!--This is to give table some classes so that bootstrap can be applied on this and after submitting this will direct it to page AcademicInput.php-->
    <script src="js/jquery-3.3.1.min.js"></script>


    <script src="js/bootstrap.min.js"></script>
<form method="post" action="AcademicInput.php" enctype="multipart/form-data">
    <!--Creating a Form -->
    <fieldset>
        <label for="courseName" class="col-md-1">Course Name: </label>
        <input name="courseName" id="courseName" required value="<?php echo $courseName; ?>"/>

    </fieldset>
    <fieldset>
        <label for="studentNumber" class="col-md-1">Student Number: </label>
        <input name="studentNumber" id="studentNumber" required value="<?php echo $studentNumber; ?>"/>
    </fieldset>
    <fieldset>
        <label for="name" class="col-md-1">Name: </label>
        <input name="name" id="name" required value="<?php echo $name; ?>"/>
    </fieldset>
    <fieldset>
        <label for="work" class="col-md-1">Work: </label>
        <input name="work" id="work" required value="<?php echo $work; ?>"/>
    </fieldset>
    <fieldset>
        <label for="grade" class="col-md-1">Grade: </label>
        <select  name="grade" id="grade" required>
            <option>-Select-</option>

            <?php
            //Connecting to the database
            try{
            require('db.php');
            //selecting from table grade
            $sql = "SELECT * FROM grade ORDER BY grade";
            $cmd = $db->prepare($sql);
            $cmd->execute();

            //This will fetch the data from the table

            $academic = $cmd->fetchAll();
            //This will store the grade inputs and will show as a drop down

            foreach ($academic as $t) {
                if ($t['grade'] == $grade) {
                    echo "<option selected> {$t['grade']} </option>";
                } else {
                    echo "<option> {$t['grade']} </option>";
                }
            }
            // disconnect
            $db = null;

            ?>
        </select>
    </fieldset>

    <fieldset>
        <label for="logo" class="col-md-1">Logo:</label>
        <input type="file" name="logo" id="logo"  value="<?php echo $logo; ?>"/>
        <input type="hidden" name="logo" id="logo" value="<?php echo $logo; ?>"/>
    </fieldset>



</div>


    <div class="col-md-offset-1">
        <?php
        if (isset($logo)) {
            echo "<img src=\"img/$logo\" alt=\"Logo\" height=\"50px\" width=\"50px\" />";

        }


        $db = null;
        }
        catch (Exception $e) {
            // send
            mail('kbanyal10@gmail.com', 'Academic Records', $e);
            // show generic error page
            header('location:Error.php');
        }
        ?>
    </div>
    <button class="col-md-offset-1 btn btn-primary">Save Record</button>
    <input type="hidden" name="studentId" id="studentId" value="<?php echo $studentId; ?>" />



</form>






</body>
</html>
