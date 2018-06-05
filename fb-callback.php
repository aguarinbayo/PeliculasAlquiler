<?php


if (!session_id()) {
    session_start();
}else{
}

require_once __DIR__ ."/theme/Facebook/autoload.php";

if (!session_id()) {
    session_start();
}

$oFB = new Facebook\Facebook([
    'app_id'     => '638035353204558',
    'app_secret' => 'cc89f08efd8cf1afa73adddb9209689d'
]);

$helper = $oFB->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}



if ($accessToken !== null) {
    $oResponse = $oFB->get('/me?fields=id,name,email', $accessToken);

     $user=$oResponse->getGraphUser();
     $_SESSION['user']=[
          "name"=>$user['name'],
          "email"=>$user['email'],
          "id"=>$user["id"],
          "token"=>$accessToken->getValue()
     ];
     header('Location: panel.php');
    }


?>