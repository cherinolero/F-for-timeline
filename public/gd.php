<?php 

session_start();
echo getcwd();

require_once '../vendor/google-api-php-client/autoload.php'; // or wherever autoload.php is located
require_once '../config/GAPI_config.php';

$client_id = $GAPI_config['client_id'];
$client_secret = $GAPI_config['client_secret'];
$redirect_uri = $GAPI_config['redirect_uri_gd'];
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/drive");
$client->addScope("https://spreadsheets.google.com/feeds");

$service = new Google_Service_Drive($client);


if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
}

/************************************************
 If we have a code back from the OAuth 2.0 flow,
 we need to exchange that with the authenticate()
 function. We store the resultant access token
 bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}


/************************************************
 If we have an access token, we can make
 requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
} else {
    $authUrl = $client->createAuthUrl();
}


    ?>
<div class="box">
  <div class="request">
<?php
if (isset($authUrl)) {
  echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
} else {
  echo "<a class='logout' href='?logout'>Logout</a>";
}
?>
  </div>

  <div class="data">
<?php 
if (isset($token_data)) {
  var_dump($token_data);
}
?>
  </div>
</div>
<?php
// echo pageFooter(__FILE__);





/**
 * Retrieve a list of File resources.
 *
 * @param Google_DriveService $service Drive API service instance.
 * @return Array List of Google_DriveFile resources.
 */
function retrieveAllFiles($service) {
    $result = array();
    $pageToken = NULL;

    do {
        try {
            $parameters = array();
            if ($pageToken) {
                $parameters['pageToken'] = $pageToken;
                print_r($parameters);
            }
            $files = $service->files->listFiles($parameters);
            print_r($files);
            $result = array_merge($result, $files->getItems());
            $pageToken = $files->getNextPageToken();
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
            $pageToken = NULL;
        }
    } while ($pageToken);
    return $result;
}

$result = retrieveAllFiles($service);
echo "<pre>";
print_r($result);
echo "</pre>";