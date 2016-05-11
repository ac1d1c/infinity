<?php

class InfinityEngine extends InfinityAbstract_Engine {
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
        $channel = null;
        if( $this->channelExists( $request_route[0] ) ) {
            $channel = $this->getChannel( array_shift( $request_route ) );
        } else {
            $channel = $this->getChannel( $_CONFIG['engine_default_channel'] );
        }
        
        $channel->request( $request_route );
	}
}

?>