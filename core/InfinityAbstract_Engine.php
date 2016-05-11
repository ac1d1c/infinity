<?php

abstract class InfinityAbstract_Engine {
    protected function channelExists( $channel_name ) {
        $channel_name = strtolower( $channel_name );
        $channel_class = 'InfinityChannel_' . ucfirst( $channel_name );
        if( file_exists( './channel/' . $channel_name . '/' . $channel_class . '.php' ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    protected function getChannel( $channel_name ) {
        $channel_name = strtolower( $channel_name );
        $channel_class = 'InfinityChannel_' . ucfirst( $channel_name );
        require_once( './channel/' . $channel_name . '/' . $channel_class . '.php' );
        return new $channel_class();
    }
}

?>