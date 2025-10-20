<?php
include("../config.php");
include("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = uniqid("att_");

$insert = $db->insert("attendance", array(
    "id" => $id,
    "schedule_id" => $_POST['schedule_id'],
    "faculty_name" => $_POST['faculty_name'],
    "section" => $_POST['section'],
    "subject" => $_POST['subject'],
    "room" => $_POST['room'],
    "day" => $_POST['day'],
    "time_from" => $_POST['time_from'],
    "time_to" => $_POST['time_to'],
    "date" => date("Y-m-d"),
    "learning_modality" => $_POST['learning_modality'],
    "meeting_link" => $_POST['meeting_link'],
    "attendance_status" => $_POST['attendance_status'],
    "dress_code" => $_POST['dress_code'],
    "remarks" => $_POST['remarks'],
    "status" => "checked"
));

if ($insert) {
    echo "<script>alert('Attendance recorded successfully!'); window.location.href='../index.php';</script>";
} else {
    echo "<script>alert('Error saving attendance.');</script>";
}
?>
