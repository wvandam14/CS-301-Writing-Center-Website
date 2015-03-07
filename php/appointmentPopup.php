<!--
Title: Make Appointment Popup Template
Author: Alec Moore
Date: 3/7/2015
-->
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Popup Template</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/popupStyle.css">
</head>
<body>

<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if( !empty($_POST['clientName'])             ||
            //!empty($_POST['appDate'])                || 
            !empty($_POST['courseNum'])              || 
            !empty($_POST['courseName'])             ||
            !empty($_POST['courseName'])             ||
            !empty($_POST['instructorName'])         ||
            !empty($_POST['assignmentName'])         ||
            !empty($_POST['assignmentDescription'])  ||
            !empty($_POST['assignmentDescription'])  ||
            !empty($_POST['consultationNotes'])){

            echo "OK";

        }
        else{
            echo "add to database";
        }
    }

?>



<div class="popup">
    <div class="head">
        <h1>Make Appointment</h1>
    </div>
    <form action="" method="post">
        <div>
            <label>Client Name</label>
            <input type="text" name="clientName" value="<?php echo !empty($_POST['clientName']) ? $_POST['clientName']:'' ?>"  placeholder="Client Name"/>
        </div>

        <div>
            <div class="one">
                <label>Date</label>
                <input type='date' name="apptDate" value="<?php echo !empty($_POST['apptDate']) ? $_POST['apptDate']:'' ?>" >
            </div>

            <div class="two">
                <label>Time</label>
                <select name="apptTime" value="<?php echo !empty($_POST['apptTime']) ? $_POST['apptTime']:'' ?>" >
                    <option>Choose A Time</option>
                </select>
            </div>
        </div>

        <div>
            <div class="one">
                <label>Course Number</label>
                <input type="text" name="courseNum" value="<?php echo !empty($_POST['courseNum']) ? $_POST['courseNum']:'' ?>" />
            </div>

            <div class="two">
                <label>Course Name</label>
                <input type="text" name="courseName" value="<?php echo !empty($_POST['courseName']) ? $_POST['courseName']:'' ?>" />
            </div>
        </div>

        <div>
            <div class="one">
                <label>Instructor Name</label>
                <input type="text" name="instructorName" value="<?php echo !empty($_POST['instructorName']) ? $_POST['instructorName']:'' ?>" />
            </div>

            <div class="two">
                <label>Assignment Name</label>
                <input type="text" name="assignmentName" value="<?php echo !empty($_POST['assignmentName']) ? $_POST['assignmentName']:'' ?>" />
            </div>
        </div>

        <div>
            <label>Assignment Description</label>
            <textarea name="assignmentDescription"><?php echo !empty($_POST['assignmentDescription']) ? $_POST['assignmentDescription']:'' ?></textarea>
        </div>

        <div>
            <input type="checkbox" name="consultationNotes" value="<?php echo !empty($_POST['consultationNotes']) ? $_POST['consultationNotes']:'' ?>" />
            <label>Send Post-Consultation notes to instructor</label>
            <a>Whats this?</a>
        </div>

        <div>
            <button type="submit" class="btn">Save</button>
            <button class="btn">Cancel</button>
        </div>

    </form>
</div>
</body>
</html>
