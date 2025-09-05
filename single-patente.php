<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">
            <?php
            summon_categorias_patente_menu();  
            ?>                              
        </div>
        <?php
        while ( have_posts() ) :
        the_post(); 
        ?>        
        <div class="content-grid">  
            <div class="noticia-categorias linha-header-longa">
                <?php 
                    $categories = get_the_terms( get_the_ID(), 'patente_type' );
                    $categories_num = count($categories);
                    // Verifica se existem categorias
                    if ($categories) {
                        // Limita a exibição a duas categorias
                        //$categories = array_slice($categories, 0, 2);

                        // Loop pelas categorias
                        foreach ($categories as $category) {
                            // Exibe o nome da categoria como um link
                            echo '<a class="linha-header" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';                            
                        }
                    }
                ?>
                </div>            
            <h1 class="noticia-pagina-titulo"><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <h2 class="bigode"><?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?></h2>
            <?php endif; ?>             
            <div class="noticia-h2">
                <div>
                    <div>Publicado: <?php echo get_the_date( 'j \d\e F \d\e Y' ); ?></div> 
                    <?php if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) ) {
                        echo '<div>Última atualização: ' , get_the_modified_time( 'l, j \d\e F \d\e Y' ) , '</div>';
                    } ?>                                        
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

    </div>
</div>

<?php get_footer(); ?>