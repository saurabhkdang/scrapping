<?php
include("simple_html_dom.php");

$postFields = array(
    "username" => "SD101",
    "password" => "SD101",
    "login.x" => "25",
    "login.y" => "48",
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.sdadmission.in/center/index.php");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
curl_setopt($ch, CURLOPT_COOKIEJAR, "F:\xampp\htdocs\studycenters\cookie.txt");
$response = (curl_exec($ch));

$row = [];
for ($i=1; $i<465 ; $i++) { 
    curl_setopt($ch, CURLOPT_URL, "http://www.sdadmission.in/center/update-center.php?id=".$i);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "F:\xampp\htdocs\studycenters\cookie.txt");
    $resp = (curl_exec($ch));
    
    //echo $resp;
    
    $html = new simple_html_dom(); // Create new parser instance
    $html->load($resp);
    $column = [];
    foreach($html->find('input[type=text]') as $checkbox) {
        $column[] = ($checkbox->value!=""?$checkbox->value:"--");
    }
    foreach($html->find('textarea') as $checkbox) {
        $column[] = ($checkbox->innertext!=""?$checkbox->innertext:"--");
    }
    $row[] = implode(',',$column);
}


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="centers1.csv"');

$fp = fopen('php://output', 'wb');
foreach ( $row as $line ) {
    $val = explode(",", $line);
    fputcsv($fp, $val);
}
fclose($fp);

curl_close($ch);
?>