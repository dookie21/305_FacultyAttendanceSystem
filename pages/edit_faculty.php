<?php
include_once("../config.php");
include_once("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'] ?? '';
$data = $db->retrieve("faculty/$id");
$faculty = json_decode($data, true);

if (!$faculty) {
    echo "<script>alert('Faculty record not found!'); window.location.href='../faculty_list.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty</title>
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
        <h2>Edit Faculty</h2>
        <form method="post" action="../php/action_edit_faculty.php">
            <input type="hidden" name="id" value="<?= $id ?>">

            <div>
                <label for="id_no">ID Number</label>
                <input type="text" name="id_no" id="id_no" value="<?= htmlspecialchars($faculty['id_no']) ?>" required>
            </div>

            <div>
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($faculty['name']) ?>" required>
            </div>

            <div>
                <label for="department">Department</label>
                <input type="text" name="department" id="department" value="<?= htmlspecialchars($faculty['department']) ?>" required>
            </div>

            <div>
                <label for="rank">Rank</label>
                <input type="text" name="rank" id="rank" value="<?= htmlspecialchars($faculty['rank']) ?>" required>
            </div>

            <div>
                <label for="status">Status</label>
                <select name="status" id="status" required>
                    <option value="">Select Status</option>
                    <option value="Active" <?= $faculty['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                    <option value="Inactive" <?= $faculty['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <div class="form-actions">
                <input type="submit" value="Update">
                <input type="button" value="Cancel" onclick="window.history.back();">
            </div>
        </form>
    </div>
</body>

</html>
