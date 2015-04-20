<?php
// helper functions

function sef_knot_autoloader($class) {
            
    // we are just handling classes that start with 'Sef\\Knot\'
    $names = explode("\\", $class);
    if( ( ! isset ($names[0]) ) && ( ! isset ($names[1]) ) && ('Sef' != $names[0]) && ('Knot' != $names[1]))
        return;
    
    // remove the leading 'Sef and Knot'
    array_shift($names);
    array_shift($names);

    // remove the last item, its the filename    
    $filename = array_pop($names);
           
    // try file Components/Componentname.php for Class Sef/Knot/Components/Componentname
    $file = KNOT_PATH . '/' . implode('/', $names) . '/' . $filename. '.php';
    
    // try one path higher: file Components/Componentname.php for Class Sef/Knot/Components/Componentname

    if ( ! file_exists( $file )) {
        $file = KNOT_PATH . '/' . implode('/', $names) . '/' . $filename . '/' . $filename . '.php';   
    }
    
    if ( ! file_exists($file)) 
      return false;
             
    require_once($file);
}