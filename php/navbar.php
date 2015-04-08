<!-- session permissions: 0 (client), 1 (consultant), 2 (admin) -->
<link rel="stylesheet" type="text/css" href="../css/indexStyle.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<nav id="username-display">
  <ul>
    <li><a href="../html/index.php">Home</a></li>
    <?php switch($_SESSION['type']) {
            case 1:
              echo "<li>
                      <a href='#'>Administrator Tasks</a>
                      <ul>
                        <li><a href='#'>Manage Staff Profiles</a></li>
                        <li><a href='../php/viewStaffAvailability.php'>View Staff Availability</a></li>
                        <li><a href='../php/manageConsultants.php'>Add/Remove Consultants</a></li>
                        <li><a href='../php/add_schedule.php'>Create New Schedule</a></li>
                        <li><a href='../php/edit_schedule.php'>Edit Current Schedule</a></li>
                        <li><a href='#'>Enter Calendar Events</a></li>
                        <li><a href='../php/logout.php'>Log Out</a></li>
                      </ul>
                    </li>";
            case 2:
              echo "<li>
                      <a href='#'>Consultant Tasks</a>
                      <ul>
                        <li><a href='#'>Availability Form</a></li>
                        <li><a href='#'>Evaluation Form</a></li>
                        <li><a href='../php/viewAvailability.php'>Staff Calendar</a></li>
                        <li><a href='../html/editConsultant.php'>Edit Consultant Profile</a></li>
                        <li><a href='../php/logout.php'>Log Out</a></li>
                      </ul>
                    </li>";
            case 3:
              echo "<li>
                      <a href='#'>Basic Tasks</a>
                      <ul>
                        <li><a href='../php/viewAppointments.php'>View My Appointments</a></li>
                        <li><a href='../php/appointmentPopup.php'>Make An Appointment</a></li>
                        <li><a href='#'>Consultant Profiles</a></li>
                        <li><a href='#'>Help</a></li>
                        <li><a href='#'>Contact Us</a></li>
                        <li><a href='#'>Edit Account</a></li>
                        <li><a href='../php/logout.php'>Log Out</a></li>
                      </ul>
                    </li>";
          } ?>
  </ul>
</nav>