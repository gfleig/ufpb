<div class="topo portal" id="cabecalho-id">
        <div class="cabecalho width-wrapper">            
            <a rel="noopener noreferrer" href="<?php echo get_home_url(); ?>" class="brasao">
                <img src="<?php echo get_bloginfo("template_directory"); ?>/img/marca.png">
            </a>
            <div>
                <div id="menu-buttons">
                    <button id="busca"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <a href="javascript:void(0);" onclick="altoContraste();"><i title="Alto Constraste" class="fa-solid fa-circle-half-stroke"></i></a>
                    <a href="javascript:void(0);" onclick="autismo();"><i title="Cores Acessíveis" class="fa-solid fa-ribbon"></i></a> 
                    <div class="busca-teste hidden" id="busca-barra">                    
                        <div>
                            <?php get_search_form(); ?>                    
                            <button type="button" id="busca-fecha"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                    </div>
                </div>
                <div class="menu-wrapper" id="menu-nav-portal">
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
                    </div>
                </div> 
            </div>
        </div>
        
                    
    </div> 
         
</div>

<?php if(!is_home()) summon_banner_top(); ?>

<?php if(is_home()) : ?>

<section aria-label="Carrossel">    
    <div class="carrossel" data-carrossel>        
        <ul data-slides>
            <li class="slide" data-active>
                <div class="width-wrapper">
                    <div class ="slide-texto-box">
                        <h2 class="">
                            <?php echo esc_html(get_theme_mod('heroimage_titulo', 'Título massa da Hero Image!')); ?>
                        </h2>
                        <div class="texto">
                            <?php echo esc_html(get_theme_mod('heroimage_subtitulo', 'Subtítulo interessante, mantenha ele curto, por favor…')); ?>
                        </div>
                        <a href="
                            <?php echo esc_url(get_theme_mod('heroimage_link_url', 'https://www.ufpb.br')); ?>
                        " class="mais-link linha-acima linha-abaixo">
                            <?php echo esc_html(get_theme_mod('heroimage_link_titulo', 'Descubra Mais')); ?>
                        </a>
                    </div>                    
                </div>                
                <img src="<?php echo get_heroimage_url(); ?>" alt="<?php echo image_alt_by_url(get_heroimage_url()); ?>">
            </li>            
        </ul>
    </div>
</section>

<?php endif ?>

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