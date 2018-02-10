<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CloudSecurity";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM Writes WHERE ArticleID=" .$id. "";
$result = $conn->query($sql);

$sql = "DELETE FROM Article WHERE ID=" .$id. "";
$result = $conn->query($sql);

echo "Article Deleted";

$conn->close();
?>