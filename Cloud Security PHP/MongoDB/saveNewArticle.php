<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CloudSecurity";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO Article(Title, Content) VALUES('" .$_POST["ArticleTitle"]. "', '" .$_POST["ArticleContent"]. "')";
$result = $conn->query($sql);

if ($result === TRUE) 
{
    $last_id = $conn->insert_id;
    $sql = "SELECT ID FROM Author WHERE Name='" .$_POST["AuthorName"]. "';";
	$result2 = $conn->query($sql);
	if ($result2->num_rows > 0) 
	{
    	while($row = $result2->fetch_assoc()) 
    	{
        	$sql = "INSERT INTO Writes(AuthorID, ArticleID) VALUES('" .$row['ID']. "', '" .$last_id. "')";
			$result = $conn->query($sql);
    	}
	} else 
	{
    	$sql = "INSERT INTO Author(Name) VALUES('" .$_POST["AuthorName"]. "')";
		$result = $conn->query($sql);
		$last_author_id = $conn->insert_id;
		$sql = "INSERT INTO Writes(AuthorID, ArticleID) VALUES('" .$last_author_id. "', '" .$last_id. "')";
		$result = $conn->query($sql);
	}
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



echo "Article Saved";


$conn->close();
?>