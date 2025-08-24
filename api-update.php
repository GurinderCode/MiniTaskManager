<?php
include 'partials/_dbconnect.php';
header("content-type: application/json");
header("access-control-allow-origin: *");
$input = json_decode(file_get_contents('php://input'), true);   
$tasksCollection = $db->tasks;
  $inserttaskResult = $tasksCollection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectId($input['id'])],
    ['$set' => ['task' => $input['task']]]
);

echo json_encode($inserttaskResult);
?>
