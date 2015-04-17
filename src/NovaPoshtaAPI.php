<?php

/**
 * @file
 * Contains NovaPoshtaClient.
 */

namespace Drupalway\NovaPoshta;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;
use Drupalway\NovaPoshta\Subscriber\NovaPoshtaResponse;

/**
 * Guzzle driven service client for the NovaPoshta API.
 */
class NovaPoshtaAPI extends GuzzleClient {

  /**
   * Attach service description from JSON.
   */
  public static function factory($config = array(), $httpConfig = array()) {
    $description_path = __DIR__ . '/Resources/novaposhta.json';
    $description = new Description(json_decode(file_get_contents($description_path), TRUE));

    $defaults = array();

    $config = array_merge($defaults, $config);

    $httpClient = new HttpClient($httpConfig);

    $client = new self($httpClient, $description, $config);

    // Move "data" response param out.
    $client->getEmitter()->attach(new NovaPoshtaResponse());

    return $client;
  }

}
