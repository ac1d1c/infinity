<?php

class InfinityModule_Log implements InfinityInterface_Module {
    public static function init() {
        if( !file_exists( './log' ) ) {
            mkdir( './log' );
        }
    }
    
    public static function write( $log_name, $log ) {
        if( isset( $log_name ) && !empty( $log_name ) ) {
            file_put_contents( './log/' . $log_name . '.log', $log . PHP_EOL, FILE_APPEND );
        }
    }
}

?>