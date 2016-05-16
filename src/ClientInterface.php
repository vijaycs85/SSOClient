<?php

namespace SSOClient;

use GuzzleHttp\ClientInterface as HttpClientInterface;

/**
 * Client interface for sending HTTP requests.
 */
interface ClientInterface
{

  public function __construct(HttpClientInterface $http_client, $username, $password, $debug = FALSE);
  // 1. User authentication resource.
  // 1.1 Authenticate.
  public function authenticate($username, $password);

  // 1.2 Logout.
  public function logout($token);


  // 2. User resource.

  // 2.1
  public function createUser();

  public function getUser();

  public function updateUser();

  public function deleteUser();

  public function listUsers();

  public function changePassword();

  public function getUserGroups($name);

  public function addUserToGroup($username, $groupname);

  public function removeUserFromGroup($username, $groupname);

  // 3. Group resource.

  // 3.1

  public function getGroup($name);

  public function getAllGroups();

  public function getGroupMembers($group_name, $start_index = 0, $max_results = 1000);


  // 4. Token resource.
  public function isValidToken($token);


  // 5. Cookie resource.
  public function getCookieDomains();

  public function getCookieNameForToken();

  public function getCookieNamesToForward();


  public function sendRequest($request);
}