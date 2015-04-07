<!-- session permissions: 0 (client), 1 (consultant), 2 (admin) -->
<nav id="username-display">
  <ul>
    <li><a href="../html/index.htm">Home</a></li>
    <?php switch($_SESSION['type']) {
            case 1:
              echo "<li>
                      <a href='#'>Administrator Tasks</a>
                      <ul>
                        <li><a href='editConsultant.php'>Manage Staff Profiles</a></li>
                        <li><a href='viewAppointments.php'>View Staff Availability</a></li>
                        <li><a href='add_schedule.php'>Create New Schedule</a></li>
                        <li><a href='edit_schedule.php'>Edit Current Schedule</a></li>
                        <li><a href='#'>Enter Calendar Events</a></li>
                      </ul>
                    </li>";
            case 2:
              echo "<li>
                      <a href='#'>Consultant Tasks</a>
                      <ul>
                        <li><a href='#'>Availability Form</a></li>
                        <li><a href='#'>Evaluation Form</a></li>
                        <li><a href='#'>Staff Calendar</a></li>
                        <li><a href='#'>Edit Consultant Profile</a></li>
                      </ul>
                    </li>";
            case 0:
              echo "<li>
                      <a href='#'>Basic Tasks</a>
                      <ul>
                        <li><a href='#'>Consultant Profiles</a></li>
                        <li><a href='#'>Help</a></li>
                        <li><a href='#'>Contact Us</a></li>
                        <li><a href='#'>Edit Account</a></li>
                        <li><a href='logout.php'>Log Out</a></li>
                      </ul>
                    </li>";
          } ?>
  </ul>
</nav>