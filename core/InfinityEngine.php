<?php

class InfinityEngine {
	public function __construct() {
		global $_CONFIG;
        
        // init modules
        foreach( get_declared_classes() as $class_name ) {
            if( substr( $class_name, 0, strlen( 'InfinityModule_' ) ) == 'InfinityModule_' ) {
                $class_name::init();
            }
        }
        
		// routing
		InfinityModule_Router::$root = $_CONFIG['engine_root_dir'];
        InfinityModule_Router::request( $_SERVER['REDIRECT_URL'] );
        $request_route = explode( '/', InfinityModule_Router::$url_path );
        
        // select channel
        $default_channel = 'web';
        $channel_name = '';
        if( !empty( $request_route[0] )
        && $request_route[0] != $default_channel
        && file_exists( './channel/' . strtolower( $request_route[0] ) )
        && is_dir( './channel/' . strtolower( $request_route[0] ) ) ) {
            $channel_name = strtolower( array_shift( $request_route ) );
        } else {
            $channel_name = $default_channel;
        }
        
        // select controller
        $default_controller = 'home';
        $controller_name = '';
        if( !empty( $request_route[0] )
        && $request_route[0] != $default_controller
        && file_exists( './channel/' . $channel_name . '/controller/InfinityController_' . ucfirst( strtolower( $request_route[0] ) ) . '.php' ) ) {
            $controller_name = strtolower( array_shift( $request_route ) );
        } else {
            $controller_name = $default_controller;
        }
        $controller_class = 'InfinityController_' . ucfirst( $controller_name );
        require_once( './channel/' . $channel_name . '/controller/' . $controller_class . '.php' );
        $controller = new $controller_class( $channel_name );
        
        // select method
        $default_method = 'index';
        $method_name = '';
        if( !empty( $request_route[0] )
        && $request_route[0] != $default_method
        && method_exists( 'InfinityController_' . ucfirst( $controller_name ), strtolower( $request_route[0] ) ) ) {
            $method_name = strtolower( array_shift( $request_route ) );
        } else {
            $method_name = $default_method;
        }
        $controller->$method_name( $request_route );
	}
}

?>