<?php $this->loadDataBuffer( 'style-main', '/* --- style/layout/page-full.css --- */' . PHP_EOL . $this->getResourceContent( 'style/layout/page-full.css' ) ); ?>
<div id="div_main" class="page-full">
    <?php $this->loadView( $this->data['page'] ); ?>
</div>