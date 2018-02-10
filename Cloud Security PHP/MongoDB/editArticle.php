<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CloudSecurity";

$id = $_GET['id'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Article WHERE ID=" .$id. "";
$result = $conn->query($sql);

$title = "";
$content = "";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $title = $row['Title'];
        $content = $row['Content'];
    }
} else {
    echo "0 results";
}


echo 
"
<h1>Edit Article</h1><br><br>
<form method=\"post\" action=\"saveChanges.php?id=" .$id. "\">
  Article Title:<br>
  <textarea name=\"ArticleTitle\" rows=\"4\" cols=\"50\">" .$title. "</textarea><br><br>
  Content:<br>
  <textarea name=\"ArticleContent\" rows=\"20\" cols=\"100\">" .$content. "</textarea><br><br>
  <input type=\"submit\"/>
</form>
";

$conn->close();
?>