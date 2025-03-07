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

<section aria-label="Carrossel">    
    <div class="carrossel" data-carrossel>
        <button class="carrossel-button prev" data-carrossel-button="prev">ant</button>
        <button class="carrossel-button next" data-carrossel-button="next">prox</button>
        <ul data-slides>
            <li class="slide" data-active>
                <div class="width-wrapper">
                    <div class ="slide-texto-box">
                        <div class="linha-header-longa">
                            <h2 class="linha-header">Ingressar na UFPB</h2>
                        </div>                        
                        <div class="texto">Informações sobre formas de acesso e políticas de apoio ao estudante brasileiro e estrangeiro</div>
                    </div>                    
                </div>                
                <img src="<?php echo get_bloginfo("template_directory"); ?>/img/mus2.jpg" alt="Biblioteca Central">
            </li>
            <li class="slide">
                <img src="<?php echo get_bloginfo("template_directory"); ?>/img/biblioteca.jpg" alt="Hospital Universitário">
            </li>
            <li class="slide">
                <img src="<?php echo get_bloginfo("template_directory"); ?>/img/ipe.jpg" alt="IPE">
            </li>
        </ul>
    </div>
</section>

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