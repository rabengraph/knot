<?php
namespace Sef\Knot\Component\Cruder;

class Post {

  public function read(){
    return get_posts();
  }
  
  public function create(){}
  
  public function update(){}
  
  public function delete(){}
  
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