<div class="topo" id="cabecalho-id">
        <div class="cabecalho width-wrapper">
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
                <img src="<?php echo get_bloginfo("template_directory"); ?>/img/brasao_beta.png">
            </a>
        </div>
        
                    
    </div> 
    <div class="menu-wrapper" id="menu-nav">
        <div class="menu width-wrapper">
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
            
            <div id="menu-buttons">
                <button id="busca"><i class="fa-solid fa-magnifying-glass"></i></button>
                <a href="javascript:void(0);" onclick="altoContraste();"><i title="Alto Constraste" class="fa-solid fa-circle-half-stroke"></i></a>
                <a href="javascript:void(0);" onclick="autismo();"><i title="Cores Acessíveis" class="fa-solid fa-ribbon"></i></a> 
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
            </div>
        </div>      
    </div>
    <?php summon_banner_top(); ?>
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