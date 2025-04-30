<?php

// Registrar Widget de Destaque solo
function registrar_widget_destaque_solo() {
    register_widget('WidgetDestaqueSolo');
}
add_action('widgets_init', 'registrar_widget_destaque_solo');

class WidgetDestaqueSolo extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Destaque_Solo',
            'Widget de Destaque Único',
            array(
                'description' => 'Destaca uma página do site de forma belíssima.'
            )
        );
    }

    public function widget($args, $instance) {
        // Extrair os valores dos campos do widget
        $pagina_link = esc_url($instance['pagina_link'][1]);
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link));    
        //$link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';
        $img_link = !empty($instance['img_link']) ? $instance['img_link'] : get_the_post_thumbnail_url(url_to_postid($pagina_link));

        echo $args['before_widget'];

        echo '
        <div class="width-wrapper destaque-solo large-spacer">  
            <div class="linha-header-longa flex-grow-parent">
                <h2 class="linha-header small-spacer">' . $titulo . '</h2>
                <div class="flex-grow">
                    <p>' . $resumo . '</p>';

                    echo '<div class="apresentacao-links">';
                    for ($i = 1; $i < 6; $i++){
                        if(!empty($instance['pagina_link'][$i]) && !empty($instance['link_texto'][$i])) {
                            if (wp_is_internal_link($instance['pagina_link'][$i])) {
                                echo '<a class="mais-link linha-acima" href=' . esc_url($instance['pagina_link'][$i]) . '>' . esc_html($instance['link_texto'][$i]) . '</a>';
                            } else {
                                echo '<a class="mais-link linha-acima" href=' . esc_url($instance['pagina_link'][$i]) . ' target="_blank" rel="noopener noreferrer">' . esc_html($instance['link_texto'][$i]) . '</a>';
                            }
                        }                        
                    }                    
                    echo '</div>';                      

                echo '</div>                
            </div>
            <div class="destaque-solo-img">
                <img src="' . $img_link . '" alt="Imagem da página">
            </div>                
        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $pagina_principal = $instance['pagina_link'][1];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_principal));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_principal) );    
        //$link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';   
        $img_link = !empty($instance['img_link']) ? $instance['img_link'] : '';     

        // Formulário de configuração do widget
        ?>

        
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Texto do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo'); ?>" name="<?php echo $this->get_field_name('resumo'); ?>" type="text" value="<?php echo $resumo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('img_link'); ?>">Link da imagem personalizada do destaque:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_link'); ?>" name="<?php echo $this->get_field_name('img_link'); ?>" type="text" value="<?php echo $img_link; ?>">
        </p>
          

        <?php
        for ($i = 1; $i < 6; $i++){
            echo '<p>';
                echo '<label for="', $this->get_field_id('link_texto' . $i) , '">Título do link número ' , $i , ':</label>';
                echo '<input class="widefat" 
                id="' , $this->get_field_id('link_texto' . $i) , '" 
                name="' , $this->get_field_name('link_texto') . '[' . $i . ']" 
                type="text" 
                value="' , esc_attr($instance['link_texto'][$i]) , '">';
            echo '</p>';            
            echo '<p>';
                echo '<label for="', $this->get_field_id('pagina_link' . $i) , '">Link número ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('pagina_link' . $i) , '" name="' , $this->get_field_name('pagina_link') . '[' . $i . ']" type="url" value="' , esc_attr($instance['pagina_link'][$i]) , '">';
            echo '</p>';
            echo '<br>';
        }        
        ?>
        
        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        //$instance['pagina_link'] = !empty($new_instance['pagina_link']) ? esc_html($new_instance['pagina_link']) : ''; 
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : ''; 
        $instance['resumo'] = !empty($new_instance['resumo']) ? esc_html($new_instance['resumo']) : ''; 
        //$instance['link_texto'] = !empty($new_instance['link_texto']) ? esc_html($new_instance['link_texto']) : ''; 
        $instance['img_link'] = !empty($new_instance['img_link']) ? esc_html($new_instance['img_link']) : '';
        
        for ($i = 1; $i < 6; $i++){
            $instance['link_texto'][$i] = !empty($new_instance['link_texto'][$i]) ? esc_html($new_instance['link_texto'][$i]) : null;
            $instance['pagina_link'][$i] = !empty($new_instance['pagina_link'][$i]) ? esc_url($new_instance['pagina_link'][$i]) : null;
        } 
            

        return $instance;
    }
}

?>