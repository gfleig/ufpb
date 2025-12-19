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

            echo '<h1>Postagens</h1>'; ?>


            
                
            <!--form action="<?php bloginfo('siteurl'); ?>" method="get">
                <label for="cat">Select a Category:</label>
                <?php
                wp_dropdown_categories(array(
                    'show_option_none' => 'MIZERA',
                    'option_none_value' => '10', // Text for the "All Categories" option
                    'hide_empty'      => 1,                // Show categories even if they have no posts
                    'name'            => 'cat',            // Name attribute for the select element
                    'id'              => 'cat',              // ID attribute for the select element
                    'orderby'         => 'name',           // Order categories by name
                    'order'           => 'ASC',            // Ascending order
                    'taxonomy'        => 'category',       // Specify the taxonomy as 'category'
                ));
                ?>
                <input type="submit" value="Go" />
            </form-->

            <?php

            $categories = get_sorted_categories('date');

            /*?><pre>
            //<?php print_r( $categories[0]->cat_ID ); ?>
            </pre><?php*/

            foreach ($categories as $categoria) { 

                //print_r( $categoria->cat_ID );

                $the_query = new WP_Query( array(
                    'posts_per_page' => $posts_per_page,
                    'cat' => $categoria->cat_ID,
                    'no_found_rows' => true
                ));

                echo '<div class="large-spacer"><div class="linha-header-longa">';
                    echo '<h2 class="linha-header mais-link-header"><a href="', get_category_link($categoria->cat_ID) , '" >', $categoria->name ,'</a></h2>';
                echo '</div>';

                echo '<div class="noticias-widget-linha">';                
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

                echo '<div class="large-spacer mais-noticias">';
                    echo '<div class=""><a href="', esc_url(get_category_link($categoria->cat_ID))  ,  '" class="mais-link">Mais ' , esc_html($categoria->name) , '</a></div>';
                echo '</div>'; 
                echo '</div>'; 
            }
            ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>