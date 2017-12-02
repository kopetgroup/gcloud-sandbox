<?php
/*
 * Cek Dokumentasi disini : http://googlecloudplatform.github.io/google-cloud-php/#/docs/google-cloud/v0.46.0/datastore/datastoreclient
 * - https://github.com/GoogleCloudPlatform/google-cloud-php-datastore
 */
    echo '<!DOCTYPE html>
    <html>
    <body>

    <form method="post" enctype="multipart/form-data">
      category: <input type="text" name="category" value=""/><br/>
      domain: <input type="text" name="domain" value=""/><br/>
      kiwot:<br/> <textarea name="kiwot" cols="75" rows="15"></textarea><br/>
      <input type="submit" value="Hajar"/>
    </form>

    </body>
    </html>';

# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

# Imports the Google Cloud client library
use Google\Cloud\Datastore\DatastoreClient;

# Your Google Cloud Platform project ID
$projectId = 'data-stoor';

# Instantiates a client
$datastore = new DatastoreClient([
 'projectId' => $projectId
]);

# The kind for the new entity
$kind = 'apian';

# The name/ID for the new entity
$name = 'interior';

# The Cloud Datastore key for the new entity

$query = $datastore->query();
$query->kind('apian');
//$query->limit(1);
//$query->offset(1);
//$query->filter('companyName', '=', 'Google');

$res = $datastore->runQuery($query);
$i = 1;
foreach ($res as $company) {
    echo $i.' - '.$company['title'].'<br/>'; // Google
$i++;}

# Saves the entity


if(isset($_POST)){


  $category = $_POST['category'];
  $domain = $_POST['domain'];

  //gilingan kiwot
  $kiwot = explode("\n",$_POST['kiwot']);
  $kiwot = array_unique($kiwot);
echo '<pre>';
  $ec = [];
  foreach($kiwot as $c){
    $kws = explode(' ',$c);
    $c = trim($c);
    if(count($kws)>1){

$id = sha1($c);
          $ee = [
            '_id' => $id,
            'title' => $c,
            'category' => $_POST['category'],
            'domain' => $_POST['domain'],
            'added' => date('Y-m-d H:i:s'),
            'status' => 'available'
          ];
          print_r($ee);
     
    $taskKey = $datastore->key($kind, $title);
 	$task = $datastore->entity($taskKey,$ee);
	$datastore->upsert($task);
	echo 'Saved ' . $task->key() . '<br/>';
	}
  }
}