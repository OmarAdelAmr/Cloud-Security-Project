<?php
// connect to mongodb


if (!extension_loaded('mongodb.so')) {
   dl('mongodb.so');
}

$connection = new MongoDB\Driver\Manager("mongodb://localhost:27017");



?>