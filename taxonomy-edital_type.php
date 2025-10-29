<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">  
            <ul class="side-menu-categorias-wp menu-lateral">
                <?php
                //summon_categorias_edital_menu();
                wp_list_categories(
                    array(
                        'taxonomy'     => 'edital_type',
                        'show_option_all' => 'Todos Editais',
                        'title_li' => '<h2 class="menu-lateral-h2">Categorias de Editais</h2>'
                    )
                );
                ?>
            </ul>            
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
        
        <div class="content-grid"> <?php
            echo '<h1 class="cat-archive-title"><a href="' , home_url() , '/editais">Editais</a> / ' , single_cat_title() , '</h1>
            <div class="cards-lista">';

            if(have_posts()){
                echo '<div class="sidebar-noticias">
                    <div class="noticias-relacionadas">';
                    while (have_posts()){
                        the_post();                      
                        if(has_post_thumbnail($post->ID)) {
                            echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-card-categoria linha-abaixo">';                                          
                            
                                echo '<div class="noticia-categoria-imagem">
                                    <img src="', esc_url(the_post_thumbnail_url()), '">
                                </div>';        

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

                                echo '<div class="titulo small-spacer">' , esc_html(the_title()) ,  '</div>'; //título

                                if(has_excerpt()) {
                                    echo '<div class="bigode small-spacer">' , esc_html(the_excerpt()) , '</div>'; //bigode, se tiver
                                } else {
                                    echo '<div class="bigode small-spacer"></div>'; //bigode, se tiver
                                }                             

                                echo '<div class="data">Publicado em ' , get_the_date('j/m/Y') , '</div>'; //data
                            echo '</a>'; //noticia-card
                        } else {
                            echo '<a href="' , esc_url(the_permalink()) , '" class="edital-card linha-abaixo">';
                            $categories = get_the_terms( get_the_ID(), 'edital_type' );
                            
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