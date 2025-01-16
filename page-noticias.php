<?php get_header(); ?>

<div class="corpo" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">  
            <?php
            summon_categorias_menu();
            summon_side_menu();  
            ?>                  
        </div>
        
        <div class="content-grid">            
            <h1>Notícias</h1>
            <div class="cards-lista">
                <?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Página atual
                $args = array(
                    'post_type' => 'post',
                    'paged' => $paged,
                );

                $post_query = new WP_Query($args);
                if ($post_query->have_posts() ) {
                    while ($post_query->have_posts()){
                        $post_query->the_post();                      
                        echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper camada-1">';
                        if (has_post_thumbnail()) {
                            echo '<div class="noticia-img2-wrapper"><img class="noticia-img2" src="', esc_url(the_post_thumbnail_url()), '"></div>';
                        }
                        echo '<div class="noticia-sem-img">'; 
                            echo '<div class="rotulo-escuro">';                                                               
                            echo '
                            <div>' . get_the_date( 'j \d\e F \d\e Y' ) . '</div>';
                            /*echo '<div class="categorias">';
                                $categories = get_the_category();
                                
                                if ($categories) {
                                    $categories = array_slice($categories, 0, 2);
                                    foreach ($categories as $category) {                                                    
                                        echo '<div>' , esc_html($category->name) , '</div>';
                                        if (next($categories)) {
                                            echo ', ';
                                        }
                                    }
                                }
                            echo '    
                                </div>';<!-- fecha div categorias -->*/
                            echo '</div><!-- fecha div rotulo -->';
                            echo '<div class="noticia-titulo">' , esc_html(the_title()) , '</div>';                                    
                    
                            echo '</div>'; //noticia-com/sem-img
                        echo '</a>'; //noticia-wrapper    
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

        <div class="imagem-grande">';
            // Obtém a URL da imagem do Customizer
            $imagem_banner_url = get_theme_mod('imagem_banner');

            if (!empty($imagem_banner_url)) {
                echo '<img src="' . esc_url($imagem_banner_url) . '" alt="Imagem decorativa do site">';
                /*echo '<div class="imagem" style="background-image: url("' . esc_url($imagem_banner_url) . '")" alt="Imagem decorativa do site"><div>';*/
            }
            echo '
            <div class="imagem-sombra"></div>
        </div>    

    </div>
</div>';

get_footer();