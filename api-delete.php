<?php
include 'partials/_dbconnect.php';
header("content-type: application/json");
header("access-control-allow-origin: *");
$input = json_decode(file_get_contents('php://input'), true);   
$tasksCollection = $db->tasks;
$deleteTaskResult = $tasksCollection->deleteOne(
   ['_id' => new MongoDB\BSON\ObjectId($input['id'])],
);
echo json_encode($deleteTaskResult);
?>
