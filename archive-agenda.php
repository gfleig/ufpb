<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="corpo-grid">        
        <div class="sidebar">  
            <ul class="side-menu">
                <li class="menu-item current-menu-ancestor current-menu-parent menu-item-has-children eventos-side"><a href="">Agenda</a>
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="<?php echo get_home_url(); ?>/agenda">Agenda Atual</a>
                        </li>
                        <li class="menu-item">
                            <a href="<?php echo get_home_url(); ?>/agenda/passados">Itens Passados</a>
                        </li>
                    </ul>
                </li>
            </ul>  
            </ul>
                <ul class="side-menu">
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
        
        <div class="content-grid">            
            <h1>Agenda</h1>
            
            <div class="noticias-relacionadas">
                <?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Página atual
                /*
                $args = array(
                    'post_type' => 'edital',
                    'paged' => $paged,
                    'orderby' => 'date',
                );

                $post_query = new WP_Query($args);
                */
                if (have_posts() ) {
                    while (have_posts()){
                        the_post();
                        $item_link = get_post_meta( get_the_ID(), '__link', true ); // link externo do item da agenda. Opcional
                        $icon_class = 'fa-external-link';
                        $vazio = false;                                 // variável que diz se o conteúdo do post é vazio
                        if ( empty($item_link) ) {                      // se não tiver link, vai usar o permalink da postagem
                            $item_link = get_permalink();                    
                            $icon_class = 'fa-arrow-right';

                            $content = get_the_content();               // se não tiver nada na postagem, o card não é clicável
                            $trimmed_content = trim( str_replace( '&nbsp;', '', strip_tags( $content ) ) );
                            if ( empty( $trimmed_content ) ) {
                                $vazio = true;
                            }
                        }                
                        
                        if (!$vazio) {
                            echo '<a href="' , esc_url($item_link) , '" class="agenda-card /*linha-acima linha-abaixo*/">';
                        } else {
                            echo '<div class="agenda-card /*linha-acima linha-abaixo*/">';
                        }     
                            echo '<div class="evento-data small-spacer">';

                                $data_inicio = get_post_meta( get_the_ID(), '__data_inicio', true );
                                $data_fim = get_post_meta( get_the_ID(), '__data_fim', true );   

                                if (empty($data_fim) || $data_inicio == $data_fim) {
                                    echo wp_date('j \d\e F', $data_inicio);
                                } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                                    echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F', $data_fim);
                                } else {
                                    echo wp_date('j \d\e F', $data_inicio), ' a ', wp_date('j \d\e F', $data_fim);    
                                }         
                                
                            echo '</div>'; //data                             
                            echo '<h2 class="evento-titulo small-spacer" href="#">' , esc_html(the_title()) , '</h2>';

                            if (!$vazio) echo '<div class="icone"><i class="fa-solid ' . esc_attr($icon_class) . '"></i></div>';
                        
                        if (!$vazio) {
                            echo '</a>';
                        } else {
                            echo '</div>';
                        }
                    }                   
            
                } else {
                    echo '<p>Desculpe, nenhum post corresponde aos seus critérios.</p>';
                }
                echo '
            </div>     
        </div>
    </div>
    </div>
</div>';

get_footer();