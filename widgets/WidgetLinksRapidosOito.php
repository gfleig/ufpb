<?php

class WidgetLinksRapidosOito extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_links_rapidos_oito',
            'Widget de Links Rápidos Compacto',
            array(
                'description' => 'Widget para adicionar 8 links rápidos.'
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
            
            echo '<div class="acesso-links-oito-widget">';

            for ($i = 1; $i < 9; $i++) {
                if (!empty($instance['link'][$i])) {
                    echo '
                    <a class="linha-abaixo linha-header-longa link-full" href="' . esc_url($instance['link'][$i]) . '">
                        <div class="link-oito-icon-wrapper">              
                            <i class="' . esc_attr($instance['imagem'][$i]) . '"></i>              
                        </div>          
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
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Acesso Rápido com Marcas';               
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <?php
        for ($i = 1; $i < 9; $i++){
            
            echo '<p>';
                echo '<label for="', $this->get_field_id('texto' . $i) , '">Título do link número ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('texto' . $i) , '" name="' , $this->get_field_name('texto') . '[' . $i . ']" type="text" value="' , esc_attr($instance['texto'][$i]) , '">';
            echo '</p>';
            echo '<p>';
                echo '<label for="', $this->get_field_id('imagem' . $i) , '">Ícone do link número ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('imagem' . $i) , '" name="' , $this->get_field_name('imagem') . '[' . $i . ']" type="text" value="' , esc_attr($instance['imagem'][$i]) , '">';
            echo '</p>';
            echo '<p>';
                echo '<label for="', $this->get_field_id('link' . $i) , '">Link número ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('link' . $i) , '" name="' , $this->get_field_name('link') . '[' . $i . ']" type="text" value="' , esc_attr($instance['link'][$i]) , '">';
            echo '</p>';
            echo '<br>';
        }        
        ?>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : null;
        for ($i = 1; $i < 9; $i++){
            $instance['texto'][$i] = !empty($new_instance['texto'][$i]) ? esc_html($new_instance['texto'][$i]) : 'Título do Link';
            $instance['imagem'][$i] = !empty($new_instance['imagem'][$i]) ? esc_attr($new_instance['imagem'][$i]) : 'fa-solid fa-pen-fancy';
            $instance['link'][$i] = !empty($new_instance['link'][$i]) ? esc_url($new_instance['link'][$i]) : '';
        }        

        return $instance;
    }

}

function registrar_widget_links_rapidos_oito() {
    register_widget('WidgetLinksRapidosOito');
}
add_action('widgets_init', 'registrar_widget_links_rapidos_oito');

?>