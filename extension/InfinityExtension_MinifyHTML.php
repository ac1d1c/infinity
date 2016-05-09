<?php

class InfinityExtension_MinifyHTML {
    public static function minify( $src ) {
        $search = array( '/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/\> +\</s' );
        $replace = array( '>', '<', '\\1', '><' );
        $src = preg_replace( $search, $replace, $src );
        return $src;
    }
}

?>