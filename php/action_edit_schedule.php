<?php
include_once("../config.php");
include_once("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

if (isset($_POST['update'])) {
    $id = $_POST['id'] ?? '';
    $faculty_name = $_POST['faculty_name'] ?? '';
    $day = $_POST['day'] ?? '';
    $time_from = $_POST['time_from'] ?? '';
    $time_to = $_POST['time_to'] ?? '';
    $meeting_link = $_POST['meeting_link'] ?? '';

    if (!$id) {
        echo "<script>alert('Invalid schedule ID!'); window.history.back();</script>";
        exit;
    }

    $update = $db->update("schedule", $id, [
        "faculty_name" => $faculty_name,
        "day" => $day,
        "time_from" => $time_from,
        "time_to" => $time_to,
        "meeting_link" => $meeting_link
    ]);

    if ($update) {
        echo "<script>alert('Schedule updated successfully!'); window.location.href='../schedule_list.php';</script>";
    } else {
        echo "<script>alert('Error updating schedule!'); window.history.back();</script>";
    }
}
?>
