<html>
<Body>

<?php
$studentId = $_GET['studentId'];
if (empty($studentId)) {
header('location:AcademicRecords.php');
}

try {
    require('db.php');



    $sql = "DELETE FROM academicss WHERE studentId = :studentId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':studentId', $studentId, PDO::PARAM_INT);
    $cmd->execute();

    $db = null;


    header('location:AcademicRecords.php');
}
catch (Exception $e) {
    // send
    mail('kbanyal10@gmail.com', 'Academic Records', $e);
    // show generic error page
    header('location:Error.php');
}
?>

</body>
</html>