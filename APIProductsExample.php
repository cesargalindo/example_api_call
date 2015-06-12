<?php
/**
 * @file
 *
 */

namespace Apigee\ManagementAPI;

use Apigee\Exceptions\ParameterException;
use Apigee\Exceptions\EnvironmentException;
use Apigee\Util\Cache;


class APIProductExample extends APIProduct
{

  protected $responseText;
  protected $responseCode;
  protected $environmentDetails;


  public function getAPIProducts($name = null, $response = null)
  {
    $name = $name ? : $this->name;
    if (!isset($response)) {
      $this->get(rawurlencode($name));
      $response = $this->responseObj;
    }
    $this->apiResources = $response['apiResources'];
    $this->approvalType = $response['approvalType'];
    $this->readAttributes($response);
    $this->createdAt = $response['createdAt'];
    $this->createdBy = $response['createdBy'];
    $this->modifiedAt = $response['lastModifiedAt'];
    $this->modifiedBy = $response['lastModifiedBy'];
    $this->description = $response['description'];
    $this->displayName = $response['displayName'];
    $this->environments = $response['environments'];
    $this->name = $response['name'];
    $this->proxies = $response['proxies'];
    $this->quota = isset($response['quota']) ? $response['quota'] : null;
    $this->quotaInterval = isset($response['quotaInterval']) ? $response['quotaInterval'] : null;
    $this->quotaTimeUnit = isset($response['quotaTimeUnit']) ? $response['quotaTimeUnit'] : null;
    $this->scopes = $response['scopes'];

    $this->loaded = true;
  }


  public function getEnvironmentDetails($environment = null)
  {
    // https://api.enterprise.apigee.com/v1/organizations/{org}/environments/{test}
    // https://api.enterprise.apigee.com/v1/o/{org}/apiproducts

    $environment = $environment ? : 'test';
    $config = $this->getConfig();
    $newBaseUrl = '/o/' . $config->orgName . '/environments/' . $environment;

    if (!isset($response)) {
      $this->setBaseUrl($newBaseUrl);
      $this->get();
      $this->restoreBaseUrl();
      $response = $this->responseObj;
    }
  }

  /**
   * Returns the raw json response text
   * available.
   *
   * @return array
   */
  public function getResponseText()
  {
    return $this->responseText;
  }

  /**
   * Returns response code
   * available.
   *
   * @return array
   */
  public function getResponseCode()
  {
    return $this->responseCode;
  }


}
