<?php

class WidgetPatentes extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_patentes',
            'Widget de Vitrine de Patentes',
            array(
                'description' => 'Widget para exibir os links para as categorias de patentes.'
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
            
            echo '<div class="patentes-widget">';

            for ($i = 1; $i < 11; $i++) {
                if(!empty($instance['link'][$i])) {                
                    echo '
                    <a class="linha-abaixo link-full" href="' . esc_url($instance['link'][$i]) . '">
                        <img src="' , esc_url($instance['imagem'][$i]) , '" alt="' , image_alt_by_url($instance['imagem'][$i]) , '">
                        <div class="link-text texto-escuro">' , esc_html($instance['texto'][$i]) , '</div>
                    </a>';
                }
            }        
        
        echo '                
            </div>';
            echo '<div class="large-spacer mais-noticias">';
                echo '<div class=""><a href="', get_home_url(), '/vitrine/" class="mais-link">Todas as Patentes</a></div>';
            echo '</div>
        </div>';        

        echo $args['after_widget'];            
    }

    public function form($instance) {
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : null;               
        ?>
        <p style="padding: 10px; background: gainsboro; margin-bottom: 15px">
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <?php
        for ($i = 1; $i < 11; $i++){
            echo '<div style="padding: 10px; background: gainsboro; margin-bottom: 25px; display: flex; justify-content: space-evenly;">';
                echo '<p>';
                    echo '<label for="', $this->get_field_id('texto' . $i) , '">Título do link número ' , $i , ':</label>';
                    echo '<input class="widefat" id="' , $this->get_field_id('texto' . $i) , '" name="' , $this->get_field_name('texto') . '[' . $i . ']" type="text" value="' , esc_attr($instance['texto'][$i]) , '">';
                echo '</p>';
                echo '<p>';
                    echo '<label for="', $this->get_field_id('imagem' . $i) , '">Imagem do link número ' , $i , ':</label>';
                    echo '<input class="widefat" id="' , $this->get_field_id('imagem' . $i) , '" name="' , $this->get_field_name('imagem') . '[' . $i . ']" type="url" value="' , esc_attr($instance['imagem'][$i]) , '">';
                echo '</p>';
                echo '<p>';
                    echo '<label for="', $this->get_field_id('link' . $i) , '">Link número ' , $i , ':</label>';
                    echo '<input class="widefat" id="' , $this->get_field_id('link' . $i) , '" name="' , $this->get_field_name('link') . '[' . $i . ']" type="url" value="' , esc_attr($instance['link'][$i]) , '">';
                echo '</p>';
                echo '<br>';
            echo '</div>';
        }        
        ?>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : null;
        for ($i = 1; $i < 11; $i++){
            $instance['texto'][$i] = !empty($new_instance['texto'][$i]) ? esc_html($new_instance['texto'][$i]) : 'Título do link';
            $instance['imagem'][$i] = !empty($new_instance['imagem'][$i]) ? esc_url($new_instance['imagem'][$i]) : 'INSIRA UMA IMAGEM';
            $instance['link'][$i] = !empty($new_instance['link'][$i]) ? esc_url($new_instance['link'][$i]) : null;
        }        

        return $instance;
    }

}

function registrar_widget_patentes() {
    register_widget('WidgetPatentes');
}
add_action('widgets_init', 'registrar_widget_patentes');

?>