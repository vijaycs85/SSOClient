<?php

namespace SSOClient\Client;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use SSOClient\ClientInterface;
use GuzzleHttp\ClientInterface as HttpClientInterface;

class OpenAMClient implements ClientInterface {

  protected $httpClient;

  protected $debug;

  protected $adminToken;

  public function __construct(HttpClientInterface $http_client, $username, $password, $debug = FALSE) {
    $this->httpClient = $http_client;
    $this->debug = $debug;
    $token = $this->generateAdminToken($username, $password);
    $this->adminToken = $this->setAdminToken($token);
  }

  public static function create($http_client, $username, $password, $debug) {
    return new static (
      $http_client,
      $username,
      $password,
      $debug
    );
  }

  public function setAdminToken($token) {
    $this->adminToken = $token;
    return $this;
  }

  public function getAdminToken() {
    return $this->adminToken;
  }

  protected function generateAdminToken($username, $password) {
    return $this->authenticate($username, $password);
  }

  /**
   * {@inheritdoc}
   */
  public function authenticate($username, $password) {
    $request = $this->createRequest('/authenticate', 'GET', $this->getDefaultHeaders(), array('username' => $username, 'password' => $password));
    return $this->sendRequest($request, array('timeout' => 120));
  }

  /**
   * {@inheritdoc}
   */
  public function logout($token) {

  }

  /**
   * {@inheritdoc}
   */
  public function getCookieDomains() {

  }

  /**
   * {@inheritdoc}
   */
  public function getCookieNameForToken() {

  }

  /**
   * {@inheritdoc}
   */
  public function getCookieNamesToForward() {

  }

  /**
   * {@inheritdoc}
   */
  public function createUser() {

  }

  /**
   * {@inheritdoc}
   */
  public function getUser() {

  }

  /**
   * {@inheritdoc}
   */
  public function updateUser() {

  }

  /**
   * {@inheritdoc}
   */
  public function deleteUser() {

  }

  /**
   * {@inheritdoc}
   */
  public function listUsers() {

  }

  /**
   * {@inheritdoc}
   */
  public function changePassword() {

  }

  /**
   * {@inheritdoc}
   */
  public function getUserGroups($name) {

  }

  /**
   * {@inheritdoc}
   */
  public function addUserToGroup($username, $groupname) {

  }

  /**
   * {@inheritdoc}
   */
  public function removeUserFromGroup($username, $groupname) {

  }

  /**
   * {@inheritdoc}
   */
  public function getGroup($name) {

  }

  /**
   * {@inheritdoc}
   */
  public function getAllGroups() {

  }

  /**
   * {@inheritdoc}
   */
  public function getGroupMembers($group_name, $start_index = 0, $max_results = 1000) {

  }

  /**
   * {@inheritdoc}
   */
  public function isValidToken($token) {

  }

  /**
   * {@inheritdoc}
   */
  public function sendRequest($request, $options = array()) {
    try {
      $this->httpClient->send($request, $options);
    }
    catch(RequestException $e) {
      $this->logger()->log($e);
    }
  }

  public function createRequest($path, $method, $headers, $data) {
    return new Request($method, $path, $headers, $data);
  }

  public function getDefaultHeaders() {
    return array(

    );
  }
}