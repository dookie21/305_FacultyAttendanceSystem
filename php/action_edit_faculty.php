<?php
include_once("../config.php");
include_once("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_POST['id'];
$data = [
    "id_no" => $_POST['id_no'],
    "name" => $_POST['name'],
    "department" => $_POST['department'],
    "rank" => $_POST['rank'],
    "status" => $_POST['status']
];

$update = $db->update("faculty", $id, $data);

if ($update) {
    echo "<script>alert('Faculty updated successfully!'); window.location.href='../faculty_list.php';</script>";
} else {
    echo "<script>alert('Error updating faculty!'); window.history.back();</script>";
}
?>
