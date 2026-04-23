<?php get_header(); ?>

<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="agenda-corpo-grid">
        
        <?php agenda_related_post(); ?>        
        
        <?php
        while ( have_posts() ) :
        the_post(); ?>
        <div class="single-content-grid">   
                
            <h1 class="noticia-pagina-titulo"><?php the_title(); ?></h1>
                     
            <div class="noticia-h2">
                <div><?php 
                    echo '<div>Data: ';
                    if (empty($data_fim) || $data_inicio == $data_fim) {
                        echo wp_date('l, j \d\e F \d\e Y', $data_inicio), '</div>';
                    } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                        echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                    } else {
                        echo wp_date('j \d\e F', $data_inicio), ' a ', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
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