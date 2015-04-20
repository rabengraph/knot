<?php
namespace Sef\Knot\Component;

class HandlerConfig {
  
  private $config;
  
  public function __construct( $config ) {
    $this->config = $config;
  }
  
  public function get() {
    return $this->config;
  }

  public function getFields() {
    return $this->config->fields;
  }

  public function getCruder() {
    return $this->config->cruder;
  }
}