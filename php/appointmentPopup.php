<!--
Title: Make Appointment Popup Template
Author: Alec Moore
Date: 3/7/2015
-->

<?php 

    session_start();

    if(empty($_SESSION['permission'])){
        header('location:login.php');
    }

    require_once('db_connection.php');


    if(!$_SERVER['QUERY_STRING']){
        $edit = false;
    }
    else{
        $edit = true;
        $appointment_id = $_SERVER['QUERY_STRING'];
       

        if($_SESSION['permission'] == 2 || $_SESSION['permission'] == 3){
            if(!userCanEditAppointment($_SESSION['user_id'],$appointment_id)){
                header("location:appointmentPopup.php");
            }
        }
        $appointment = getAppointmentById($appointment_id);
    }

  
    

    function saveToJSON($data){
        $data_json = json_encode($data);
        $dbfile = fopen("data/data.json", "w") or die("Unable to open file!");
        fwrite($dbfile, $data_json);
        fclose($dbfile);
    }

    function readFromJSON(){
        $dbfile = fopen("data/data.json", "r") or die("Unable to open file!");
        $schedule_json = fgets($dbfile);
        fclose($dbfile);

        return json_decode($schedule_json);
    }

    function updateScheduleFile(){
        $data = new stdClass();
        $data->consultants = getConsultants();
        $data->schedule = getSchedule();
        saveToJSON($data); 
    }


   updateScheduleFile();
 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //print_r($_POST);die();
        if( 
            empty($_POST['courseNum'])              || 
            empty($_POST['courseName'])             ||
            empty($_POST['apptDate'])               ||
            empty($_POST['apptTime'])               ||
            empty($_POST['instructorName'])         ||
            empty($_POST['assignmentName'])         ||
            empty($_POST['assignmentDescription'])
        ){

            echo "Missing required information";
            //print_r($_POST);die();

        }
        else{

            $app = new stdClass();

           
            $app->course_number = $_POST['courseNum'];
            $app->course_name = $_POST['courseName'];
            $app->instructor = $_POST['instructorName'];
            $app->assignment = $_POST['assignmentName'];
            $app->send_post_consultation_notes = !empty($_POST['consultationNotes']);
            $app->description = $_POST['assignmentDescription'];
            $app->client_id = $_SESSION['user_id'];
            $app->consultant_id = explode('-',$_POST['apptTime'])[1];
            $app->schedule_id = explode('-',$_POST['apptTime'])[0];
            $app->date = $_POST['apptDate'];
            $app->appointment_missed = false;
            $app->appointment_cancelled = false;


            if($edit){            
                if($app->schedule_id != $appointment->schedule_id){
                    $app->old_schedule_id = $appointment->schedule_id;
                }

                $app->id = $appointment_id;

                if(updateScheduleAppointment($app)){
                    $_POST = [];
                    updateScheduleFile();
                    header('location:'./*$_SERVER['SERVER_NAME'].*/$_SERVER['REQUEST_URI']);
                }
            }
            else{
                if(scheduleAppointment($app)){
                    $_POST = [];
                    updateScheduleFile();
                }
            }          
        }
    }
 ?>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>Popup Template</title>

        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/popupStyle.css">
    </head>
    <body>
        <div class="popup">
            <div class="head">
                <h1>Make Appointment</h1>
            </div>
            <form action="" method="post">
                <div>
                   <!--  <label>Client Name</label> -->
                    <h2><?php echo  $edit ? $appointment->client_name:$_SESSION['username'] ?></h2>
                </div>

                <div>
                    <div class="one">
                        <label>Date</label>
                        <input type='date' id='apptDate' name="apptDate" value="<?php echo $edit ? $appointment->date :  (!empty($_POST['apptDate']) ? $_POST['apptDate']:''); ?>" >
                    </div>

                    <div class="two">
                        <label>Time</label>
                        <select name="apptTime" id="apptTime" >
                            <?php echo $edit ? '<option value='.$appointment->schedule_id.'-'.$appointment->consultant_id.'-'.$appointment->time.'>'.$appointment->time.'-'.$appointment->consultant_name.'</option>':"<option>Choose A Time</option>"?>
                        </select>
                    </div>
                </div>

                <div>
                    <div class="one">
                        <label>Course Number</label>
                        <input type="text" name="courseNum" value="<?php echo $edit ? $appointment->course_number : (!empty($_POST['courseNum']) ? $_POST['courseNum']:''); ?>" />
                    </div>

                    <div class="two">
                        <label>Course Name</label>
                        <input type="text" name="courseName" value="<?php echo $edit ? $appointment->course_name : (!empty($_POST['courseName']) ? $_POST['courseName']:'') ?>" />
                    </div>
                </div>

                <div>
                    <div class="one">
                        <label>Instructor Name</label>
                        <input type="text" name="instructorName" value="<?php echo $edit ? $appointment->instructor : (!empty($_POST['instructorName']) ? $_POST['instructorName']:'') ?>" />
                    </div>

                    <div class="two">
                        <label>Assignment Name</label>
                        <input type="text" name="assignmentName" value="<?php echo $edit ? $appointment->assignment :  (!empty($_POST['assignmentName']) ? $_POST['assignmentName']:'') ?>" />
                    </div>
                </div>

                <div>
                    <label>Assignment Description</label>
                    <textarea name="assignmentDescription"><?php echo $edit ? $appointment->description : (!empty($_POST['assignmentDescription']) ? $_POST['assignmentDescription']:'') ?></textarea>
                </div>


                <div class="overflow">
                    <input type="checkbox" name="consultationNotes" id="consultationNotes" <?php echo $edit ? ($appointment->send_post_consultation_notes ? 'checked':'') : (!empty($_POST['consultationNotes']) ? 'checked':'') ?> />
                    <label>Send Post-Consultation notes to instructor</label>
                    <div class="relative">
                        <a id="whatsThis">Whats this?</a>
                        <div id="tooltip" style="display: none">
                            <!-- ToDo: Find out what text goes here -->
                            <p>Describe what post-consultation notes are and why clients may want to use them</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div id="instructorEmail" style="display: none">
                        <label>Instructor Email</label>
                        <input type="email" />
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn">Save</button>
                    <button class="btn">Cancel</button>
                </div>

            </form>
        </div>
        <script src="js/jquery-1.11.0.js"></script>
        <script src="js/appt.js"></script>
    </body>
</html>
