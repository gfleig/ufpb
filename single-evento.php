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

            <div class="the-content-container">                             
                <?php the_content(); ?>
            </div>

            <div class = "evento-ficha">                
                <h2>Serviço</h2>
                <?php
                $data_inicio = get_post_meta( get_the_ID(), '__data_inicio', true );
                $data_fim = get_post_meta( get_the_ID(), '__data_fim', true );
                $horario = get_post_meta( get_the_ID(), '__horario', true );
                $local = get_post_meta( get_the_ID(), '__local', true );
                $local_end = get_post_meta( get_the_ID(), '__local_end', true );
                $custo = get_post_meta( get_the_ID(), '__custo', true );
                $inscricoes = get_post_meta( get_the_ID(), '__inscricoes', true );
                $inscricoes_link = get_post_meta( get_the_ID(), '__inscricoes_link', true );
                $informacoes = get_post_meta( get_the_ID(), '__informacoes', true );
                $informacoes_link = get_post_meta( get_the_ID(), '__informacoes_link', true );

                echo '<p><i class="fa-solid fa-calendar"></i><strong>Data: </strong> ';
                if (empty($data_fim) || $data_inicio == $data_fim) {
                    echo wp_date('l, j \d\e F \d\e Y', $data_inicio), '</p>';
                } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                    echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</p>';
                } else {
                    echo wp_date('j \d\e F', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</p>';
                }                
                if (!empty($horario)) {
                    echo '<p><i class="fa-solid fa-clock"></i><strong>Horário: </strong>', esc_html($horario),  '</p>';
                }
                if (!empty($local)) {
                    echo '<p><i class="fa-solid fa-location-dot"></i><strong>Local: </strong>';
                    echo esc_html($local);
                    if(!empty($local_end)) {
                        echo ' (', esc_html($local_end), ')';
                    }
                    echo '</p>';
                }
                if (!empty($custo)) {
                    echo '<p><i class="fa-solid fa-brazilian-real-sign"></i><strong>Custo: </strong>', esc_html($custo), '</p>';
                }
                if (!empty($inscricoes)) {
                    echo '<p><i class="fa-solid fa-address-card"></i>';
                    if (!empty($inscricoes_link)) {
                        echo '<strong>Inscrições: </strong> <a href="', esc_url($inscricoes_link), '">', esc_html($inscricoes), '</a></p>';
                    } else {
                        echo '<strong>Inscrições: </strong>', esc_html($inscricoes), '</p>';
                    }                    
                } else if (!empty($inscricoes_link)) {
                    echo '<p><i class="fa-solid fa-address-card"></i>';
                    echo '<strong>Inscrições: </strong> <a href="', esc_url($inscricoes_link), '">', esc_html($inscricoes_link), '</a></p>';
                }
                if (!empty($informacoes)) {
                    echo '<p><i class="fa-solid fa-circle-info"></i>';
                    if (!empty($informacoes_link)) {
                        echo '<strong>Mais informações: </strong> <a href="', esc_url($informacoes_link), '">', esc_html($informacoes), '</a></p>';
                    } else {
                        echo '<strong>Mais informações: </strong>', esc_html($inscricoes), '</p>';
                    }                    
                } else if (!empty($informacoes_link)) {
                    echo '<p><i class="fa-solid fa-circle-info"></i>';
                    echo '<strong>Mais informações: </strong> <a href="', esc_url($informacoes_link), '">', esc_html($informacoes_link), '</a></p>';
                } 
                ?>                
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