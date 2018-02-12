<?php


$id = $_GET['id'];

require_once '/usr/local/bin/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('bolt', 'bolt://neo4j:OmarAdel12345@localhost:7687')
    ->build();



$query = "MATCH (ar:Article) WHERE ar.id=" .$id. " RETURN ar.title, ar.content";
$NeoResult = $client->run($query);

$title = "";
$content = "";

foreach ($NeoResult->getRecords() as $record) {
  $title = $record->value('ar.title');
  $content = $record->value('ar.content');
}



echo 
"
<h1>Edit Article</h1><br><br>
<form method=\"post\" action=\"saveChanges.php?id=" .$id. "\">
  Article Title:<br>
  <textarea name=\"ArticleTitle\" rows=\"4\" cols=\"50\">" .$title. "</textarea><br><br>
  Content:<br>
  <textarea name=\"ArticleContent\" rows=\"20\" cols=\"100\">" .$content. "</textarea><br><br>
  <input type=\"submit\"/>
</form>
";

?>