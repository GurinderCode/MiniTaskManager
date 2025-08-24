<?php
include 'partials/_dbconnect.php';
header("content-type: application/json");
header("access-control-allow-origin: *");
$tasks = $db->tasks->find([]);
$tasksArray = iterator_to_array($tasks);
echo json_encode($tasksArray);
?>