<?php
namespace Sef\Knot;


abstract class Handler {
    
  protected $config = array();
  
  private $nameExtractor;

  private $reflectionClass;

  private $cruder;
    
  public function __construct() {
    
    $this->nameExtractor = new Component\NameExtractor(get_called_class());
    $this->reflectionClass = new \ReflectionClass($this);
    $this->findConfig();
    
    if( ! $this->config )
      return false;
    
    $cruderClassname = __NAMESPACE__ . '\\Component\\Cruder\\' . $this->config->getCruder();
    $this->cruder = new $cruderClassname($this->config);
    
   
    
    $this->init(); 
  }
  
  protected function init() {
    
  }
  
  private function findConfig() {

    if ( empty( $this->config )) {
      // try JSON
      if( file_exists( $file = $this->getPath() . '/' . $this->nameExtractor->getPlain() . '.json' )) {
      $json = file_get_contents($file);
      $json_d = json_decode($json, false);
        $this->config = new Component\HandlerConfig($json_d);
      }
    }    
  }
  
  public function getName() {
    return $this->nameExtractor->getCamelcase();
  }
  public function getPath() {
    return dirname($this->reflectionClass->getFileName());
  }
  public function getFields() {
    return $this->config->getFields();
  }
  public function setClientResponse( Component\ClientResponse $response ) {
    return $response;
  }
  public function getResponse() {
    return new Component\Response();
  }
  public function read() {
    $data = $this->cruder->read();  
  }
}