<?php

abstract class InfinityAbstract_Channel {
    private $channel_name;
    
    protected function init( $channel_name ) {
        $this->channel_name = $channel_name;
    }
    
    protected function controllerExists( $controller_name ) {
        $controller_name = ucfirst( strtolower( $controller_name ) );
        $controller_class = 'InfinityController_' . $controller_name;
        if( file_exists( './channel/' . $this->channel_name . '/controller/' . $controller_class . '.php' ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    protected function getController( $controller_name ) {
        $controller_name = ucfirst( strtolower( $controller_name ) );
        $controller_class = 'InfinityController_' . $controller_name;
        require_once( './channel/' . $this->channel_name . '/controller/' . $controller_class . '.php' );
        return new $controller_class();
    }
}

?>