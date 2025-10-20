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
    <title>Attendance Check</title>
    <link rel="stylesheet" href="styles/attendance.css?v=1">
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .info-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 30px 40px;
            width: 420px;
            position: relative;
        }
        .info-box h3 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: 700;
            margin-bottom: 6px;
            color: #black;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 6px;
            background-color: #f9f9f9;
            font-size: 14px;
        }
        .btn-group {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
            gap: 10px;
        }
        button {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }
        .btn-attendance {
            background: #007bff;
            color: #fff;
        }
        .btn-attendance:hover {
            background: #0056b3;
        }
        .btn-close {
            background: #dc3545;
            color: #fff;
        }
        .btn-close:hover {
            background: #b52a37;
        }
    </style>
</head>

<body>
    <div class="info-box">
        <h3>Faculty Attendance</h3>

        <div class="form-group">
            <label>Date</label>
            <input type="text" value="<?php echo $date_today; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Faculty</label>
            <input type="text" value="<?php echo $data['faculty_name']; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Section</label>
            <input type="text" value="<?php echo $data['section']; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Subject</label>
            <input type="text" value="<?php echo $data['subject']; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Room</label>
            <input type="text" value="<?php echo $data['room']; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Time</label>
            <input type="text" value="<?php echo $data['time_from'] . ' - ' . $data['time_to']; ?>" readonly>
        </div>

        <div class="btn-group">
            <form action="attendance_faculty.php" method="GET">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button class="btn-attendance" type="submit" onclick="window.location.href=''">Faculty Attendance</button>
            </form>
            <button class="btn-close" onclick="window.history.back();">Close</button>
        </div>
    </div>
</body>
</html>
