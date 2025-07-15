<?php get_header(); ?>

<div class="corpo" id="conteudo_pagina">
    <div class="corpo-wrapper">       
        <div class="width-wrapper large-spacer">
            <?php

            $posts_per_page = 4;

            $categories = get_categories( array(
                'orderby' => 'name',
                'order'   => 'ASC'
            ) );

            echo '<h1>Postagens</h1>';
                
            foreach ($categories as $categoria) { 

                $the_query = new WP_Query( array(
                    'posts_per_page' => $posts_per_page,
                    'cat' => get_cat_ID($categoria->name),
                    'no_found_rows' => true
                ));

                echo '<div class="linha-header-longa">';
                    echo '<h2 class="linha-header mais-link-header"><a href="', get_category_link($categoria->term_id) , '" >', $categoria->name ,'</a></h2>';
                echo '</div>';

                echo '<div class="noticias-widget-linha large-spacer">';                
                $postCount = 0;
                while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                    $postCount++;
                    $the_query->the_post();

                    echo '<div class="noticia-card linha-abaixo">';
                        echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-card-imagem  small-spacer">';
                        echo    '<img src="', esc_url(the_post_thumbnail_url()), '">';
                        echo '</a>'; //noticia-imagem

                        /*
                        $categories = get_the_category(); //categorias
                        if ($categories) {
                            echo '<div class="categorias small-spacer">';
                            $categories = array_slice($categories, 0, 2);
                            foreach ($categories as $category) {                                                    
                                // Exibe o nome da categoria como um link
                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';

                                // Adiciona uma vírgula após a categoria, exceto pela última
                                if (next($categories)) {
                                    //echo ',&nbsp';
                                    echo ' ';
                                }
                            }
                            echo '</div>';
                        }
                            */
                        
                        echo '<div><a href="' , esc_url(the_permalink()) , '" class="titulo small-spacer">' , esc_html(the_title()) , '</a>'; //título

                        if (has_excerpt()) { echo '<div class="bigode small-spacer">' , esc_html(the_excerpt()) , '</div>'; } //excerpt
                        echo '</div>';

                        echo '<div class="data">' . get_the_date( 'j \d\e F \d\e Y' ) . '</div>'; //data
                        
                    echo '</div>'; //noticia-card
                }           

                echo '</div>';
            }
            ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>