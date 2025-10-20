<?php
include_once("../config.php");
include_once("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'] ?? '';
$data = $db->retrieve("schedule/$id");
$schedule = json_decode($data, true);

if (!$schedule) {
    echo "<script>alert('Schedule record not found!'); window.location.href='../schedule_list.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 50px 0;
        }

        .form-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 700px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px 25px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="time"],
        input[type="url"],
        select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-actions {
            grid-column: 1 / 3;
            text-align: right;
            margin-top: 10px;
        }

        input[type="submit"],
        input[type="button"] {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 5px;
        }

        input[type="submit"] {
            background: #4CAF50;
            color: #fff;
        }

        input[type="button"] {
            background: #f44336;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Edit Schedule</h2>
        <form method="post" action="../php/action_edit_schedule.php">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div>
                <label for="faculty_name">Faculty Name</label>
                <input type="text" name="faculty_name" id="faculty_name" value="<?= htmlspecialchars($schedule['faculty_name']) ?>" required>
            </div>

            <div>
                <label for="day">Day</label>
                <select name="day" id="day" required>
                    <option value="">Select Day</option>
                    <?php
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    foreach ($days as $day) {
                        $selected = ($schedule['day'] == $day) ? 'selected' : '';
                        echo "<option value='$day' $selected>$day</option>";
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="time_from">Time From</label>
                <input type="time" name="time_from" id="time_from" value="<?= htmlspecialchars($schedule['time_from']) ?>" required>
            </div>

            <div>
                <label for="time_to">Time To</label>
                <input type="time" name="time_to" id="time_to" value="<?= htmlspecialchars($schedule['time_to']) ?>" required>
            </div>

            <div style="grid-column: 1 / 3;">
                <label for="meeting_link">Meeting Link</label>
                <input type="url" name="meeting_link" id="meeting_link" value="<?= htmlspecialchars($schedule['meeting_link']) ?>">
            </div>

            <div class="form-actions">
                <input type="submit" name="update" value="Update">
                <input type="button" value="Cancel" onclick="window.history.back();">
            </div>
        </form>
    </div>
</body>

</html>
