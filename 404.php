<?php get_header(); ?>

<div class="corpo" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar">
            <?php
            summon_side_menu();  
            ?>                 
        </div>
        
        <div class="content-grid">            
          <h1>Página não encontrada</h1>   
          <p>A página solicitada não existe. Realize uma busca pelo termo desejado ou entre em contato.</p>      
                      
          

                       
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