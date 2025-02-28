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
                <div class="menu-wrapper" id="menu-nav">
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