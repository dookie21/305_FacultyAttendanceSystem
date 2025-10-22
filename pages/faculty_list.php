<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access Denied");
}

include_once("../config.php");
include_once("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty List</title>
    <link rel="stylesheet" href="styles/faculty.css?v=1">
</head>

<body>
    <div class="faculty-container">
        <div class="faculty-header">
            <h2><u>Faculty Records</u></h2>
            <div class="actions">
                <input type="text" id="searchFaculty" placeholder="Search faculty...">
                <a href="pages/add_faculty.php"><button id="newFacultyBtn">+ Add Faculty</button></a>
            </div>
        </div>

        <table class="faculty-table" border="1">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID No</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Rank</th>
                    <th>Status</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody id="facultyTableBody">
                <?php
                $data = $db->retrieve("faculty");
                $data = json_decode($data, true);

                if (is_array($data)) {
                    $i = 1;
                    foreach ($data as $id => $faculty) {
                        echo "<tr>
                        <td>{$i}</td>
                        <td>{$faculty['id_no']}</td>
                        <td>{$faculty['name']}</td>
                        <td>{$faculty['department']}</td>
                        <td>{$faculty['rank']}</td>
                        <td>{$faculty['status']}</td>
                        <td><a href='view_faculty.php?id={$id}'>View</a></td>
                        <td><a href='pages/edit_faculty.php?id={$id}'>Edit</a></td>
                        <td><a href='confirm/delete_faculty.php?id={$id}'>Delete</a></td>
                    </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='8' style='text-align:center;'>No Records Found!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>