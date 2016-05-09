<?php

class InfinityModule_Cache implements InfinityInterface_Module {
    public static function init() {
        if( !file_exists( './cache' ) ) {
            mkdir( './cache' );
        }
    }
    
    public static function exists( $cache_name ) {
        if( isset( $cache_name ) && !empty( $cache_name ) && file_exists( './cache/' . $cache_name . '.cache' ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function create( $cache_name ) {
        if( isset( $cache_name ) && !empty( $cache_name ) ) {
            file_put_contents( './cache/' . $cache_name . '.cache', '' );
        }
    }
    
    public static function delete( $cache_name ) {
        if( isset( $cache_name ) && !empty( $cache_name ) && file_exists( './cache/' . $cache_name . '.cache' ) ) {
            unlink( './cache/' . $cache_name . '.cache', '' );
        }
    }
    
    public static function get( $cache_name ) {
        if( isset( $cache_name ) && !empty( $cache_name ) && file_exists( './cache/' . $cache_name . '.cache' ) ) {
            return file_get_contents( './cache/' . $cache_name . '.cache', '' );
        } else {
            return '';
        }
    }
    
    public static function set( $cache_name, $content ) {
        if( isset( $cache_name ) && !empty( $cache_name ) && file_exists( './cache/' . $cache_name . '.cache' ) ) {
            file_put_contents( './cache/' . $cache_name . '.cache', $content );
        }
    }
}

?>