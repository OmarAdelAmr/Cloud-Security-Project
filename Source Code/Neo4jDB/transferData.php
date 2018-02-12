<?php

// Connect to Neo4j Database
require_once '/usr/local/bin/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:OmarAdel12345@localhost:7687')
    ->build();

// Connect to MySQL Database
$servername = "localhost";
$username = "root";
$password = "OmarAdel12345";
$dbname = "CloudSecurity";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Transfer Data
$sql = "SELECT * FROM Author";
$MyResult = $conn->query($sql);

$query = "CREATE CONSTRAINT ON (author:Auhtor) ASSERT author.id IS UNIQUE";
$NeoResult = $client->run($query);

if ($MyResult->num_rows > 0) {
    // output data of each row
    while($row = $MyResult->fetch_assoc()) {
        $query = "CREATE (n:Author { name: '" .$row['Name']. "', id: " .$row['ID']. " })";
        $NeoResult = $client->run($query);
    }
} else {
    echo "0 results";
}


$sql = "SELECT * FROM Article";
$MyResult = $conn->query($sql);

$query = "CREATE CONSTRAINT ON (article:Article) ASSERT article.id IS UNIQUE";
$NeoResult = $client->run($query);

if ($MyResult->num_rows > 0) {
    // output data of each row
    while($row = $MyResult->fetch_assoc()) {
        $query = "CREATE (n:Article { title: '" .$row['Title']. "', content: '" .$row['Content']. "', id: " .$row['ID']. " })";
        $NeoResult = $client->run($query);
    }
} else {
    echo "0 results";
}


$sql = "SELECT * FROM Writes";
$MyResult = $conn->query($sql);

if ($MyResult->num_rows > 0) {
    // output data of each row
    while($row = $MyResult->fetch_assoc()) {
        $query = "MATCH (a:Author),(b:Article) WHERE a.id = " .$row['AuthorID']. " AND b.id = " .$row['ArticleID']. " CREATE (a)-[r:WRITES]->(b)";
        $NeoResult = $client->run($query);
    }
} else {
    echo "0 results";
}


echo "Done";

echo 
"
<br><br><a href=\"index.php\">Home<a/>
";

$conn->close();
?>