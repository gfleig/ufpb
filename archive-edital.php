<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">  
            <?php
            summon_categorias_edital_menu();
            ?>
            <div class="side-menu-archive">
                <h2 class="menu-lateral-h2">Editais por Ano</h2>
                <ul class="menu-lateral">
                    <?php
                    wp_get_archives(
                        array(
                        'type'            => 'yearly',
                        'post_type'       => 'edital',
                        )
                    );
                    ?>
                </ul>
            </div>          
        </div>
        
        <div class="content-grid">            
            <h1>Editais</h1>
            
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
                        echo '<a href="' , esc_url(the_permalink()) , '"class="edital-card linha-abaixo">';
                            $categories = get_the_terms( get_the_ID(), 'edital_type' );
                            //$categories = get_the_category(); //categorias
                            if ($categories) {
                                echo '<div class="categorias small-spacer">';
                                $categories = array_slice($categories, 0, 2);
                                foreach ($categories as $category) {                                                    
                                    // Exibe o nome da categoria como um link
                                    echo '<div>' . esc_html($category->name) . '</div>';

                                    // Adiciona uma vírgula após a categoria, exceto pela última
                                    if (next($categories)) {
                                        //echo ',&nbsp';
                                        echo ' ';
                                    }
                                }
                                echo '</div>';
                            }
                            
                            echo '<div class="titulo small-spacer" href="#">' , esc_html(the_title()) , '</div>';  
                            echo '<div class="data">Publicado em ' , get_the_date('j/m/Y') , '</div>';              
                        echo '</a>';    
                    }
                    echo '
                    <div class="paginas-nav">
                        <div class="pagination">';
                            // Adiciona a paginação
                            echo paginate_links(array(
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