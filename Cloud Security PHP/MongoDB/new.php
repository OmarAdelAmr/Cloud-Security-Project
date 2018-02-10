<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CloudSecurity";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo 
"
<form method=\"post\" action=\"saveNewArticle.php\">
  Article Title:<br>
  <textarea name=\"ArticleTitle\" rows=\"4\" cols=\"50\">Enter Article Name</textarea><br><br>
  Content:<br>
  <textarea name=\"ArticleContent\" rows=\"20\" cols=\"100\">Enter Content</textarea><br><br>
  Author Name:<br>
  <textarea name=\"AuthorName\" rows=\"4\" cols=\"50\">Author Name</textarea><br><br>
  <input type=\"submit\"/>
</form>
";

$conn->close();
?>