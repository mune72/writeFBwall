<?php
//
////////////////////////////////////////////////////////////
//
// FM
// This php snippet prints a csv output of the list in mailchimp

require 'prefs.php';
$chunk_size = 4096; //in bytes

$url = 'https://us10.api.mailchimp.com/export/1.0/list?apikey='.$mcAPIkey.'&id='.$mclistID;

/** a more robust client can be built using fsockopen **/
$handle = @fopen($url,'r');
if (!$handle) {
  echo "failed to access url\n";
} else {
  $i = 0;
  $header = array();
  while (!feof($handle)) {
    $buffer = fgets($handle, $chunk_size);
    if (trim($buffer)!=''){
      $obj = json_decode($buffer);
      if ($i==0){
        //store the header row
        $header = $obj;
      } else {
        //echo, write to a file, queue a job, etc.
        echo $obj[1].",".$obj[2].",".$obj[0].",".$obj[3].",".$obj[4].",".$obj[11].",".$obj[12]."\n";
        //var_dump($header);
        //var_dump($obj);
      }
      $i++;
    }
  }
  
  fclose($handle);
}  
?>