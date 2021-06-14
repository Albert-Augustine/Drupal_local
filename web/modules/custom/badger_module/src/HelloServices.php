<?php

/**
* @file providing the service of badgr access token.
*
*/

namespace  Drupal\badger_module;

use GuzzleHttp\ClientInterface;
use Drupal\Component\Serialization\Json;
use \Drupal\Core\Session\AccountInterface;

class HelloServices {
  /**
  * current user.
  *
  *@user \Drupal\Core\Session\AccountInterface
  */
  protected $currentUser;
  /**
  * http client.
  *
  *@user \GuzzleHttp\ClientInterface
  */
  protected $httpClient;
  /**
  * construct new badgr service objects.
  *
  *@param \GuzzleHttp\ClientInterface $http_Client
  */

  public function __construct(ClientInterface $http_client, AccountInterface $current_user) {
    $this->httpClient = $http_client;
    $this->currentUser = $current_user;
  }
  /**
  * initiating badgr
  *
  */
  public function badgr_initiate($username, $password) {
    $request =$this->httpClient->request('POST','https://api.badgr.io/o/token',[
      'form_params' =>['username' => $username, 'password' => $password],
      ]
    );
    $variables = $request->getBody()->getContents();
    $access_token = json_decode($variables)->access_token;
    $refresh_token = json_decode($variables)->refresh_token;
    $token = ['accesstoken' => $access_token, 'refreshtoken' => $refresh_token ];
    return $token;
  }
  /**
  * badgr_refresh_token
  *
  */
  public function badgr_refresh_token($refresh_token) {
    $refreshtokens = $this->httpClient->request('POST', 'https://api.badgr.io/o/token',[
      'form_params' => [
          'grant_type'=> 'refresh_token',
          'refresh_token'=> $refresh_token],
      ]);
    $value = $refreshtokens->getBody()->getContents();
    return $value;
  }
  /**
  * badgr_user_authenticate
  *
  */
  public function badgr_user_authenticate($access_token) {
    $authenticat = $this->httpClient->request('GET', 'https://api.badgr.io/v2/users/self', [
      'headers' => [
          'Authorization'=> 'Bearer ' . $access_token],
      ]);
    $detail = $authenticat->getBody()->getContents();
    return $detail;
  }
  /**
  * badgr_create_issuer
  *
  */
  public function  badgr_create_issuer($access_token, array $issuer) {
    $issuerdata = $this->httpClient->request(
      'POST',
      'https://api.badgr.io/v2/issuers', 
      [
      'headers' => ['Authorization'=> 'Bearer ' . $access_token],
      'form_params' => $issuer
      ]
    );
    $value = $issuerdata->getBody()->getContents();
    return $value;
  }
  /**
  * badgr_list_issuer
  *
  */
  public function  badgr_list_issuer($access_token) {
    $issuer_list = $this->httpClient->request('GET', 'https://api.badgr.io/v2/issuers', [
      'headers' => [
          'Authorization'=> 'Bearer ' . $access_token],
      ]);
    $list = $issuer_list->getBody()->getContents();
    return $list;
  }
  /**
  * badgr_create_issuer
  *
  */
  public function badgr_update_issuer($accessToken, array $issur_update, $id) {
    $update_Issuer = $this->httpClient->request(
      'PUT',
      'https://api.badgr.io/v2/issuers/' . $id,
      [
      'headers' => ['Authorization'=> 'Bearer ' . $accessToken],
      'form_params' => $issur_update
      ]
    );
    $update = $update_Issuer->getBody()->getContents();
    return $update;
  }
  /**
  * badgr_delete_issuer
  *
  */
  public function badgr_delete_issuer($accessToken, $id) {
    $delete_Issuer = $this->httpClient->request(
      'DELETE',
      'https://api.badgr.io/v2/issuers/' . $id,
      [
      'headers' => ['Authorization'=> 'Bearer ' . $accessToken],
      ]
    );
    $delete = $delete_Issuer->getBody()->getContents();
    return $delete;
  }
  /**
  * badgr_create_issuer_badges
  *
  */
  public function badgr_create_issuer_badges($accessToken, array $badgr) {
    $create_badge = $this->httpClient->request(
      'POST',
      'https://api.badgr.io/v2/issuers/VpXTdfPdRHaR7z3ArPVbxQ/badgeclasses',
      [
      'headers' => ['Authorization'=> 'Bearer ' . $accessToken],
      'form_params' => $badgr
      ])->getBody()->getContents();
    return $create_badge;
  }
  /**
  * badgr_list_all_badges
  *
  */
  public function badgr_list_all_badges($access_token) {
    $badgr_list = $this->httpClient->request('GET', 'https://api.badgr.io/v2/badgeclasses', [
      'headers' => [
          'Authorization'=> 'Bearer ' . $access_token],
      ]);
    $badgr = $badgr_list->getBody()->getContents();
    return $badgr;
  }
  /**
  * badgr_list_all_badges
  *
  */
  public function badgr_update_issuer_badges($accessToken, $uid, array $issuer) {
    $update_badge = $this->httpClient->request(
      'PUt',
      'https://api.badgr.io/v2/badgeclasses/' . $uid,
      [
      'headers' => ['Authorization'=> 'Bearer ' . $accessToken],
      'form_params' => $issuer
      ])->getBody()->getContents();
    return $update_badge;
  }
  /**
  * badgr_delete_issuer
  *
  */
  public function badgr_delete_issuer_badges($accessToken, $did) {
    $delete_badgr = $this->httpClient->request(
      'DELETE',
      'https://api.badgr.io/v2/badgeclasses/' . $did,
      [
      'headers' => ['Authorization'=> 'Bearer ' . $accessToken],
      ]
    );
    $delete = $delete_badgr->getBody()->getContents();
    return $delete;
  }
  /**
  * badgr_award_badges 
  *
  */
  public function badgr_award_badges($accessToken) {
    $current_time = \Drupal::time()->getCurrentTime();
    $date_output = date('d/m/Y', $current_time);

    $award_badgr = $this->httpClient->request(
      'POST',
      'https://api.badgr.io/v2/issuers/3I2tDhQLQzCX4_LhMQ5V6A/assertions',
      [
      'headers' => ['Authorization'=> 'Bearer ' . $accessToken],
      'recipient' => [
        'identity' => 'albertaugustine1477@gmail.com',
        'type' => 'email',
        'hashed' => true,
        'plaintextIdentity' => 'mybadge!'],
      'issuedOn' => [ $award_badgr ],
      ]
    );
    $award = $award_badgr->getBody()->getContents();
    return $award;
  }
}


/**
  * Code foe Execute PHP
  *
  */
 
/**

$service = \Drupal::service('badger_module.say_hello');
  $details = ['username' => 'albertaugustine1477@gmail.com', 'password' => 'Albert@123'];
  //$issuer  = ['name' => 'Albert Augustine', 'email' => 'albertaugustine1477@gmail.com', 'url' => 'http://drupalproject.local/'];
  //$update  = ['name' => 'ammu', 'email' => 'albertaugustine1477@gmail.com', 'url' => 'http://drupalproject.local/'];
  //$id = '-gLkirydRp-49N8MdZjr9g';
  //$uid = 'JOViwcMLSKKKc8gUjPsdaw';
  //$did = 'xLK6Wb5qRFaXddYCpFNs1w';



  dsm($service->badgr_initiate($details));
  $token = $service->badgr_initiate($details);
  //$retoken = $token['refreshtoken']; 
  $astoken = $token['accesstoken']; 
  //dsm($service->badgr_refresh_token($retoken));
  //dsm($service->badgr_user_authenticate($astoken));
  //dsm($service->badgr_create_issuer($astoken,$issuer));
  //dsm($service->badgr_list_issuer($astoken));
  //dsm($service->badgr_update_issuer($astoken , $update, $id));
  //dsm($service->badgr_delete_issuer($accessToken, $id));
  //dsm($service->badgr_create_issuer_badges($astoken));
  //dsm($service->badgr_list_all_badges($astoken));
  //dsm($service->badgr_update_issuer_badges($astoken, $uid));
  //dsm($service->badgr_delete_issuer_badges($astoken, $did));

 */ 