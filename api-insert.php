<?php
header("content-type: application/json");
header("access-control-allow-origin: *");
header("access-control-allow-methods: POST");
header("access-control-allow-headers: access-control-allow-headers, access-control-allow-methods, content-type, access-control-allow-origin");
include 'partials/_dbconnect.php';
$data = json_decode(file_get_contents("php://input"), true);
    $task = $data['task'];
    $tasksCollection = $db->tasks;
    $newtask = [
        'task' => $task,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];
$inserttaskResult = $tasksCollection->insertOne($newtask);
?>