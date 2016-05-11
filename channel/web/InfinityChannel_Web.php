<?php

class InfinityChannel_Web extends InfinityAbstract_Channel implements InfinityInterface_Channel {
    private $default_controller = 'home';
    private $default_method = 'index';
    
    public function __construct() {
        parent::init( 'web' );
    }
    
    public function request( $request_route ) {
        // select controller
        $controller = null;
        if( !empty( $request_route[0] ) && strtolower( $request_route[0] ) != $this->default_controller && $this->controllerExists( $request_route[0] ) ) {
            $controller = $this->getController( array_shift( $request_route[0] ) );
        } else {
            $controller = $this->getController( $this->default_controller );
        }
        
        // select method
        $method = null;
        if( !empty( $request_route[0] ) && strtolower( $request_route[0] ) != $this->default_method && method_exists( $controller, $request_route[0] ) ) {
            $method = strtolower( array_shift( $request_route ) );
        } else {
            $method = $this->default_method;
        }
        
        // call controller method
        $controller->$method( $request_route );
    }
}

?>