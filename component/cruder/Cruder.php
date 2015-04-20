<?php
namespace Sef\Knot\Component;


// Interface or abstract class ?



abstract class Cruder {
  
  protected $config;  
  
  public function __construct( $config ) {
    $this->config = $config
  }

  public abstract function read(){}
  
  public abstract function create(){}
  
  public abstract function update(){}
  
  public abstract function delete(){}
  
  /**
   * can function.
   * 
   * @type predicate
   * @access protected
   * @param string $method (default: 'read')
   * @return bool
   */
  protected function can( $method= 'read' ){
    return true; 
  }
}