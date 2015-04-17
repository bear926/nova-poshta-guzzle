<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 03.04.15
 * Time: 18:22
 */

namespace Drupalway\NovaPoshta\Subscriber;

use GuzzleHttp\Command\Event\ProcessEvent;
use GuzzleHttp\Event\SubscriberInterface;

class NovaPoshtaResponse implements SubscriberInterface {

  public function getEvents() {
    // Fire the event last, after signing
    return array('process' => array('onProcess', 'last'));
  }

  public function onProcess(ProcessEvent $event) {
    $result = $event->getResult();
    !isset($result['data']) ?: $event->setResult($result['data']);
  }

}