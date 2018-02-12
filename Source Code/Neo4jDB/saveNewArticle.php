<?php

require_once '/usr/local/bin/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:OmarAdel12345@localhost:7687')
    ->build();

// $_POST["AuthorName"]
// $_POST["ArticleTitle"]
// $_POST["ArticleContent"]


$query = "MATCH (au:Author) WHERE au.name='" .$_POST["AuthorName"]. "' RETURN au.id";
$NeoResult = $client->run($query);


if (sizeof($NeoResult->getRecords()) == 0)
{
	$query = "MATCH (au:Author) RETURN au.id ORDER BY au.id DESC LIMIT 1";
	$NeoResult = $client->run($query);
	$last_author_id = 0;
	foreach ($NeoResult->getRecords() as $record) {
    	$last_author_id = $record->value('au.id');
	}
	$last_author_id++;

	$query = "MATCH (ar:Article) RETURN ar.id ORDER BY ar.id DESC LIMIT 1";
	$NeoResult = $client->run($query);
	$last_article_id = 0;
	foreach ($NeoResult->getRecords() as $record) {
    	$last_article_id = $record->value('ar.id');
	}
	$last_article_id++;


	$query = "CREATE (n:Article { title: '" .$_POST["ArticleTitle"]. "', content: '" .$_POST["ArticleContent"]. "', id: " .$last_article_id. " })";
	$NeoResult = $client->run($query);

	$query = "CREATE (n:Author { name: '" .$_POST["AuthorName"]. "', id: " .$last_author_id. " })";
	$NeoResult = $client->run($query);

	$query = "MATCH (a:Author),(b:Article) WHERE a.id = " .$last_author_id. " AND b.id = " .$last_article_id. " CREATE (a)-[r:WRITES]->(b)";
        $NeoResult = $client->run($query);
	
} else
{
	$author_id = 0;
	foreach ($NeoResult->getRecords() as $record) {
    	$author_id = $record->value('au.id');
	}



	$query = "MATCH (ar:Article) RETURN ar.id ORDER BY ar.id DESC LIMIT 1";
	$NeoResult = $client->run($query);
	$last_article_id = 0;
	foreach ($NeoResult->getRecords() as $record) {
    	$last_article_id = $record->value('ar.id');
	}
	$last_article_id++;

	$query = "CREATE (n:Article { title: '" .$_POST["ArticleTitle"]. "', content: '" .$_POST["ArticleContent"]. "', id: " .$last_article_id. " })";
	$NeoResult = $client->run($query);

	$query = "MATCH (a:Author),(b:Article) WHERE a.id = " .$author_id. " AND b.id = " .$last_article_id. " CREATE (a)-[r:WRITES]->(b)";
        $NeoResult = $client->run($query);
	
}

echo "Article Saved";

echo 
"
<br><br><a href=\"index.php\">Home<a/>
";

?>