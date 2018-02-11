<?php
$servername = "localhost";
$username = "root";
$password = "OmarAdel12345";
$dbname = "CloudSecurity";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "UPDATE Article SET Title = '" .$_POST["ArticleTitle"]. "', Content = '" .$_POST["ArticleContent"]. "' WHERE ID=" .$id. "";
$result = $conn->query($sql);

echo "Article Updated";


$conn->close();
?>