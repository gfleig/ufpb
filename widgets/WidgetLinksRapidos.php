<?php

class WidgetLinksRapidos extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_links_rapidos',
            'Widget de Links Rápidos',
            array(
                'description' => 'Widget para adicionar 6 links rápidos'
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
            
            echo '<div class="links">';

            for ($i = 1; $i < 7; $i++) {
                if(!empty($instance['link'][$i])) {
                    echo '
                    <a class="link-full linha-abaixo linha-acima" href="' . esc_url($instance['link'][$i]) . '">
                        <div class="link-image-wrapper">' . $instance['imagem'][$i] . '</div>          
                        <div class="link-text texto-escuro">' . esc_html($instance['texto'][$i]) . '</div>
                    </a>';
                }                
            }        
        
        echo '                
            </div>
        </div>';

        echo $args['after_widget'];            
    }

    public function form($instance) {
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : null;               
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <?php
        for ($i = 1; $i < 7; $i++){
            echo '<p>';
                echo '<label for="', $this->get_field_id('texto' . $i) , '">Título do link número ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('texto' . $i) , '" name="' , $this->get_field_name('texto') . '[' . $i . ']" type="text" value="' , esc_attr($instance['texto'][$i]) , '">';
            echo '</p>';
            echo '<p>';
                echo '<label for="', $this->get_field_id('imagem' . $i) , '">Ícone do link número ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('imagem' . $i) , '" name="' , $this->get_field_name('imagem') . '[' . $i . ']" type="text" value="' , esc_html($instance['imagem'][$i]) , '">';
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
            $instance['texto'][$i] = !empty($new_instance['texto'][$i]) ? esc_html($new_instance['texto'][$i]) : 'Título do Link';
            $instance['imagem'][$i] = !empty($new_instance['imagem'][$i]) ? $new_instance['imagem'][$i] : '<i class="fa-solid fa-face-flushed"></i>';
            $instance['link'][$i] = esc_url($new_instance['link'][$i]);
        }        
    
        return $instance;
    }

}

function registrar_widget_links_rapidos() {
    register_widget('WidgetLinksRapidos');
}
add_action('widgets_init', 'registrar_widget_links_rapidos');


?>