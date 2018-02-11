<?php

require_once '/usr/local/bin/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:OmarAdel12345@localhost:7687')
    ->build();

$id = $_GET['id'];


$query = "MATCH (:Author)-[w:WRITES]->(ar:Article) WHERE ar.id=" .$id. " DELETE w, ar";
$NeoResult = $client->run($query);


echo "Article Deleted";

echo 
"
<br><br><a href=\"index.php\">Home<a/>
";

?>