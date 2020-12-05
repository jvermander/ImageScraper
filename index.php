<!-- Image Crawler -->
<?php 
  require_once 'vendor/autoload.php';
  include 'quickstart.php';

  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);

  $html = shell_exec('./phantomjs gethtml.js');
  preg_match_all('/<picture.*?<img alt="(.*?)" src="(.*?)"/', $html, $matches, PREG_PATTERN_ORDER);

  $FOLDER_ID = '1VZ9teYxoS8vu3nJhZY1sTR9_rFMOtYD7';

  for($i = 0; $i < sizeof($matches[1]); $i++) {
    $url = $matches[2][$i];
    preg_match_all('/^.*\.(jpg|jpeg|png)$/', $url, $ext);
    $filename = $matches[1][$i] . '.' . $ext[1][0];
    $filedata = file_get_contents($url);

    $file = new Google_Service_Drive_DriveFile();
    $file->setName($filename);
    $file->setParents(array($FOLDER_ID));
  
    $result = $service->files->create(
      $file, 
      array('data' => $filedata, 
            'mimeType' => $ext[1][0] === 'png'? 'image/png' : 'image/jpeg', 
            'uploadType' => 'media'
    ));
  }
?>