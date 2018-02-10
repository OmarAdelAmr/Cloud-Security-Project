<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CloudSecurity";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $sql = "SELECT * FROM Author";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "Name: " . $row["Name"] . "<br>";
//     }
// } else {
//     echo "0 results";
// }

// $sql = "SELECT * FROM Article";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "<a href = ''>" . $row['Title']. "</a><br>";
//     }
// } else {
//     echo "0 results";
// }

$sql = "SELECT * FROM Writes AS w INNER JOIN Author AS a ON w.AuthorID=a.ID INNER JOIN Article AS ar on ar.ID=w.ArticleID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<a href = 'article.php?id=".$row['ArticleID']."'>" . $row['Title']. " by " .$row['Name']. "</a><br>";
    }
} else {
    echo "0 results";
}

echo "<button onclick=\"location.href='new.php'\">New Article</button>";

$conn->close();
?>