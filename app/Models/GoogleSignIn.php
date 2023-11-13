<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class GoogleSignIn extends Model
{

  private $googleClientId;
  private $googleClientSecret;
  private $redirectUri;
  private $applicationName = 'signin';



  function __construct()
  {
    $this->googleClientId       = \config('google.google_client_id');
    $this->googleClientSecret   = \config('google.google_client_secret');
    $this->redirectUri          = base_url() . '/admin/login/';
  }



  private function googleClient()
  {
    $client = new \Google_Client();
    $client->setClientId("$this->googleClientId");
    $client->setClientSecret("$this->googleClientSecret");
    $client->setRedirectUri($this->redirectUri);
    $client->addScope('email');
    $client->addScope('profile');
    $client->setApplicationName($this->applicationName);
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    return $client;
  }



  private function verifyLogin($tokenData)
  {
    if (!isset($tokenData["email_verified"]) or !$tokenData["email_verified"]) {
      return;
    }

    return true;
  }



  private function verifyOrganization($tokenData, $authorizedOrganizations)
  {
    if (!isset($tokenData["hd"]) or !in_array($tokenData["hd"], $authorizedOrganizations)) {
      return;
    }

    return true;
  }



  public function authUrl()
  {
    $googleClient = $this->googleClient();
    $authUrl = $googleClient->createAuthUrl();
    return $authUrl;
  }



  public function getUserData($code, $authorizedOrganizations)
  {
    $googleClient = $this->googleClient();

    $accessToken = $googleClient->fetchAccessTokenWithAuthCode($code);
    $tokenData = $googleClient->verifyIdToken();

    if ($this->verifyLogin($tokenData) and $this->verifyOrganization($tokenData, $authorizedOrganizations)) {
      return $tokenData;
    }
  }
}
