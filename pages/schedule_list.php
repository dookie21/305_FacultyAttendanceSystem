<?php
session_start();
include("../config.php");
include("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$data = $db->retrieve("schedule");
$data = json_decode($data, true);

$isAdmin = ($_SESSION['role'] ?? '') === 'admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule List</title>
    <link rel="stylesheet" href="styles/schedule.css?v=1">

    <style>
        .schedule-table th[colspan] {
            background-color: #1f2937;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        .schedule-table thead tr:first-child th {
            background-color: #1f2937 !important;
            color: white !important;
        }

        .schedule-table thead tr:not(:first-child) th {
            background: none !important;
            color: #000 !important;
        }
    </style>
</head>

<body>
    <div class="schedule-container">
        <div class="schedule-header">
            <h2><u>Schedule of Faculties</u></h2>
            <div class="actions">
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

            $order = ['MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];

            foreach ($order as $day) {
                if (isset($grouped[$day])) {
                    echo "<table class='schedule-table' border='1'>
                        <thead>
                            <tr><th colspan='" . ($isAdmin ? 4 : 2) . "'>{$day}</th></tr>
                            <tr>
                                <th>Time</th>
                                <th>Faculty Name</th>";

                    if ($isAdmin) {
                        echo "<th colspan='2'>Actions</th>";
                    }

                    echo "</tr></thead><tbody>";

                    foreach ($grouped[$day] as $id => $schedule) {
                        echo "<tr>
                                <td>{$schedule['time_from']} - {$schedule['time_to']}</td>
                                <td>{$schedule['faculty_name']}</td>";

                        if ($isAdmin) {
                            echo "<td><a href='pages/edit_schedule.php?id={$id}'>Edit</a></td>
                                  <td><a href='confirm/delete_schedule.php?id={$id}'>Delete</a></td>";
                        }

                        echo "</tr>";
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