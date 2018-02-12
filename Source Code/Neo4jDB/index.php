<?php
// Connect to Neo4j Database
require_once '/usr/local/bin/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:OmarAdel12345@localhost:7687')
    ->build();




$query = "MATCH (au:Author)-[:WRITES]->(ar:Article) return au.name, ar.title, ar.id";
$NeoResult = $client->run($query);

foreach ($NeoResult->getRecords() as $record) {
    echo "<a href = 'article.php?id=".$record->value('ar.id'). "'>" .$record->value('ar.title'). " by " .$record->value('au.name'). "</a><br>";
}

echo "<button onclick=\"location.href='new.php'\">New Article</button>";



?>