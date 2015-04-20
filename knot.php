<?php
namespace Sef;

/**
 *
/*
Plugin Name: Knot
Version: 0.0
Author: Sef

*/




/* main plugin file */
define('KNOT_FILE', (__FILE__));
define('KNOT_PATH', dirname((__FILE__)));


class Knot {
  
  const VERSION = '0.0.0';
  
  const AJAX_ACTION = 'knot';
  
  
  public function __construct(){
    add_action( 'plugins_loaded', array( $this, 'init' ));


    // listen for requests
    add_action( 'wp_ajax_' . self::AJAX_ACTION, array( $this, 'listener' ));
    add_action( 'wp_ajax_nopriv_' . self::AJAX_ACTION, array( $this, 'listener' ));   

    $this->init(); 
  }
  
  public function init() {
    require_once ( KNOT_PATH .  '/autoload.php');	
    spl_autoload_register('sef_knot_autoloader');
  }
  
  public function listener() {
  
    // get PAYLOAD
		$request = file_get_contents('php://input');
		$data = json_decode($request);
    
    if( ! $data->handler || ! $data->method )
      wp_send_json_error('missing parameter');
    
    
    $classname = __NAMESPACE__ . '\\Knot\\Handler\\' . $data->handler;
    
    $response = new Knot\Component\ClientResponse($data);
    
    $handler = new $classname();
    
    $handler->setClientResponse($response);
    $handler->read();
    
    wp_send_json_success($handler->getResponse());
    
  }
}

new Knot();



add_action( 'init', function(){
  
  $handler = new Knot\Handler\Post();
 // echo '<pre>'; print_r($handler->getName()); echo '</pre>';
   // echo '<pre>'; print_r($handler->getFields()); echo '</pre>';

});