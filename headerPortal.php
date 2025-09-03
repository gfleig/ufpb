<div class="topo portal" id="cabecalho-id">
        <div class="cabecalho width-wrapper">            
            <a rel="noopener noreferrer" href="<?php echo get_home_url(); ?>" class="brasao">
                <img src="<?php echo get_bloginfo("template_directory"); ?>/img/marca.png">
            </a>
            <button type="nav" id="hamburger">
                <i id="hamburger-botao" class="fa-solid fa-bars"></i>
                <!--div>Menu</div-->
            </button>
            <div class="menu-direita">
                <div id="menu-buttons">        
                    
                    <?php if ( get_page_by_path( 'acesso-a-informacao' ) ) : ?> 
                        <a href="<?php echo get_home_url(); ?>/acesso-a-informacao">
                            Acesso à Informação
                        </a>
                    <?php endif; ?> 
                    
                    <?php if ( get_page_by_path( 'contato' ) ) : ?> 
                        <a href="<?php echo get_home_url(); ?>/contato">
                            Contato
                        </a>
                    <?php endif; ?>  

                    <div class="spacer"></div>

                    <?php if ( get_theme_mod( 'traducao_geral' ) == 1 ) : ?>         
                        <div class="menu-traducao">
                                <?php if ( get_theme_mod( 'check_portugues' ) == 1 ) : ?>
                                    <?php if ( get_theme_mod( 'url_portugues' ) ) : ?>
                                        <a href="<?php echo get_theme_mod( 'url_portugues' )?>">
                                    <?php else : ?>
                                        <a href="#" onclick="home();">
                                    <?php endif; ?>
                                        <div>PT</div>
                                    </a>
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'check_ingles' ) == 1 ) : ?>                                
                                    <?php if ( get_theme_mod( 'url_ingles' ) ) : ?>
                                        <a href="<?php echo get_theme_mod( 'url_ingles' )?>">
                                    <?php else : ?>
                                        <a href="#" onclick="traduzir_ingles();">
                                    <?php endif; ?>
                                        <div>EN</div>
                                    </a>                                
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'check_espanhol' ) == 1 ) : ?>                                
                                    <?php if ( get_theme_mod( 'url_espanhol' ) ) : ?>
                                        <a href="<?php echo get_theme_mod( 'url_espanhol' )?>">
                                    <?php else : ?>
                                        <a href="#" onclick="traduzir_espanhol();">
                                    <?php endif; ?>
                                        <div>ES</div>
                                    </a>                                
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'check_frances' ) == 1 ) : ?>                                
                                    <?php if ( get_theme_mod( 'url_frances' ) ) : ?>
                                        <a href="<?php echo get_theme_mod( 'url_frances' )?>">
                                    <?php else : ?>
                                        <a href="#" onclick="traduzir_frances();">
                                    <?php endif; ?>
                                        <div>FR</div>
                                    </a>                                
                                <?php endif; ?>
                                <?php if ( get_theme_mod( 'check_alemao' ) == 1 ) : ?>                                
                                    <?php if ( get_theme_mod( 'url_alemao' ) ) : ?>
                                        <a href="<?php echo get_theme_mod( 'url_alemao' )?>">
                                    <?php else : ?>
                                        <a href="#" onclick="traduzir_alemao();">
                                    <?php endif; ?>
                                        <div>DE</div>
                                    </a>                                
                                <?php endif; ?>                                                
                        </div>
                    <?php endif; ?>

                    <div class="spacer"></div>

                    <a href="javascript:void(0);" onclick="altoContraste();">
                        <!--i title="Alto Constraste" class="fa-solid fa-circle-half-stroke"></i-->
                        <div>Alto Contraste</div>
                    </a>

                    <a href="javascript:void(0);" onclick="autismo();">
                        <!--i title="Cores Acessíveis" class="fa-solid fa-ribbon"></i-->
                        <div>Cores Acessíveis</div>
                    </a> 

                    <?php get_search_form(); ?>

                    
                </div>
                <div class="menu-wrapper" id="menu-nav-portal">
                    <div class="menu">                                                 
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

    <?php get_search_form(); ?> 

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
    <div id="menu-buttons">        
                    
        <a href="<?php echo get_home_url(); ?>/acesso-a-informacao">
            Acesso à Informação
        </a>        

        <a href="javascript:void(0);" onclick="altoContraste();">
            <!--i title="Alto Constraste" class="fa-solid fa-circle-half-stroke"></i-->
            <div>Alto Contraste</div>
        </a>

        <a href="javascript:void(0);" onclick="autismo();">
            <!--i title="Cores Acessíveis" class="fa-solid fa-ribbon"></i-->
            <div>Cores Acessíveis</div>
        </a> 
        
        <?php if ( get_theme_mod( 'traducao_geral' ) == 1 ) : ?>         
            <div class="menu-traducao">
                    <?php if ( get_theme_mod( 'check_portugues' ) == 1 ) : ?>
                        <?php if ( get_theme_mod( 'url_portugues' ) ) : ?>
                            <a href="<?php echo get_theme_mod( 'url_portugues' )?>">
                        <?php else : ?>
                            <a href="#" onclick="home();">
                        <?php endif; ?>
                            <div>PT</div>
                        </a>
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'check_ingles' ) == 1 ) : ?>                                
                        <?php if ( get_theme_mod( 'url_ingles' ) ) : ?>
                            <a href="<?php echo get_theme_mod( 'url_ingles' )?>">
                        <?php else : ?>
                            <a href="#" onclick="traduzir_ingles();">
                        <?php endif; ?>
                            <div>EN</div>
                        </a>                                
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'check_espanhol' ) == 1 ) : ?>                                
                        <?php if ( get_theme_mod( 'url_espanhol' ) ) : ?>
                            <a href="<?php echo get_theme_mod( 'url_espanhol' )?>">
                        <?php else : ?>
                            <a href="#" onclick="traduzir_espanhol();">
                        <?php endif; ?>
                            <div>ES</div>
                        </a>                                
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'check_frances' ) == 1 ) : ?>                                
                        <?php if ( get_theme_mod( 'url_frances' ) ) : ?>
                            <a href="<?php echo get_theme_mod( 'url_frances' )?>">
                        <?php else : ?>
                            <a href="#" onclick="traduzir_frances();">
                        <?php endif; ?>
                            <div>FR</div>
                        </a>                                
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'check_alemao' ) == 1 ) : ?>                                
                        <?php if ( get_theme_mod( 'url_alemao' ) ) : ?>
                            <a href="<?php echo get_theme_mod( 'url_alemao' )?>">
                        <?php else : ?>
                            <a href="#" onclick="traduzir_alemao();">
                        <?php endif; ?>
                            <div>DE</div>
                        </a>                                
                    <?php endif; ?>                                                
            </div>
        <?php endif; ?>    

    </div>
</div>