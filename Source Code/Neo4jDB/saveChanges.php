<?php

require_once '/usr/local/bin/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:OmarAdel12345@localhost:7687')
    ->build();


$id = $_GET['id'];

$query = "MATCH (ar:Article) WHERE ar.id=" .$id. " SET ar.title='" .$_POST["ArticleTitle"]. "', ar.content='" .$_POST["ArticleContent"]. "'";
$NeoResult = $client->run($query);



echo "Article Updated";

echo 
"
<br><br><a href=\"index.php\">Home<a/>
";

?>