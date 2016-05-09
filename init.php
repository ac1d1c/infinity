<?php

require_once( './config.php' );

require_once( './core/InfinityEngine.php');
require_once( './core/InfinityInterface_Controller.php' );
require_once( './core/InfinityInterface_Module.php' );
require_once( './core/InfinityAbstract_Controller.php' );

foreach( glob( './module/InfinityModule_*.php' ) as $module ) {
    require_once( $module );
}

foreach( glob( './extension/InfinityExtension_*.php' ) as $extension ) {
    include_once( $extension );
}

?>