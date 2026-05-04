<?php

// Registrar Widget de UFPB em números
function registrar_widget_numeros_custom() {
    register_widget('WidgetNumerosCustom');
}
add_action('widgets_init', 'registrar_widget_numeros_custom');

class WidgetNumerosCustom extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Numeros_Custom',
            'Widget de Números Personalizável',
            array(
                'description' => 'Estatísticas sobre o órgão da UFPB'
            )
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>

        <div class="width-wrapper large-spacer">
        <div class="linha-header-longa">

            <?php if(!empty($instance['titulo'])) {
                echo '<div class="linha-header-longa">
                    <h2 class="linha-header"> ' , esc_html($instance['titulo']) , ' </h2>
                </div>';
            }?>

            <div class="widget-numeros">
                
                <?php 
                for ($i = 1; $i < 26; $i++): 
                    if ( !empty($instance['quant'][$i]) ):
                ?>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <?php echo $instance['imagem'][$i]; ?>
                        <div><?php echo esc_html($instance['quant'][$i]); ?></div>
                    </div>                        
                    <div class="numero-titulo" style="font-style: italic;"><?php echo esc_html($instance['texto'][$i]); ?></div>
                </div>

                <?php endif; endfor; ?>  

                <?php
                if ( !empty($instance['link']) ):
                ?>

                <a href="<?php echo esc_url($instance['link']); ?>" target="_blank" rel="noopener noreferrer" class="item mais-dados">
                    <div class="destaque">
                        <i class="fa-solid fa-plus"></i>
                        <div><?php echo esc_html($instance['mais_info']); ?></div>
                    </div>                        
                    <div class="numero-titulo" ><?php echo esc_html($instance['mais_info_texto']); ?></div>
                </a>

                <?php endif; ?> 
                
            </div>
        </div>

        </div>


        <?php
        echo $args['after_widget']; 
    }

    public function form($instance) {   
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Órgão em Números';               
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" maxlength="80" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <?php
        for ($i = 1; $i < 26; $i++){
            
            echo '<p>';
                echo '<label for="', $this->get_field_id('texto' . $i) , '">Texto da Estatística ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('texto' . $i) , '" name="' , $this->get_field_name('texto') . '[' . $i . ']" type="text" value="' , esc_attr($instance['texto'][$i]) , '">';
            echo '</p>';
            echo '<p>';
                echo '<label for="', $this->get_field_id('imagem' . $i) , '">Ícone da Estatística ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('imagem' . $i) , '" name="' , $this->get_field_name('imagem') . '[' . $i . ']" type="text" value="' , esc_attr($instance['imagem'][$i]) , '">';
            echo '</p>';
            echo '<p>';
                echo '<label for="', $this->get_field_id('quant' . $i) , '">Quantidade da Estatística ' , $i , ':</label>';
                echo '<input class="widefat" id="' , $this->get_field_id('quant' . $i) , '" name="' , $this->get_field_name('quant') . '[' . $i . ']" type="text" value="' , esc_attr($instance['quant'][$i]) , '">';
            echo '</p>';
            echo '<br>';
        }        
        ?>

        <?php           
        $link = esc_url($instance['link']);               
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>">Link para mais dados:</label>
            <input class="widefat" maxlength="80" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>">
        </p>

        <?php           
        $mais_info = !empty($instance['mais_info']) ? esc_html($instance['mais_info']) : 'Dados';               
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('mais_info'); ?>">Título do botão de mais dados:</label>
            <input class="widefat" maxlength="80" id="<?php echo $this->get_field_id('mais_info'); ?>" name="<?php echo $this->get_field_name('mais_info'); ?>" type="text" value="<?php echo $mais_info; ?>">
        </p>

        <?php           
        $mais_info_texto = esc_html($instance['mais_info_texto']);               
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('mais_info_texto'); ?>">Texto de mais dados:</label>
            <input class="widefat" maxlength="80" id="<?php echo $this->get_field_id('mais_info_texto'); ?>" name="<?php echo $this->get_field_name('mais_info_texto'); ?>" type="text" value="<?php echo $mais_info_texto; ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : null;

        for ($i = 1; $i < 26; $i++){
            $instance['texto'][$i] = !empty($new_instance['texto'][$i]) ? esc_html($new_instance['texto'][$i]) : 'Texto da Estatística';
            $instance['imagem'][$i] = !empty($new_instance['imagem'][$i]) ? $new_instance['imagem'][$i] : '<i class="fa-solid fa-biohazard"></i>';
            $instance['quant'][$i] = !empty($new_instance['quant'][$i]) ? esc_html($new_instance['quant'][$i]) : '';
        }        

        $instance['link'] = !empty($new_instance['link']) ? esc_url($new_instance['link']) : null;
        $instance['mais_info'] = !empty($new_instance['mais_info']) ? esc_html($new_instance['mais_info']) : 'Dados';
        $instance['mais_info_texto'] = !empty($new_instance['mais_info_texto']) ? esc_html($new_instance['mais_info_texto']) : null;

        return $instance;
    }
}

?>