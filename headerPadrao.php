<div class="topo portal" id="cabecalho-id">
        <div class="cabecalho width-wrapper">            
            <div class="cabecalho-esquerda">
                <a target="_blank" rel="noopener noreferrer" href="http://ufpb.br" class="brasao">  
                    <img alt="Brasão oficial da UFPB (logo)" src="<?php echo get_bloginfo("template_directory"); ?>/img/brasao.png">
                </a>
                
                <?php if(has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>                
                <div class="site-titulos">
                    <a target="_blank" rel="noopener noreferrer" href="<?php $custom_urlcentro = esc_url(get_theme_mod('custom_urlcentro', 'https://www.ufpb.br')); echo esc_url($custom_urlcentro) ?>" class="centro-titulo desktop">
                        <?php $custom_centro = get_theme_mod('custom_centro', 'Universidade Federal da Paraíba'); echo esc_html($custom_centro);?>
                    </a>
                    <a target="_blank" rel="noopener noreferrer" href="<?php $custom_urlcentro = esc_url(get_theme_mod('custom_urlcentro', 'https://www.ufpb.br')); echo esc_url($custom_urlcentro) ?>" class="centro-titulo mobile">
                        <?php $custom_centro = get_theme_mod('custom_centro', 'UFPB'); echo esc_html($custom_centro);?>
                    </a>
                    <a href="<?php echo get_home_url(); ?>" class="departamento-titulo"><?php echo get_bloginfo( 'name' ); ?></a>
                </div>
                <?php endif; ?>
            </div>
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
                                <?php if ( get_theme_mod( 'check_italiano' ) == 1 ) : ?>                                
                                    <?php if ( get_theme_mod( 'url_italiano' ) ) : ?>
                                        <a href="<?php echo get_theme_mod( 'url_italiano' )?>">
                                    <?php else : ?>
                                        <a href="#" onclick="traduzir_italiano();">
                                    <?php endif; ?>
                                        <div>IT</div>
                                    </a>                                
                                <?php endif; ?>  
                                <?php if ( get_theme_mod( 'check_mandarim' ) == 1 ) : ?>                                
                                    <?php if ( get_theme_mod( 'url_mandarim' ) ) : ?>
                                        <a href="<?php echo get_theme_mod( 'url_mandarim' )?>">
                                    <?php else : ?>
                                        <a href="#" onclick="traduzir_mandarim();">
                                    <?php endif; ?>
                                        <div>中文</div>
                                    </a>                                
                                <?php endif; ?>
                            <div class="spacer"></div>                                              
                        </div>
                    <?php endif; ?>                    

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

<?php summon_banner_top(); ?>



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