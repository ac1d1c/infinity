<?php

abstract class InfinityAbstract_Controller {
    private $channel_name;
    private $data;
    private $data_buffer = array();
    
    protected function init( $channel_name ) {
        $this->channel_name = $channel_name;
        $this->data = array();
    }
    
    // get / set
    protected function getChannel() {
        return $this->channel;
    }
    
    protected function getData( $key ) {
        if( isset( $key ) && !empty( $key ) ) {
            return $this->data[ $key ];
        }
    }
    
    protected function setData( $key, $value ) {
        if( isset( $key ) && !empty( $key ) && isset( $value ) ) {
            $this->data[ $key ] = $value;
        }
    }
    
    // data buffer
    protected function createDataBuffer( $data_buffer_name ) {
        if( !isset( $this->data_buffer[ $data_buffer_name ] ) ) {
            $this->data_buffer[ $data_buffer_name ] = array();
        }
    }
    
    protected function loadDataBuffer( $data_buffer_name, $data ) {
        if( isset( $this->data_buffer[ $data_buffer_name ] ) ) {
            array_push( $this->data_buffer[ $data_buffer_name ], $data );
        }
    }
    
    protected function getDataBuffer( $data_buffer_name ) {
        if( isset( $this->data_buffer[ $data_buffer_name ] ) ) {
            return $this->data_buffer[ $data_buffer_name ];
        }
    }
    
    // controller functions
    protected function loadView( $view ) {
        if( isset( $view ) && !empty( $view ) && file_exists( './channel/' . $this->channel_name . '/view/' . $view ) ) {
            include( './channel/' . $this->channel_name . '/view/' . $view );
        }
    }
    
    protected function getResourceContent( $resource ) {
        if( isset( $resource ) && !empty( $resource ) && file_exists( './channel/' . $this->channel_name . '/resource/' . $resource ) ) {
            InfinityModule_OutputBuffer::save();
            InfinityModule_OutputBuffer::clear();
            include_once( './channel/' . $this->channel_name . '/resource/' . $resource );
            $resource_content = InfinityModule_OutputBuffer::get();
            InfinityModule_OutputBuffer::restore();
            return $resource_content;
        }
    }
    
    protected function getAssetContent( $asset ) {
        if( isset( $asset ) && !empty( $asset ) && file_exists( './asset/' . $asset ) ) {
            InfinityModule_OutputBuffer::save();
            InfinityModule_OutputBuffer::clear();
            include_once( './asset/' . $asset );
            $asset_content = InfinityModule_OutputBuffer::get();
            InfinityModule_OutputBuffer::restore();
            return $asset_content;
        }
    }
    
    protected function createTag( $name, $attributes = array(), $content = '' ) {
        if( isset( $name ) && !empty( $name ) ) {
            $name = strtolower( $name );
            
            $attr = '';
            if( count( $attributes ) > 0 ) {
                $attr = ' ' . implode( ' ', array_map(
                    function( $v, $k ) {
                        return $k . '="' . $v . '"';
                    }, 
                    $attributes, 
                    array_keys( $attributes )
                ) );
            }
            
            $tag = '';
            if( !empty( $content ) ) {
                $tag = '<' . $name . $attr . '>' . $content . '</' . $name . '>';
            } else {
                $tag = '<' . $name . $attr . '/>';
            }
            return $tag;
        } else {
            return '';
        }
    }
}


/*
class InfinityController {
	protected $channel;
    protected $data;
    
    public function __construct( $channel_name ) {
        $this->channel_name = $channel;
    }
	
	protected function loadView( $view, $data = [] ) {
        if( isset( $view ) && !empty( $view ) && file_exists( './channel/' . $this->channel_name . '/view/' . $view ) ) {
            require( './channel/' . $this->channel_name . '/view/' . $view );
        }
	}
    
	protected function getModel( $model ) {
        if( isset( $model ) && !empty( $model ) && file_exists( './channel/' . $this->channel_name . '/model/' . $model . '.php' ) ) {
            require_once( './channel/' . $this->channel_name . '/model/' . $model . '.php' );
            $model = 'Model_' . ucfirst( $model );
            $model = new $model;
            return $model;
        } else {
            return null;
        }
	}
	
	protected function getAssetLink( $asset ) {
        if( isset( $asset ) && !empty( $asset ) && file_exists( './asset/' . $asset ) ) {
            return Module_Router::getUrlBase() . Module_Router::getUrlRoot() . 'asset/' . $asset;
        } else {
            return '';
        }
	}
	
	protected function getResourceContent( $resource ) {
        if( isset( $resource ) && !empty( $resource ) && file_exists( './channel/' . $this->channel_name . '/resource/' . $resource ) ) {
            ob_start();
            include_once( './channel/' . $this->channel_name . '/resource/' . $resource );
            return ob_get_clean();
        } else {
            return '';
        }
	}
	
	protected function getResourceBase64( $resource ) {
        if( isset( $resource ) && !empty( $resource ) && file_exists( './channel/' . $this->channel_name . '/resource/' . $resource ) ) {
            $finfo = finfo_open( FILEINFO_MIME );
            $mime = finfo_file( $finfo, './channel/' . $this->channel_name . '/resource/' . $resource );
            finfo_close( $finfo );
            $mime = substr( $mime, 0, strpos( $mime, ';' ) );
            return 'data:' . $mime . ';base64,' . base64_encode( $this->getResourceContent( $resource ) );
        } else {
            return '';
        }
	}
    
    protected function buildTag( $name, $attributions = [], $content = '', $close_tag = false ) {
        if( isset( $name ) && !empty( $name ) ) {
            $name = strtolower( $name );
            
            $attr = '';
            if( count( $attributions ) > 0 ) {
                $attr = ' ' . implode( ' ', array_map(
                    function( $v, $k ) {
                        return $k . '="' . $v . '"';
                    }, 
                    $attributions, 
                    array_keys( $attributions )
                ) );
            }
            
            $tag = '';
            if( $close_tag === true ) {
                $tag = '<' . $name . $attr . '>' . $content . '</' . $name . '>';
            } else if( $close_tag === false ) {
                $tag = '<' . $name . $attr . '/>';
            }
            return $tag;
        } else {
            return '';
        }
    }
}
*/

?>