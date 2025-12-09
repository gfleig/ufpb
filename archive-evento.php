<?php get_header(); ?>

<div class="corpo" id="conteudo_pagina">
    <div class="corpo-grid width-wrapper large-spacer">
        <div class="sidebar">  
            <ul class="side-menu">
                <li class="menu-item current-menu-ancestor current-menu-parent menu-item-has-children eventos-side"><a href="">Eventos</a>
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="https://localhost/wordpress/eventos/">Eventos Atuais e Futuros</a>
                        </li>
                        <li class="menu-item">
                            <a href="https://localhost/wordpress/eventos/passados">Eventos Passados</a>
                        </li>
                    </ul>
                </li>
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
            <h1>Eventos<?php if (isset( $wp_query->query_vars['is_past'] )) { echo ' Passados'; } ?></h1>
            <div class="cards-lista">
                <?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Página atual
                $args = array(
                    'post_type' => 'evento',
                    'paged' => $paged,
                    'meta_key' => '__data_inicio',
                    'orderby' => 'meta_value',
                    'order' => 'DESC',
                );

                //$post_query = new WP_Query($args);
                if (have_posts() ) {
                    while (have_posts()){
                        the_post(); 
                        
                        echo'<a href="' , esc_url(the_permalink()) , '" class="evento-card">';
                        
                            echo '
                            
                            <div class="evento-card-imagem" style="background-image: url(\'' , esc_url(the_post_thumbnail_url()) , '\')">
                                <img src="', esc_url(the_post_thumbnail_url()), '" alt="' , image_alt_by_url(the_post_thumbnail_url()) , '">
                            </div>
                            <div>
                                <div class="evento-data small-spacer">';

                                    $data_inicio = get_post_meta( get_the_ID(), '__data_inicio', true );
                                    $data_fim = get_post_meta( get_the_ID(), '__data_fim', true );   

                                    if (empty($data_fim) || $data_inicio == $data_fim) {
                                        echo wp_date('j \d\e F \d\e Y', $data_inicio);
                                    } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                                        echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim);
                                    } else {
                                        echo wp_date('j \d\e F', $data_inicio), ' a ', wp_date('j \d\e F \d\e Y', $data_fim);    
                                    }         
                                echo '</div>'; //data

                                echo '
                                <h2 class="evento-titulo small-spacer">' , esc_html(the_title()) , '</h2>
                                <div class="bigode">', esc_html(the_excerpt()) ,'</div>
                            </div>
                        </a>';   
                    }
                    echo '
                    <div class="paginas-nav">
                        <div class="pagination">';
                            // Adiciona a paginação
                            echo paginate_links(array(
                                'total' => $post_query->max_num_pages,
                                'current' => max(1, $paged),
                                'prev_text' => __('Anterior'),
                                'next_text' => __('Próximo'),
                            ));
                        echo '</div>
                    </div>';
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