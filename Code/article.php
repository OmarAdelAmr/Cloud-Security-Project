<?php
$servername = "localhost";
$username = "root";
$password = "OmarAdel12345";
$dbname = "CloudSecurity";

$id = $_GET['id'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Article WHERE ID=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h1>" .$row['Title']. "</h1><br><h5>" .$row['Content']. "</h5>" ;
    }
} else {
    echo "0 results";
}

echo "<button onclick=\"location.href='editArticle.php?id=" .$id. "'\">Edit</button>";
echo "<button onclick=\"location.href='deleteArticle.php?id=" .$id. "'\">Delete</button>";


$conn->close();
?>