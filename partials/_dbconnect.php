<?php

require __DIR__ . '/../vendor/autoload.php'; 
try {
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $db = $mongoClient->taskmanager;
} catch (Exception $e) {
    die('Error connecting to MongoDB: ' . $e->getMessage());
}

 ?>
   
 
