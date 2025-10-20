<?php
include_once("../config.php");
include_once("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'] ?? '';
if (!$id) {
    echo "<script>alert('Invalid schedule ID.'); window.history.back();</script>";
    exit;
}

$data = $db->retrieve("schedule/$id");
$schedule = json_decode($data, true);

if (!$schedule) {
    echo "<script>alert('Schedule record not found!'); window.history.back();</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Schedule Deletion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .confirm-box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 30px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            margin: 0 10px;
        }

        .btn-yes {
            background-color: #e53935;
            color: white;
        }

        .btn-cancel {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <div class="confirm-box">
        <h2>Confirm Deletion</h2>
        <p>
            Are you sure you want to delete this schedule?<br><br>
            <strong><?= htmlspecialchars($schedule['faculty_name']) ?></strong><br>
            <?= htmlspecialchars($schedule['day']) ?> | <?= htmlspecialchars($schedule['time_from']) ?> - <?= htmlspecialchars($schedule['time_to']) ?>
        </p>

        <div>
            <a href="../php/action_delete_schedule.php?id=<?= $id ?>"><button class="btn btn-yes">Yes, Delete</button></a>
            <button class="btn btn-cancel" onclick="window.history.back();">Cancel</button>
        </div>
    </div>
</body>

</html>
