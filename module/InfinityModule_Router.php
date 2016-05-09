<?php

class InfinityModule_Router implements InfinityInterface_Module {
	public static $root;
	public static $url_base;
	public static $url_path;
    
    public static function init() {
        self::$root = '/';
    }
	
	public static function request( $request_url ) {
		$url = self::parseUrl( $request_url );
        
		self::$url_base = $url['base'];
		self::$url_path = $url['path'];
	}
	
	private static function parseUrl( $url ) {
		$url = parse_url( $url );
		$url_base = $url['scheme'] . '://' . $url['host'];
        $url_base .= !empty( $url['port'] ) ? ':' . $url['port'] : '';
        $url_base .= self::$root;
		$url_path = rtrim( substr( $url['path'], strlen( self::$root ) ), '/' );
		
		return array( 'base' => $url_base, 'path' => $url_path );
	}
	
	public static function redirect( $url ) {
		header( 'location: ' . $url );
	}
}

?>