<!DOCTYPE html>
<html lang="pt">
<head>
    <style>
    :root {
        --cor-tema: <?php echo get_theme_mod('cor_padrao', '#20409a'); ?>;    
    }
    </style>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">   

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wdth,wght@0,75..100,100..700;1,75..100,100..700&display=swap" rel="stylesheet">
    
    <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/solid.min.css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo get_bloginfo("template_directory"); ?>/js/controller.js" defer></script>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo( 'name' ); ?> - UFPB</title>
    <?php wp_head(); ?>
</head>
<body>
    <script>
        // Verifica se a classe está no localStorage
        var memoContraste = localStorage.getItem('xContraste');
        var memoAutismo = localStorage.getItem('xAutismo');
        var body = document.getElementsByTagName("body")[0];
        // Se a classe estiver presente, adiciona a classe "constraste"
        if (memoContraste == 1) {
        body.classList.add('contraste'); 
        }
        // Se a classe estiver presente, adiciona a classe "autismo"
        if (memoAutismo == 1) {
        body.classList.add('autismo'); 
        } 
    </script>   
    <?php 
    $header_style = get_theme_mod('header_styles', 'headerPadrao');

    get_template_part($header_style);
        
    ?>