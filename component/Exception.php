<?php
namespace Sef\Knot\Component;

class Exception extends \Exception {
  
  public function __toString() {
        
    $html = '';
    $html = '<h3> Error: ' . $this->getMessage() . '</h3><ul>';
    $html .= '<li>File: ' . $this->getFile() . '</li>';
    $html .= '<li>Line: ' . $this->getLine() . '</li>';
    
    $traces = $this->getTrace();        
    if ( !empty( $traces ) ) {
      $html .= '<li>Trace: <ul>';  
        foreach( $traces as $trace ) {
          $html .= '<li><ul>';
          $html .= (isset($trace['file'])) ? '<li>File: ' . $trace['file'] . '</li>' : '';
          $html .= (isset($trace['line'])) ? '<li>Line: ' . $trace['line'] . '</li>' : '';
          $html .= (isset($trace['class'])) ? '<li>Class: ' . $trace['class'] . '</li>' : '';
          $html .= (isset($trace['function'])) ? '<li>Function: ' . $trace['function'] . '</li>' : '';
          $html .= '</ul></li>';
        } 
      $html .='</ul></li>';            
    }
  
    $html .= '</ul>';
    
     wp_die($html);
  }
}