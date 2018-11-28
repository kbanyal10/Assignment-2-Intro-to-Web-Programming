<?php

$title = "ShowingRecord";

require('Header.php');

if (isset($_SESSION['userid'])) {

    echo '<a href="AcademicRecords.php">Add Student Record</a> ';//This allows user to add a student record

}
?>

<h1>Academics</h1>

<form method="get">//This is for the search

    <fieldset class="col-md-12 text-right">

        <label for="searchName">Search: </label>
        <input name="searchName" id="searchName" placeholder="Search By Name" />
        <select name="searchType" id="searchType">
            <option>-All-</option>

            <?php
try{
            require('db.php');

            $sql = "SELECT * FROM grade ORDER BY grade";//This takes data from grades table
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $types = $cmd->fetchAll();

            foreach ($types as $y)
            {
                echo "<option>{$y['grade']}</option>";
            }

            ?>

        </select>

        <button class="btn btn-primary">Search</button>
        </fieldset>

</form>

<?php


    require('db.php');

    $sql = "SELECT * FROM academicss";

    $searchName = null;
    $searchType = null;

    if (isset($_GET['searchName']))
    {


        $searchName = $_GET['searchName'];
        $sql .= " WHERE courseName LIKE ?";


        if ($_GET['searchType'] != "-All-")
        {
            $searchType = $_GET['searchType'];
            $sql .= " AND grade = ?";
        }
    }

    $cmd = $db->prepare($sql);

    if (isset($searchName))

    {
        $words[0] = "%$searchName%";
        if (isset($searchType))
        {
            $words[1] = $searchType;
        }

        $cmd->execute($words);
        if ($searchName == "")
        {
            $searchName = "All";
        }

        if ($searchType == "")
        {
            $searchType = "All";
        }

        echo "<h3>You searched: $searchName / $searchType</h3>";
    }

    else
        {
        $cmd->execute();
        }

    $academicss = $cmd->fetchAll();

    echo '<table class="table table-striped table-hover sortable"><thead><th>Course Name</th><th>Logo</th><th>Student Number</th><th>Name</th><th>Work</th><th>Grades</th>';

    if(isset($_SESSION['userid']))
    {
        echo '<th>Actions</th>';
    }

    echo '</thead>';

    foreach($academicss as $r)
    {
        echo "<tr><td>{$r['courseName']}</td>";

        if (isset($r['logo']))
        {
            echo "<td><img src=\"img/{$r['logo']}\" alt=\"Logo\" height=\"50px\" width=\"50px\"/></td>";

        }

        echo "<td> {$r['studentNumber']}</td><td>{$r['name']}</td><td>{$r['work']}</td><td>{$r['grade']}</td>";

        if (isset($_SESSION['userid']))
        {
            echo "<td><a href=\"AcademicRecords.php?studentId={$r['studentId']}\">Edit</a> | <a href=\"Delete.php?studentId={$r['studentId']}\" 
                class=\"text-danger confirmation\">Delete</a></td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    // disconnect
    $db = null;

    echo"<script src=\"js/jquery-3.3.1.min.js\"></script>
<!-- sorttable script from https://kryogenix.org/code/browser/sorttable/ -->

<script src=\"js/sorttable.js\"></script>
<script src=\"delete-confirmation.js\"></script>";
}

catch (Exception $e)
{

    mail('kbanyal10@gmail.com', 'Academic Records', $e);


    header('location:Error.php');
}
?>




</body>
</html>