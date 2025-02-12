<?php

class WidgetLinksMarcas extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_links_marcas',
            'Widget de Links com Marcas',
            array(
                'description' => 'Widget para adicionar 6 links rápidos usando marcas como imagens dos links.'
            )
        );
    }

    public function widget($args, $instance) {        

        echo $args['before_widget'];
        echo '
        <div class="width-wrapper large-spacer">';
            if(!empty($instance['titulo'])) {
                echo '<div class="linha-header-longa">
                    <h2 class="linha-header"> ' , esc_html($instance['titulo']) , ' </h2>
                </div>';
            }
            
            echo '<div class="acesso-marcas-widget">';

            for ($i = 1; $i < 7; $i++) {
                echo '
                <a class="linha-abaixo linha-acima link-full" href="' . esc_url($instance['link'][$i]) . '">
                    <img src="' , esc_url($instance['imagem'][$i]) , '" alt="' , image_alt_by_url($instance['imagem'][$i]) , '">
                </a>';
            }        
        
        echo '                
            </div>
        </div>';        

        echo $args['after_widget'];            
    }

    public function form($instance) {
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Acesso Rápido Compacto';               
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <?php
        for ($i = 1; $i < 7; $i++){
            
            echo '<p>';
                echo '<label for="', $this->get_field_id('imagem' . $i) , '">Imagem do link número ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('imagem' . $i) , '" name="' , $this->get_field_name('imagem') . '[' . $i . ']" type="url" value="' , esc_attr($instance['imagem'][$i]) , '">';
            echo '</p>';
            echo '<p>';
                echo '<label for="', $this->get_field_id('link' . $i) , '">Link número ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('link' . $i) , '" name="' , $this->get_field_name('link') . '[' . $i . ']" type="url" value="' , esc_attr($instance['link'][$i]) , '">';
            echo '</p>';
            echo '<br>';
        }        
        ?>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : null;
        for ($i = 1; $i < 7; $i++){
            $instance['imagem'][$i] = !empty($new_instance['imagem'][$i]) ? esc_url($new_instance['imagem'][$i]) : 'INSIRA UMA IMAGEM';
            $instance['link'][$i] = !empty($new_instance['link'][$i]) ? esc_url($new_instance['link'][$i]) : 'ufpb.br';
        }        

        return $instance;
    }

}

function registrar_widget_links_marcas() {
    register_widget('WidgetLinksMarcas');
}
add_action('widgets_init', 'registrar_widget_links_marcas');

?>