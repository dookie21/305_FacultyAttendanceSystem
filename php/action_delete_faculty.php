<?php
include_once("../config.php");
include_once("../firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

$id = $_GET['id'] ?? '';

if (!$id) {
    echo "<script>alert('Invalid faculty ID.'); window.history.back();</script>";
    exit;
}

$delete = $db->delete("faculty", $id);

if ($delete) {
    echo "<script>alert('Faculty deleted successfully!'); window.location.href='../index.php';</script>";
} else {
    echo "<script>alert('Error deleting faculty!'); window.history.back();</script>";
}
?>
