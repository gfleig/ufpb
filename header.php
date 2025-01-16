<!DOCTYPE html>
<html>
<head>
    <style>
    :root {
        --cor-tema: <?php echo get_theme_mod('cor_padrao', '#102d69'); ?>;    
    }
    </style>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
        
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wdth,wght@0,75..100,300..800;1,75..100,300..800&display=swap" rel="stylesheet">

    <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/fontawesome.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/brands.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/solid.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo("template_directory"); ?>/assets/fontawesome6/css/regular.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo get_bloginfo("template_directory"); ?>/js/controller.js"></script>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo get_bloginfo( 'name' ); ?> - UFPB</title>
    <?php wp_head(); ?>
</head>
<body lang="pt" class="">
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
    <div class="container">
        <div class="topo camada-1">
            <div id="cabecalho-id" class="cabecalho-wrapper">
                <div class="cabecalho">
                    <div class="cabecalho-esquerda">
                        
                        <?php the_custom_logo(); ?>
                        <div class="site-titulos">
                            <a target="_blank" rel="noopener noreferrer" href="<?php $custom_urlcentro = esc_url(get_theme_mod('custom_urlcentro', 'https://www.ufpb.br')); echo esc_url($custom_urlcentro) ?>" class="centro-titulo">
                                <?php $custom_centro = get_theme_mod('custom_centro', 'Universidade Federal da Paraíba'); echo esc_html($custom_centro);?>
                            </a>
                            <a href="<?php echo get_home_url(); ?>" class="departamento-titulo"><?php echo get_bloginfo( 'name' ); ?></a>
                        </div>
                    </div>
                    <a target="_blank" rel="noopener noreferrer" href="http://ufpb.br" class="brasao">
                        <div class="ufpb-nome">UNIVERSIDADE<br>FEDERAL<br>DA PARAÍBA</div>
                        <!--img src="<?php echo get_bloginfo("template_directory"); ?>/img/SVG final.svg"-->
                        <img src="<?php echo get_bloginfo("template_directory"); ?>/img/brasao_gradiente.png">
                    </a>
                </div>
            </div>
                        
        </div> 
        <div id="menu-nav" class="menu-wrapper">
            <div class="menu">
                <button type="nav" id="hamburger">
                    <i id="hamburger-botao" class="fa-solid fa-bars"></i>
                    <div>Menu</div>
                </button>                         
                <ul id="desktop-menu">
                    <?php 
                        wp_nav_menu(   
                            array ( 
                                'theme_location' => 'main-menu',
                                'items_wrap' => '%3$s',
                                'container' => false,
                            ) 
                        ); 
                    ?>
                </ul>            
                <div class="busca-teste hidden" id="busca-barra">                    
                    <div>
                        <?php get_search_form(); ?>
                        <!--form action="">
                            <input type="search" placeholder="O que você procura?">                            
                            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <button type="button" id="busca-fecha"><i class="fa-solid fa-xmark"></i></button>
                        </form-->
                        <button type="button" id="busca-fecha"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
                <div id="menu-buttons">
                    <button id="busca"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <a href="javascript:void(0);" onclick="altoContraste();"><i title="Alto Constraste" class="fa-solid fa-circle-half-stroke"></i></a>
                    <a href="javascript:void(0);" onclick="autismo();"><i title="Cores Acessíveis" class="fa-solid fa-ribbon"></i></a>
                    
                    

                </div>
            </div>      
        </div>
        <div id="menu-overlay" class="top-fixed-overlay menu-hidden">
            <ul id="mobile-menu">            
                <?php 
                    wp_nav_menu(   
                        array ( 
                            'theme_location' => 'main-menu',
                            'items_wrap' => '%3$s',
                            'container' => false,
                        ) 
                    ); 
                ?>				
            </ul>
        </div>