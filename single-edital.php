<?php get_header(); ?>

<div class="corpo" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">
            <?php
            summon_side_menu();  
            ?>                              
        </div>
        <?php
        while ( have_posts() ) :
        the_post(); 
        ?>        
        <div class="content-grid">            
            <h1 class="noticia-pagina-titulo"><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <h2 class="bigode"><?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?></h2>
            <?php endif; ?>             
            <div class="noticia-h2">
                <div>
                    <div>Publicado: <?php echo get_the_date( 'j \d\e F \d\e Y' ); ?></div> 
                    <?php
                    if(get_the_date() != get_the_modified_date()) {
                        echo '<div>Atualizado: ', get_the_modified_date( 'j \d\e F \d\e Y' ), '</div>';
                    }
                    ?>
                                       
                </div>  
                <?php
                // Obtém as categorias do post
                $categories = get_the_category();
                $categories_num = count($categories);
                ?>
                <div class="noticia-categorias">
                <?php
                    if ($categories_num == 0) {
                        // faça nada
                    } else if ($categories_num == 1) {
                        echo 'Categoria:&nbsp';
                    } else {
                        echo 'Categorias:&nbsp';
                    }

                    // Verifica se existem categorias
                    if ($categories) {
                        // Limita a exibição a duas categorias
                        //$categories = array_slice($categories, 0, 2);

                        // Loop pelas categorias
                        foreach ($categories as $category) {
                            // Exibe o nome da categoria como um link
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';

                            // Adiciona uma vírgula após a categoria, exceto pela última
                            if (next($categories)) {
                                echo ',&nbsp';
                            }
                        }
                    }
                ?>
            </div>                                      
            </div>

            <div class="the-content-container">
                <?php the_content(); ?>
            </div>            
                                
        <?php endwhile; ?>

            <!--div class="noticia-links-relacionados">
                <h2>Arquivos</h2>
                <a href="#"><div class="noticia-link-relacionado">https://mobile.fraudes.com/cdn-content/manual_v2.pdf?id=7dc68bDB879D68BC</div></a>                    
                <a href="#"><div class="noticia-link-relacionado">Manual de como se defender da nova espécie</div></a>
            </div-->
            
            <div class="noticia-compartilhe">
                <!--div>Compartilhe:</div-->
                <div class="redes-sociais noticia-redes">
                    <a href="https://api.whatsapp.com/send?text=Acesse%20esta%20p%C3%A1gina:%20<?php echo get_permalink();?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink();?>"  target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink();?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>                        
        </div>
    </div>

        <div class="imagem-grande">
            <?php
            // Obtém a URL da imagem do Customizer
            $imagem_banner_url = get_theme_mod('imagem_banner');

            if (!empty($imagem_banner_url)) {
                echo '<img src="' . esc_url($imagem_banner_url) . '" alt="Imagem decorativa do site">';
                /*echo '<div class="imagem" style="background-image: url("' . esc_url($imagem_banner_url) . '")" alt="Imagem decorativa do site"><div>';*/
            }
            ?>
            <div class="imagem-sombra"></div>
        </div>    

    </div>
</div>

<?php get_footer(); ?>