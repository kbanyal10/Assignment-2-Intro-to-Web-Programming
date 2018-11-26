<?php
require('Header.php');
require('auth.php');

//These are variables which will store the user data
$courseName = $_POST['courseName'];
$studentNumber = $_POST['studentNumber'];
$name = $_POST['name'];
$work = $_POST['work'];
$grade = $_POST['grade'];
$studentId = $_POST['studentId'];
$logo = null;

//This is validation from the server side
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

if (isset($_FILES['logo']))
{
    $logoFile = $_FILES['logo'];

    if ($logoFile['size'] > 0)
    {

        $logo = session_id() . "-" . $logoFile['name'];

        $fileType = null;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($finfo, $logoFile['tmp_name']);


        if (($fileType != "image/jpeg") && ($fileType != "image/png")) {
            echo 'Please upload a valid JPG or PNG logo<br />';
            $yes = false;
        }
        else
            {

            move_uploaded_file($logoFile['tmp_name'], "img/{$logo}");
        }
    }
    $yes=true;
}

//If everything is filled than it will connects to the database
if($yes)

{
    try {

        require('db.php');

        if (empty($studentId)) {

            $sql = "INSERT INTO academicss (courseName, studentNumber, name, work, grade, logo)
 
    VALUES (:courseName, :studentNumber, :name, :work, :grade, :logo)";
        }

        else
            {
            $sql = "UPDATE academicss SET courseName = :courseName, studentNumber = :studentNumber, name = :name,
                    work = :work, grade = :grade, logo = :logo WHERE studentId = :studentId";


        }

        /*if(!empty($logo))
        {
            "UPDATE from academicss SET logo = :logo WHERE studentId = :studentId";

        }*/


        $cmd = $db->prepare($sql);
        $cmd->bindParam(':courseName', $courseName, PDO::PARAM_STR, 100);
        $cmd->bindParam(':studentNumber', $studentNumber, PDO::PARAM_STR, 100);
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
        $cmd->bindParam(':work', $work, PDO::PARAM_STR, 100);
        $cmd->bindParam(':grade', $grade, PDO::PARAM_STR, 100);
        $cmd->bindParam(':logo', $logo, PDO::PARAM_STR, 255);

        if (!empty($studentId)) {
            $cmd->bindParam(':studentId', $studentId, PDO::PARAM_INT);

        }


        $cmd->execute();


// disconnect from the database
        $db = null;


        header('location:ShowingRecord.php');
    }
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

