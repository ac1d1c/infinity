<?php

class InfinityController_Home extends InfinityAbstract_Controller implements InfinityInterface_Controller {
    public function index( $args = array() ) {
		global $_CONFIG;
        
        // set data
        $this->setData( 'title', 'Infinity' );
        $this->setData( 'layout', 'layout/page-full.php' );
        $this->setData( 'page', 'page/home.php' );
        
        // create data buffers
        $this->createDataBuffer( 'metas' );
        $this->createDataBuffer( 'links' );
        $this->createDataBuffer( 'styles' );
        $this->createDataBuffer( 'scripts' );
        $this->createDataBuffer( 'style-main' );
        $this->createDataBuffer( 'script-main' );
        
        // render
        InfinityModule_OutputBuffer::start();
        $this->loadView( 'main/document.php' );
        $ob = InfinityModule_OutputBuffer::get();
        InfinityModule_OutputBuffer::clear();
        
        // process data buffers
        $buff_style_main = 'data:text/css;base64,' . base64_encode( implode( PHP_EOL, $this->getDataBuffer( 'style-main' ) ) );
        $buff_script_main = 'data:text/javascript;base64,' . base64_encode( implode( PHP_EOL, $this->getDataBuffer( 'script-main' ) ) );
        $buff_style_main_tag = $this->createTag( 'link', array( 'rel' => 'stylesheet', 'type' => 'text/css', 'href' => $buff_style_main ) );
        $buff_script_main_tag = $this->createTag( 'script', array( 'type' => 'text/javascript', 'src' => $buff_script_main ), ' ' );
        $this->loadDataBuffer( 'links', $buff_style_main_tag );
        $this->loadDataBuffer( 'scripts', $buff_script_main_tag );
        $meta_tags = implode( '', $this->getDataBuffer( 'metas' ) );
        $link_tags = implode( '', $this->getDataBuffer( 'links' ) );
        $style_tags = implode( '', $this->getDataBuffer( 'styles' ) );
        $script_tags = implode( '', $this->getDataBuffer( 'scripts' ) );
        
        // replace tag placeholders
        $ob = str_replace( array( '<\metas/>', '<\links/>', '<\styles/>', '<\scripts/>' ), array( $meta_tags, $link_tags, $style_tags, $script_tags ), $ob );
        $ob = InfinityExtension_MinifyHTML::minify( $ob );
        
        // render output
        InfinityModule_OutputBuffer::set( $ob );
        InfinityModule_OutputBuffer::stop();
    }
}

?>