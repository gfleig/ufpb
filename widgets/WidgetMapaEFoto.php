<?php

class WidgetMapaEFotos extends WP_Widget {

public function __construct() {
    parent::__construct(
        'widget_mapa',
        'Widget de Mapa e Foto',
        array(
            'description' => 'Widget com a localização e foto ilustrativa.'
        )
    );
}

public function widget($args, $instance) {
    // Extrair os valores dos campos do widget
    $titulo = !empty($instance['titulo']) ? $instance['titulo'] : 'Encontre-nos!';
    $mapa_iframe = !empty($instance['mapa_iframe']) ? $instance['mapa_iframe'] : '';
    $image_2 = !empty($instance['img_url']) ? $instance['img_url'] : '';         

    echo $args['before_widget'];
    echo '
    <div class="mapa width-wrapper large-spacer">
        <div class="linha-header-longa">
            <h2 class="linha-header">' . esc_html($titulo) . '</h2>
            <div class="mapa-grid">                
                <div id="mapa-inlay">
                    ' . $mapa_iframe . '         
                </div>                
                
                <div id="foto2" class="foto">
                    <img src="' . esc_url($image_2) . '" alt="Imagem decorativa do site">
                    <!--img src="<?php echo get_bloginfo("template_directory"); ?>/img/foto2.png" alt=""-->
                </div>
            </div>
        </div>
    </div>';
    
    echo $args['after_widget']; 
}

public function form($instance) {
    // Exibir o formulário de configuração do widget
    $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Encontre-nos!';
    $mapa_iframe = !empty($instance['mapa_iframe']) ? $instance['mapa_iframe'] : 'iframe_do_mapa';         
    $img_url = !empty($instance['img_url']) ? $instance['img_url'] : 'else_img_url';

    // Formulário de configuração do widget
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo esc_attr($titulo); ?>">
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('mapa_iframe'); ?>">Código de embed (iframe) do google maps, obtido através do compartilhar do maps:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('mapa_iframe'); ?>" name="<?php echo $this->get_field_name('mapa_iframe'); ?>" type="html" value="<?php echo esc_attr($mapa_iframe); ?>"></textarea>
    </p> 

    <p>
        <label for="<?php echo $this->get_field_id('img_url'); ?>">URL da imagem a ser exibida junto com o mapa:</label>
        <input class="widefat" id="<?php echo $this->get_field_id('img_url'); ?>" name="<?php echo $this->get_field_name('img_url'); ?>" type="text" value="<?php echo esc_attr($img_url); ?>"></textarea>
    </p> 
    <?php
}

public function update($new_instance, $old_instance) {
    // Atualizar os valores do widget
    $instance = $old_instance;
    $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : '';
    $instance['mapa_iframe'] = !empty($new_instance['mapa_iframe']) ? $new_instance['mapa_iframe'] : 'cagou-se';
    $instance['img_url'] = !empty($new_instance['img_url']) ? $new_instance['img_url'] : 'link da imagem';  
    return $instance;
}
}

function registrar_widget_mapa() {
    register_widget('WidgetMapaEFotos');
}

add_action('widgets_init', 'registrar_widget_mapa');

?>