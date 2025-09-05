<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="single-corpo-grid">
        
        <?php cats_related_post() ?>        
        
        <?php
        while ( have_posts() ) :
        the_post(); ?>
        <div class="single-content-grid">      
            <div class="noticia-categorias">               
                <?php
                    $categories = get_the_category();
                    $categories_num = count($categories);
                    /*(if ($categories_num == 0) {
                        // faça nada
                    } else if ($categories_num == 1) {
                        echo 'Categoria:&nbsp';
                    } else {
                        echo 'Categorias:&nbsp';
                    }*/
                    if ($categories) {
                        // Loop pelas categorias
                        foreach ($categories as $category) {
                            // Exibe o nome da categoria como um link
                            echo '<a class="" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';                            
                        }
                    }
                ?>
            </div>       
            <h1 class="noticia-pagina-titulo"><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <h2 class="bigode"><?php echo the_excerpt(); ?></h2>
            <?php endif; ?>             
            <div class="noticia-h2">
                <div>
                    <div><?php echo get_the_date( 'l, j \d\e F \d\e Y' ); ?></div> 
                    <?php if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) ) {
                        echo '<div class="data-atualizado">atualizado em ' , get_the_modified_time( 'l, j \d\e F \d\e Y' ) , '</div>';
                    } ?>             
                </div>  
                
                                                     
            </div>

            <div class="the-content-container">
                <?php the_content(); ?>
                <div class="noticia-compartilhe">
                    <div class="redes-sociais noticia-redes">
                        <a href="https://api.whatsapp.com/send?text=Acesse%20esta%20p%C3%A1gina:%20<?php echo get_permalink();?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink();?>"  target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink();?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
                                
        <?php endwhile; ?>            
            
            

                       
        </div>
    </div>            

    </div>
</div>

<?php get_footer(); ?>