<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">
            <?php
            summon_categorias_menu();       
            ?>                                
        </div>
        
        <div class="content-grid"> <?php
            echo '<h1>Postagens sobre ' , single_cat_title() , '</h1>
            <div class="cards-lista">';

            if(have_posts()){
                echo '<div class="sidebar-noticias">
                    <div class="noticias-relacionadas">';
                    while(have_posts()){
                        the_post();
                            
                            echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-card-categoria linha-abaixo">';                                          
                            
                            echo '<div class="noticia-categoria-imagem">
                                <img src="', esc_url(the_post_thumbnail_url()), '">
                            </div>';        
                                       
                            $categories = get_the_category(); //categorias
                            if ($categories) {
                                echo '<div class="categorias small-spacer">';
                                $categories = array_slice($categories, 0, 2);
                                foreach ($categories as $category) {                                                    
                                    // Exibe o nome da categoria como um link
                                    echo '<div href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</div>';

                                    // Adiciona uma vírgula após a categoria, exceto pela última
                                    if (next($categories)) {
                                        //echo ',&nbsp';
                                        echo ' ';
                                    }
                                }
                                echo '</div>';
                            }

                            echo '<div class="titulo small-spacer">' , esc_html(the_title()) ,  '</div>'; //título

                            echo '<div class="bigode small-spacer">' , esc_html(the_excerpt()) , '</div>';

                            echo '<div class="data">' . get_the_date( 'j \d\e F \d\e Y' ) . '</div>'; //data
                        echo '</a>'; //noticia-card
                    }
                    echo '
                    <div class="paginas-nav">
                        <div class="pagination">';
                            // Adiciona a paginação
                            the_posts_pagination(array(
                                'prev_text' => __('«', 'text-domain'),
                                'next_text' => __('»', 'text-domain'),
                                'mid_size' => 1,
                                ));
                        echo '</div>
                    </div>';
            } else {
                echo '<p>Desculpe, nenhum post corresponde aos seus critérios.</p>';
            }
            
        echo '</div> </div>
    </div>  </div>           

    </div>
</div>';

get_footer();