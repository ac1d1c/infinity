<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <\metas/>
        <\links/>
        <title><?php echo $this->getData( 'title' ); ?></title>
        <\styles/>
    </head>
    <body>
        <?php $this->loadView( $this->getData( 'layout' ) ); ?>
        <\scripts/>
    </body>
</html>