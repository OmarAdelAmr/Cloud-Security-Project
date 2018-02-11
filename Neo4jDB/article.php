<?php

require_once '/usr/local/bin/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:OmarAdel12345@localhost:7687')
    ->build();

$id = $_GET['id'];


$query = "MATCH (ar:Article) WHERE ar.id=" .$id. " RETURN ar.title, ar.content";
$NeoResult = $client->run($query);


foreach ($NeoResult->getRecords() as $record) {
    echo "<h1>" .$record->value('ar.title'). "</h1><br><h5>" .$record->value('ar.content'). "</h5>" ;
}



echo "<button onclick=\"location.href='editArticle.php?id=" .$id. "'\">Edit</button>";
echo "<button onclick=\"location.href='deleteArticle.php?id=" .$id. "'\">Delete</button>";


?>