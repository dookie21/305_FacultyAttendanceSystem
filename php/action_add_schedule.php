<?php
include("../config.php");
include("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = uniqid("s_");


$faculty_id = $_POST['faculty'];

// Retrieve faculty data from Firebase
$facultyData = json_decode($db->retrieve("faculty/{$faculty_id}"), true);
$faculty_name = $facultyData['name'] ?? '';


$time_from = date("h:i A", strtotime($_POST['time_from']));
$time_to = date("h:i A", strtotime($_POST['time_to']));

$insert = $db->insert("schedule", array(
    "faculty_id"    => $faculty_id,
    "faculty_name"  => $faculty_name,
    "section"       => $_POST['section'],
    "subject"       => $_POST['subject'],
    "room"          => $_POST['room'],
    "modality"      => $_POST['modality'],
    "meeting_link"  => $_POST['meeting_link'],
    "day"           => $_POST['day'],
    "month_from"    => $_POST['month_from'],
    "month_to"      => $_POST['month_to'],
    "time_from"     => $time_from,
    "time_to"       => $time_to,
));

echo "<script>alert('Data Saved!'); window.location.href='../index.php';</script>";

?>