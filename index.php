<?php get_header(); ?>
<div class="corpo" id="conteudo_pagina">
  <div class="imagem">
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
  <div class="corpo-wrapper">

    <?php $widget_values = dynamic_sidebar('widgets-da-home'); ?>      

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
	
	
<?php get_footer(); ?>