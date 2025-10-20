<?php
include("../config.php");
include("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$dateToday = strtoupper(date("l, F d, Y"));
$today = strtoupper(date("l"));
// $today = "THURSDAY";
$currentDate = date("Y-m-d");

// Retrieve schedules and attendance records
$schedules = json_decode($db->retrieve("schedule"), true);
$attendance = json_decode($db->retrieve("attendance"), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Attendance</title>
    <link rel="stylesheet" href="styles/attendance.css?v=1">
    <style>
        .status-circle {
            height: 14px;
            width: 14px;
            border-radius: 50%;
            display: inline-block;
        }
        .status-red {
            background-color: #dc3545; /* Not yet checked */
        }
        .status-blue {
            background-color: #007bff; /* Checked */
        }
        .btn-check {
            background-color: #007bff;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-check:hover {
            background-color: #0056b3;
        }
        .btn-disabled {
            background-color: #6c757d;
            color: white;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <div class="attendance-container">
        <div class="attendance-header">
            <h2><u>Attendance of Faculties</u></h2>
            <div class="attendance-actions">
                <p class="attendance-day"><?php echo $dateToday; ?></p>
            </div>
        </div>

        <table class="attendance-table" border="1">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Time</th>
                    <th>Faculty Name</th>
                    <th>Section</th>
                    <th>Subject</th>
                    <th>Room</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($schedules)) {
                    $found = false;
                    foreach ($schedules as $id => $row) {
                        if (strtoupper($row['day']) == $today) {
                            $found = true;

                            // Check attendance status for this schedule
                            $isChecked = false;
                            if (is_array($attendance)) {
                                foreach ($attendance as $a) {
                                    if (
                                        $a['schedule_id'] == $id &&
                                        $a['date'] == $currentDate &&
                                        strtolower($a['status']) == "checked"
                                    ) {
                                        $isChecked = true;
                                        break;
                                    }
                                }
                            }

                            $statusClass = $isChecked ? "status-blue" : "status-red";
                            $actionButton = $isChecked
                                ? "<span class='btn-disabled'>Recorded</span>"
                                : "<a class='btn-check' href='pages/attendance_check.php?id={$id}'>Check</a>";

                            echo "
                            <tr>
                                <td><span class='status-circle {$statusClass}'></span></td>
                                <td>{$row['time_from']} - {$row['time_to']}</td>
                                <td>{$row['faculty_name']}</td>
                                <td>{$row['section']}</td>
                                <td>{$row['subject']}</td>
                                <td>{$row['room']}</td>
                                <td>{$actionButton}</td>
                            </tr>";
                        }
                    }
                    if (!$found) {
                        echo "<tr><td colspan='7' style='text-align:center;'>No schedule found for today.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center;'>No schedule data available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
