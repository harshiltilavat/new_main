<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>

    <link rel="icon" href="data:;base64,iVBORw0KGgo=" />

    <?php wp_head(); ?>
</head>
<body>

<header>

<div class = "container">
<?php

    wp_nav_menu(array(

        'theme_location' => 'nav-menu',
        'menu_class' => 'top-bar'

    ));

?>
</div>

</header>
    
