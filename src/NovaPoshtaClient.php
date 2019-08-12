<?php

/**
 * @file
 * Contains NovaPoshtaClient.
 */

namespace Drupalway\NovaPoshta;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;


/**
 * NovaPoshtaClient object for executing commands against the API.
 *
 * @method array getCities(array $arguments)
 * @method array getWarehouses(array $arguments)
 *
 * @package Drupalway\NovaPoshta
 */
class NovaPoshtaClient extends GuzzleClient {

  /**
   * Gets a new NovaPoshtaClient.
   *
   * @param array $config
   *   GuzzleHttp\Command\Guzzle\GuzzleClient $config options.
   * @param array $http_config
   *   GuzzleHttp\Client $config options.
   * @param array $description Custom options to apply to the description
   *     - formatter: Can provide a custom SchemaFormatter class
   *
   * @return NovaPoshtaClient
   *   An wrapped GuzzleClient.
   */
  public static function factory($config = [], $http_config = [], $description = []) {
    $description_path = __DIR__ . '/Resources/novaposhta-json-v2.php';
    include $description_path;
    if (!empty($default_description)) {
      $default_description['operations'] += isset($description['operations']) ? $description['operations'] :[];
      $default_description['models'] += isset($description['models']) ? $description['models'] : [];
    }

    $description = new Description($default_description);
    $defaults = [];
    $config = array_merge($defaults, $config);
    $http_client = new HttpClient($http_config);
    $client = new self($http_client, $description, NULL, NULL, NULL, $config);

    return $client;
  }

}
