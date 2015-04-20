<?php
namespace Sef\Knot\Component;

class NameExtractor {
  
  private $classname = '';
  
  public function __construct( $classname ) {
    $this->classname = $classname;
  }
  
  public function get() {
    return $this->getHyphon();
  }
  
  public function getHyphon() {
    $word = lcfirst($this->getLastWord());   
    $uncamelcased = preg_replace('/(?<!_)([A-Z])/', '-$1', $word); // SomeRandString => Some-Rand-String, Some_Rand_String => unmodified, 
    return strtolower(str_replace( '_', '-', $uncamelcased ));
  }
  
  public function getCamelcase() {
    $word = lcfirst($this->getLastWord());
    return preg_replace('/[_]([A-Z0-9])/', '$1', $word); 
  }

  public function getPlain() {
    return $this->getLastWord();
  }
  
  private function getLastWord() {
    $allWord = explode( '\\', $this->classname );
    $lastWord =  array_pop($allWord);
    return  $lastWord ; 
  }
}