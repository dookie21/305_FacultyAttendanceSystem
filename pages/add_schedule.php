<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Faculty Schedule</title>
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
        input[type="url"],
        select,
        input[type="time"],
        input[type="month"] {
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
        <h2>Add Faculty Schedule</h2>
        <form method="post" action="../php/action_add_schedule.php">

            <div>
                <label for="faculty">Faculty</label>
                <select name="faculty" id="faculty" required>
                    <option value="">Select Faculty</option>
                    <?php
                    include("../config.php");
                    include("../firebaseRDB.php");
                    $db = new firebaseRDB($databaseURL);
                    $faculties = json_decode($db->retrieve("faculty"), true);
                    if (is_array($faculties)) {
                        foreach ($faculties as $id => $f) {
                            echo "<option value='{$id}'>{$f['name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="section">Section</label>
                <input type="text" name="section" id="section" placeholder="Enter section" required>
            </div>

            <div>
                <label for="subject">Subject Code</label>
                <input type="text" name="subject" id="subject" placeholder="Enter subject code" required>
            </div>

            <div>
                <label for="room">Room / Mode</label>
                <input type="text" name="room" id="room" placeholder="Ex: SDL 2 or Online">
            </div>

            <div>
                <label for="modality">Learning Modality</label>
                <select name="modality" id="modality" required>
                    <option value="">Select Modality</option>
                    <option value="Face to Face">Face to Face</option>
                    <option value="Online">Online</option>
                </select>
            </div>

            <div>
                <label for="meeting_link">Online Class Meeting Link</label>
                <input type="url" name="meeting_link" id="meeting_link" placeholder="Enter meeting link if online">
            </div>

            <div>
                <label for="day">Day of the week</label>
                <select name="day" id="day" required>
                    <option value="">Select a day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                </select>
            </div>
            <br>

            <div>
                <label>Month From</label>
                <input type="month" name="month_from" id="month_from">
            </div>

            <div>
                <label>Month To</label>
                <input type="month" name="month_to" id="month_to">
            </div>

            <div>
                <label>Time From</label>
                <input type="time" name="time_from" id="time_from">
            </div>

            <div>
                <label>Time To</label>
                <input type="time" name="time_to" id="time_to">
            </div>

            <div class="form-actions">
                <input type="submit" value="Save">
                <input type="button" value="Cancel" onclick="window.history.back();">
            </div>
        </form>
    </div>
</body>

</html>
