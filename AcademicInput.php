<?php
require('Header.php');//This includes the header to the page which is already coded

require('auth.php');//This connects the page to a php file "auth.php", which ends the connection when session id is empty

//This stores each and every variables
$courseName = $_POST['courseName'];
$studentNumber = $_POST['studentNumber'];
$name = $_POST['name'];
$work = $_POST['work'];
$grade = $_POST['grade'];
$studentId = $_POST['studentId'];
$logo = null;

 //This is validation for the client side interface, that if user doest fill any data then data will not be processed
$yes = true;

 if(empty($courseName))
 {
     echo "Please enter the course name.</br>";
     $yes= false;
 }

if(empty($studentNumber))
{
    echo "Please enter the student number.</br>";
    $yes= false;
}

if(empty($name))
{
    echo "Please enter the name.</br>";
    $yes= false;
}

if(empty($work))
{
    echo "Please give the work details.</br>";
    $yes= false;
}

if(empty($grade))
{
    echo "Please select a grade.</br>";
    $yes= false;
}

if(empty($logo))
{
    echo "Please select a grade.</br>";
    $yes= false;
}

//This is for the logo, that if image file is inserted than this will run

if (isset($_FILES['logo']))
{
    $logoFile = $_FILES['logo'];

    if ($logoFile['size'] > 0)
    {

        $logo = session_id() . "-" . $logoFile['name'];

        $fileType = null;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $logoFile['tmp_name']);

            //Only .jpeg or .png file are accepted as an image format

        if (($fileType != "image/jpeg") && ($fileType != "image/png")) {
            echo 'Please upload a valid JPG or PNG logo<br />';
            $yes = false;
        }

        //This moves the cached images to desired location
        else
            {

            move_uploaded_file($logoFile['tmp_name'], "img/{$logo}");
        }
    }
    $yes=true;
}

//If every field is filled than it connects the page to database
if($yes)

{
    //If everything works fine than try statement will run, otherwise the catch one will run and take us to the error page
    try {

        //Connecting to the database
        require('db.php');

        //If studentid is empty than new data is being filled
        if (empty($studentId)) {

            $sql = "INSERT INTO academicss (courseName, studentNumber, name, work, grade, logo)
 
    VALUES (:courseName, :studentNumber, :name, :work, :grade, :logo)";
        }

        //If studentid is not empty than data is updated

        else
            {
            $sql = "UPDATE academicss SET courseName = :courseName, studentNumber = :studentNumber, name = :name,
                    work = :work, grade = :grade, logo = :logo WHERE studentId = :studentId";


        }

        //This stores evrything we put in the from into database

        $cmd = $db->prepare($sql);
        $cmd->bindParam(':courseName', $courseName, PDO::PARAM_STR, 100);
        $cmd->bindParam(':studentNumber', $studentNumber, PDO::PARAM_STR, 100);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':work', $work, PDO::PARAM_STR, 100);
        $cmd->bindParam(':grade', $grade, PDO::PARAM_STR, 100);
        $cmd->bindParam(':logo', $logo, PDO::PARAM_STR, 255);

        //If student id is not empty than previous studentid remains in there
        if (!empty($studentId)) {
            $cmd->bindParam(':studentId', $studentId, PDO::PARAM_INT);

        }


        $cmd->execute();


// disconnect database
        $db = null;

    //This redirects the page to the ShowingRecord
        header('location:ShowingRecord.php');
    }

    //This will run, when try is failed
    catch (Exception $e) {
        // send
        mail('kbanyal10@gmail.com', 'Academic Records', $e);
        // show generic error page
        header('location:Error.php');
    }
}


?>

</body>
</html>

