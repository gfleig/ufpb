<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">  
            <?php
            summon_categorias_edital_menu();
            ?>                  
        </div>
        
        <div class="content-grid">            
            <h1>Editais</h1>
            
            <div class="noticias-relacionadas">
                <?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Página atual
                $args = array(
                    'post_type' => 'edital',
                    'paged' => $paged,
                    'orderby' => 'modified',
                );

                $post_query = new WP_Query($args);
                if ($post_query->have_posts() ) {
                    while ($post_query->have_posts()){
                        $post_query->the_post();                      
                        echo '<div class="edital-card linha-abaixo">';
                            $categories = get_the_terms( get_the_ID(), 'edital_type' );
                            //$categories = get_the_category(); //categorias
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
                            echo '<div class="data small-spacer" href="#">Atualizado em ' , esc_html(the_modified_date('j/m/Y')) , '</div>';
                            echo '<a href="' , esc_url(the_permalink()) , '" class="titulo small-spacer" href="#">' , esc_html(the_title()) , '</a>';                
                        echo '</div>';    
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