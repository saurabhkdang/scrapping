<?php
ini_set('memory_limit', '-1');
require_once 'simple_html_dom.php';
// Construct an HTTP POST request
$clientlogin_url = "http://www.sdadmission.in/center/index.php";
$clientlogin_post = array(
    "username" => "SD101",
    "password" => "SD101"
);

// Initialize the curl object
$curl = curl_init($clientlogin_url);

// Set some options (some for SHTTP)
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $clientlogin_post);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_COOKIEFILE, "F:\xampp\htdocs\studycenters\cookie.txt");
curl_setopt($curl, CURLOPT_COOKIEJAR, "F:\xampp\htdocs\studycenters\cookie.txt");

// Execute
$response = curl_exec($curl);

echo $response;
exit;

// Get the Auth string and save it
/* preg_match("/Auth=([a-z0-9_\-]+)/i", $response, $matches);
$auth = $matches[1];

echo "The auth string is: " . $auth;
// Include the Auth string in the headers
// Together with the API version being used
$headers = array(
    "Authorization: GoogleLogin auth=" . $auth,
    "GData-Version: 3.0",
); */


$url = 'http://www.sdadmission.in/center/update-center.php?id=1';
$curl = curl_init();
// Make the request
curl_setopt($curl, CURLOPT_URL, $url );
//curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_COOKIEFILE, "F:\xampp\htdocs\studycenters\cookie.txt");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($curl);
curl_close($curl);

$html = new simple_html_dom(); // Create new parser instance
$html->load($response);

foreach($html->find('input[type=text]') as $checkbox) {
    print_r($checkbox->value);
    /* if ($checkbox->checked)
        echo $checkbox->name . ' is checked<br>';
    else
        echo $checkbox->name . ' is not checked<br>'; */
}