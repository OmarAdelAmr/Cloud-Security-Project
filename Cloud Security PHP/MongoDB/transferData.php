<?php

require_once 'autoloader.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:12345@localhost:7687')
    ->build();
$query = "MATCH (n) return n";
$result = $client->run($query);

foreach ($result->getRecords() as $record) {
    echo "Found";
}

?>