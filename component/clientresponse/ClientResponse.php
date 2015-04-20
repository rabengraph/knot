<?php
namespace Sef\Knot\Component;

class ClientResponse {
  
  private $data;
  
  public function __construct( $data ) {
    $this->data = $data;
  }

}