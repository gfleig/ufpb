<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">  
            <?php
            summon_side_menu();  
            ?>                  
        </div>
        
        <div class="content-grid"> 
            
            <nav class="page-nav linha-header-longa">
                <a class="<?php echo ((!isset($_GET['post_type']) || ($_GET['post_type'] == 'any') ) ? 'current' : false); ?>" href="<?php echo home_url(); ?>?s=<?php echo get_search_query(); ?>&post_type=any">
                    Tudo
                </a>
                <a class="<?php ufpb_search_filter_item_class('post'); ?>" href="<?php echo home_url(); ?>?s=<?php echo get_search_query(); ?>&post_type=post">
                    Notícias
                </a>
                <a class="<?php ufpb_search_filter_item_class('page'); ?>" href="<?php echo home_url(); ?>?s=<?php echo get_search_query(); ?>&post_type=page">
                    Páginas
                </a>
                <a class="<?php ufpb_search_filter_item_class('evento'); ?>" href="<?php echo home_url(); ?>?s=<?php echo get_search_query(); ?>&post_type=evento">
                    Eventos
                </a>
                <a class="<?php ufpb_search_filter_item_class('edital'); ?>" href="<?php echo home_url(); ?>?s=<?php echo get_search_query(); ?>&post_type=edital">
                    Editais
                </a>
            </nav>
            
            <form class="busca-resultados" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">                
                <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="O que você busca?" />
                <input type="hidden" name="post_type" value="<?php echo (isset($_GET['post_type']) ? $_GET['post_type'] : 'any'); ?>" />
                <button type="submit" class="fa-solid fa-magnifying-glass" > </button>                
            </form>

            <div class="cards-lista">
                <?php
                if(have_posts()){                             
                    echo '<h2>' , $wp_query->found_posts , ' resultados para ' . get_search_query() . ':</h2>';
                    $first_post = true; // usado para adicionar linha acima no primeiro post apenas
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
                    echo '<p>Desculpe, nenhum conteúdo corresponde aos seus critérios <i class="fa-solid fa-face-frown"></i></p>';
                }
                
        echo '</div> </div>
        </div>  </div>           
    
        </div>
    </div>';
    
    get_footer();