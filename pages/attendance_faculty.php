<?php
include("../config.php");
include("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'] ?? '';
$data = json_decode($db->retrieve("schedule/{$id}"), true);

if (!$data) {
    die("Schedule not found.");
}

$date_today = date("F d, Y");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Attendance Record</title>

    <link rel="stylesheet" href="styles/attendance.css?v=1">
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f3f4f6;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 35px 40px;
            width: 800px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        input,
        select,
        textarea {
            padding: 9px;
            border: 1px solid #bbb;
            border-radius: 6px;
            background-color: white;
            font-size: 14px;
            width: 100%;
        }

        input[readonly] {
            background-color: #e5e7eb;
            color: #555;
            cursor: not-allowed;
        }

        textarea {
            resize: none;
            height: 60px;
        }

        .full {
            grid-column: span 2;
        }

        .btn-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        button {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-save {
            background: #007bff;
            color: #fff;
        }

        .btn-save:hover {
            background: #0056b3;
        }

        .btn-cancel {
            background: #dc3545;
            color: #fff;
        }

        .btn-cancel:hover {
            background: #b52a37;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Faculty Attendance Record</h2>

        <form action="../php/action_add_attendance.php" method="POST">
            <input type="hidden" name="schedule_id" value="<?php echo $id; ?>">

            <div class="form-grid">
                <div class="form-group">
                    <label>Faculty Name</label>
                    <input type="text" name="faculty_name" value="<?php echo $data['faculty_name']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Section</label>
                    <input type="text" name="section" value="<?php echo $data['section']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" value="<?php echo $data['subject']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Room</label>
                    <input type="text" name="room" value="<?php echo $data['room']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Day Today</label>
                    <input type="text" name="day_today" value="<?php echo date("l"); ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Time</label>
                    <input type="text" name="time" value="<?php echo $data['time_from'] . ' - ' . $data['time_to']; ?>"
                        readonly>
                </div>

                <div class="form-group">
                    <label>Attendance Date</label>
                    <input type="text" name="attendance_date" value="<?php echo $date_today; ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Learning Modality</label>
                    <input type="text" name="modality" value="<?php echo $data['learning_modality'] ?? ''; ?>" readonly>
                </div>

                <div class="form-group full">
                    <label>Online Class Meeting Link</label>
                    <input type="text" name="meeting_link" placeholder="Enter meeting link (optional)">
                </div>

                <div class="form-group">
                    <label>Faculty Attendance</label>
                    <select name="attendance_status" required>
                        <option value="">-- Select Status --</option>
                        <option value="Present">Present</option>
                        <option value="Late">Late</option>
                        <option value="Excused">Excused</option>
                        <option value="Absent">Absent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Dress Code</label>
                    <select name="dress_code" required>
                        <option value="">-- Select Dress Code --</option>
                        <option value="Casual">Casual</option>
                        <option value="Uniform">Uniform</option>
                        <option value="Jejemon">Jejemon</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label>Remarks</label>
                    <textarea name="remarks" placeholder="Enter any comments..."></textarea>
                </div>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-save">Save</button>
                <button type="button" class="btn-cancel" onclick="window.history.back();">Cancel</button>
            </div>
        </form>
    </div>
</body>

</html>