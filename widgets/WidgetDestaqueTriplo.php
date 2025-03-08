<?php

// Registrar Widget de Destaque Triplo
function registrar_widget_destaque_triplo() {
    register_widget('WidgetDestaqueTriplo');
}
add_action('widgets_init', 'registrar_widget_destaque_triplo');

class WidgetDestaqueTriplo extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Destaque_Triplo',
            'Widget de destaque de três páginas',
            array(
                'description' => 'Destaca três páginas do site de forma belíssima.'
            )
        );
    }

    public function widget($args, $instance) {
        $pagina_link[0] = $instance['pagina_link'];
        $titulo[0] = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link[0]));
        $resumo[0] = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link[0]));    
        $link_texto[0] = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';

        $pagina_link[1] = $instance['pagina_link_2'];
        $titulo[1] = !empty($instance['titulo_2']) ? $instance['titulo_2'] : get_the_title(url_to_postid($pagina_link[1]));
        $resumo[1] = !empty($instance['resumo_2']) ? $instance['resumo_2'] : get_the_excerpt(url_to_postid($pagina_link[1]));    
        $link_texto[1] = !empty($instance['link_texto_2']) ? $instance['link_texto_2'] : 'Saiba mais';

        $pagina_link[2] = $instance['pagina_link_3'];
        $titulo[2] = !empty($instance['titulo_3']) ? $instance['titulo_3'] : get_the_title(url_to_postid($pagina_link[2]));
        $resumo[2] = !empty($instance['resumo_3']) ? $instance['resumo_3'] : get_the_excerpt(url_to_postid($pagina_link[2]));    
        $link_texto[2] = !empty($instance['link_texto_3']) ? $instance['link_texto_3'] : 'Saiba mais';

        echo $args['before_widget'];

        echo '<div class="width-wrapper destaque-trio large-spacer">';
        
        for ($i = 0; $i < 3; $i++) {  
            if(has_post_thumbnail(url_to_postid($pagina_link[$i]))){          
            
            echo '<div class="flex-grow-parent">';
                         
            echo '<div class="destaque-img"><img src="' . get_the_post_thumbnail_url(url_to_postid($pagina_link[$i])) . '" alt="Imagem da página"></div>
                <h2 class="small-spacer">' . $titulo[$i] . '</h2>
                <div class="flex-grow">
                    <p>' . $resumo[$i] . '</p>
                    <a class="mais-link linha-acima" href=' . $pagina_link[$i] . '>' . $link_texto[$i] . '</a> 
                </div> 
            </div>';
            }
        }
        echo '</div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link) );    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';  
        
        $pagina_link_2 = $instance['pagina_link_2'];
        $titulo_2 = !empty($instance['titulo_2']) ? $instance['titulo_2'] : get_the_title(url_to_postid($pagina_link_2));
        $resumo_2 = !empty($instance['resumo_2']) ? $instance['resumo_2'] : get_the_excerpt(url_to_postid($pagina_link_2));    
        $link_texto_2 = !empty($instance['link_texto_2']) ? $instance['link_texto_2'] : 'Saiba mais';

        $pagina_link_3 = $instance['pagina_link_3'];
        $titulo_3 = !empty($instance['titulo_3']) ? $instance['titulo_3'] : get_the_title(url_to_postid($pagina_link_3));
        $resumo_3 = !empty($instance['resumo_3']) ? $instance['resumo_3'] : get_the_excerpt(url_to_postid($pagina_link_3));    
        $link_texto_3 = !empty($instance['link_texto_3']) ? $instance['link_texto_3'] : 'Saiba mais';

        // Formulário de configuração do widget
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Link da primeira página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link'); ?>" name="<?php echo $this->get_field_name('pagina_link'); ?>" type="text" value="<?php echo $pagina_link; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('resumo'); ?>">Texto do primeiro bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo'); ?>" name="<?php echo $this->get_field_name('resumo'); ?>" type="text" value="<?php echo $resumo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto'); ?>">Texto do primeiro link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto'); ?>" name="<?php echo $this->get_field_name('link_texto'); ?>" type="text" value="<?php echo $link_texto; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link_2'); ?>">Link da segunda página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link_2'); ?>" name="<?php echo $this->get_field_name('pagina_link_2'); ?>" type="text" value="<?php echo $pagina_link_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo_2'); ?>">Título do segundo bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo_2'); ?>" name="<?php echo $this->get_field_name('titulo_2'); ?>" type="text" value="<?php echo $titulo_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('resumo_2'); ?>">Texto do segundo bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo_2'); ?>" name="<?php echo $this->get_field_name('resumo_2'); ?>" type="text" value="<?php echo $resumo_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto_2'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto_2'); ?>" name="<?php echo $this->get_field_name('link_texto_2'); ?>" type="text" value="<?php echo $link_texto_2; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link_3'); ?>">Link da terceira página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link_3'); ?>" name="<?php echo $this->get_field_name('pagina_link_3'); ?>" type="text" value="<?php echo $pagina_link_3; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo_3'); ?>">Título do terceiro bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo_3'); ?>" name="<?php echo $this->get_field_name('titulo_3'); ?>" type="text" value="<?php echo $titulo_3; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('resumo_3'); ?>">Texto do terceiro bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo_3'); ?>" name="<?php echo $this->get_field_name('resumo_3'); ?>" type="text" value="<?php echo $resumo_3; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto_3'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto_3'); ?>" name="<?php echo $this->get_field_name('link_texto_3'); ?>" type="text" value="<?php echo $link_texto_3; ?>">
        </p>
        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['pagina_link'] = !empty($new_instance['pagina_link']) ? esc_html($new_instance['pagina_link']) : ''; 
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : ''; 
        $instance['resumo'] = !empty($new_instance['resumo']) ? esc_html($new_instance['resumo']) : ''; 
        $instance['link_texto'] = !empty($new_instance['link_texto']) ? esc_html($new_instance['link_texto']) : ''; 
        $instance['pagina_link_2'] = !empty($new_instance['pagina_link_2']) ? esc_html($new_instance['pagina_link_2']) : ''; 
        $instance['titulo_2'] = !empty($new_instance['titulo_2']) ? esc_html($new_instance['titulo_2']) : ''; 
        $instance['resumo_2'] = !empty($new_instance['resumo_2']) ? esc_html($new_instance['resumo_2']) : ''; 
        $instance['link_texto_2'] = !empty($new_instance['link_texto_2']) ? esc_html($new_instance['link_texto_2']) : ''; 
        $instance['pagina_link_3'] = !empty($new_instance['pagina_link_3']) ? esc_html($new_instance['pagina_link_3']) : ''; 
        $instance['titulo_3'] = !empty($new_instance['titulo_3']) ? esc_html($new_instance['titulo_3']) : ''; 
        $instance['resumo_3'] = !empty($new_instance['resumo_3']) ? esc_html($new_instance['resumo_3']) : ''; 
        $instance['link_texto_3'] = !empty($new_instance['link_texto_3']) ? esc_html($new_instance['link_texto_3']) : ''; 
        return $instance;
    }
}

?>