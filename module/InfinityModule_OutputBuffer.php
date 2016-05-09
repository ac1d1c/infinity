<?php

class InfinityModule_OutputBuffer implements InfinityInterface_Module {
    private static $buffer;
    
    public static function init() {
        self::$buffer = '';
    }
    
	public static function start() {
        ob_start();
	}
	
	public static function stop() {
        ob_end_flush();
	}
	
	public static function clear() {
        ob_clean();
	}
	
	public static function send() {
        ob_flush();
	}
	
	public static function pause() {
        self::$buffer = self::get();
        self::clear();
        self::stop();
	}
	
	public static function resume() {
        self::start();
        self::restore();
	}
	
	public static function save() {
        self::$buffer = self::get();
	}
	
	public static function restore() {
        self::set( self::$buffer );
	}
	
	public static function get() {
        return ob_get_contents();
	}
	
	public static function set( $ob ) {
        self::clear();
        echo $ob;
	}
}

?>