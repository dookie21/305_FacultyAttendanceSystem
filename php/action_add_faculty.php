<?php
include("../config.php");
include("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = uniqid("f_");

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$name = $lastname . ", " . $firstname . " " . $middlename;

$insert = $db->insert("faculty", array(
    "id_no"       => $id,
    // "lastname"    => $_POST['lastname'],
    // "firstname"   => $_POST['firstname'],
    // "middlename"  => $_POST['middlename'],
    "name" => $name,
    "gender"      => $_POST['gender'],
    "rank"        => $_POST['rank'],
    "status"      => $_POST['status'],
    "department"  => $_POST['department']
));

echo "<script>alert('Data Saved!'); window.location.href='../index.php';</script>";
?>

