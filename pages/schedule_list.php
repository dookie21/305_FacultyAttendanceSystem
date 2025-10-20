<?php
include("../config.php");
include("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);


$data = $db->retrieve("schedule");
$data = json_decode($data, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule List</title>
    <link rel="stylesheet" href="styles/schedule.css?v=1">
</head>
<body>
    <div class="schedule-container">
        <div class="schedule-header">
            <h2><u>Schedule of Faculties</u></h2>
            <div class="actions">
                <!-- <div class="schedule-filter">
                    <button class="sched-btn">By Day</button>
                    <button class="sched-btn">By Week</button>
                    <button class="sched-btn">By Month</button>
                </div> -->
                <a href="pages/add_schedule.php">
                    <button id="addSchedule">+ Add Schedule</button>
                </a>
            </div>
        </div>

        <?php
        if (is_array($data)) {
            $grouped = [];
            foreach ($data as $id => $schedule) {
                $day = strtoupper($schedule['day'] ?? 'UNKNOWN');
                $grouped[$day][$id] = $schedule;
            }

            // Sort days in normal weekday order
            $order = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];
            foreach ($order as $day) {
                if (isset($grouped[$day])) {
                    echo "
                    <table class='schedule-table' border='1'>
                        <thead>
                            <tr><th colspan='4'>{$day}</th></tr>
                            <tr>
                                <th>Time</th>
                                <th>Faculty Name</th>
                                <th colspan='2'>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
                    
                    foreach ($grouped[$day] as $id => $schedule) {
                        echo "<tr>
                                <td>{$schedule['time_from']} - {$schedule['time_to']}</td>
                                <td>{$schedule['faculty_name']}</td>
                                <td><a href='pages/edit_schedule.php?id={$id}'>Edit</a></td>
                                <td><a href='confirm/delete_schedule.php?id={$id}'>Delete</a></td>
                              </tr>";
                    }

                    echo "</tbody></table><br><hr><br>";
                }
            }
        } else {
            echo "<p style='text-align:center;'>No Records Found!</p>";
        }
        ?>
    </div>
</body>
</html>
