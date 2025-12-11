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
        echo '<div class="width-wrapper destaque-trio large-spacer">';
        
        for ($i = 1; $i < 4; $i++) {         
            if(!empty($instance['link'][$i][1])) {

                if (url_to_postid($instance['link'][$i][1]) > 0) {
                    if(has_post_thumbnail(url_to_postid($instance['link'][$i][1])) && empty($instance['imagem'][$i])) {
                        $instance['imagem'][$i] = get_the_post_thumbnail_url(url_to_postid($instance['link'][$i][1]));
                    }
                    if(empty($instance['titulo'][$i])){
                        $instance['titulo'][$i] = get_the_title(url_to_postid($instance['link'][$i][1]));
                    }
                    if(has_excerpt(url_to_postid($instance['link'][$i][1])) && empty($instance['resumo'][$i])) {
                        $instance['resumo'][$i] = get_the_excerpt(url_to_postid($instance['link'][$i][1]));  
                    }
                }

                echo '<div class="">';         
                    if (!empty($instance['imagem'][$i])) {
                        echo '<div class="destaque-img"><img src="' . esc_attr(esc_url($instance['imagem'][$i])) . '" alt="Imagem da página"></div>';
                    }
                        echo '<h2 class="">' . esc_html($instance['titulo'][$i]) . '</h2>
                        
                            <p>' . esc_html($instance['resumo'][$i]) . '</p>';

                            echo '<div class="flex-grow-parent">';
                            for($j = 1; $j < 6; $j++) {
                                if (!empty($instance['link'][$i][$j])) {
                                    //if (wp_is_internal_link(parse_url($instance['link'][$i][$j], PHP_URL_HOST))) {
                                    if (in_array( wp_parse_url( $instance['link'][$i][$j], PHP_URL_HOST ), wp_internal_hosts(), true )) {
                                        echo '<a class="mais-link linha-acima" href=' . esc_url($instance['link'][$i][$j]) . '>' . $instance['texto'][$i][$j] . '</a> ';
                                    } else {
                                        echo '<a class="mais-link externo linha-acima" href=' . esc_url($instance['link'][$i][$j]) . ' target="_blank" rel="noopener noreferrer">' . $instance['texto'][$i][$j] . '</a> ';
                                    }
                                    
                                }
                            }
                            echo '</div>';
                echo '</div>';
            }  
        }
        echo '</div>';        
    }

    public function form($instance) {                       
        
        for ($i = 1; $i < 4; $i++) {
        echo '<div style="padding: 10px; background: gainsboro; margin-bottom: 15px">';
            echo '<p style="display: flex;">';
                echo '<label for="' , $this->get_field_id('titulo' . $i) , '">Título do Destaque (opcional):</label>';
                echo '<input style="flex: 1; margin-left: 10px; background: white;" class="widefat" 
                id="' , $this->get_field_id('titulo' . $i) , '" 
                name="' , $this->get_field_name('titulo') . '[' . $i . ']" 
                type="text" 
                value="' , esc_attr($instance['titulo'][$i]) , '">';        
            echo '</p>';

            echo '<p style="display: flex;">';
                echo '<label for="', $this->get_field_id('resumo' . $i) , '">Texto do Destaque (Opcional) ' , $i , ':</label>';
                echo '<input style="flex: 1; margin-left: 10px; background: white;" class="widefat" id="' , $this->get_field_id('resumo' . $i) , '" name="' , $this->get_field_name('resumo') . '[' . $i . ']" type="text" value="' , esc_attr($instance['resumo'][$i]) , '">';
            echo '</p>';

            echo '<p style="display: flex;">';
                echo '<label for="', $this->get_field_id('imagem' . $i) , '">Imagem do link número ' , $i , ':</label>';
                echo '<input style="flex: 1; margin-left: 10px; background: white;" class="widefat" id="' , $this->get_field_id('imagem' . $i) , '" name="' , $this->get_field_name('imagem') . '[' . $i . ']" type="url" value="' , esc_attr($instance['imagem'][$i]) , '">';
            echo '</p>';

            for($j = 1; $j < 6; $j++) {
            echo '<div style="padding: 10px; background: aliceblue; margin-bottom: 5px; display: flex;  gap: 10px;">';
                echo '<p style="display: flex;">';
                    echo '<label for="', $this->get_field_id('link' . $i . $j) , '">Link número ' , $j , ':</label>';
                    echo '<input style="flex: 1; margin-left: 10px; background: white;" class="widefat" id="' , $this->get_field_id('link' . $i . $j) , '" name="' , $this->get_field_name('link') . '[' . $i . '][' . $j . ']" type="url" value="' , esc_attr($instance['link'][$i][$j]) , '">';
                echo '</p>';

                echo '<p style="display: flex;">';
                    echo '<label for="', $this->get_field_id('texto' . $i . $j) , '">Título do link número ' , $j , ':</label>';
                    echo '<input style="flex: 1; margin-left: 10px; background: white;" class="widefat" id="' , $this->get_field_id('texto' . $i . $j) , '" name="' , $this->get_field_name('texto') . '[' . $i . '][' . $j . ']" type="text" value="' , esc_attr($instance['texto'][$i][$j]) , '">';
                echo '</p>';
            echo '</div>';
            }
        echo '</div>';
        }        
    }

    public function update($new_instance, $old_instance) {
        
        return $new_instance;
    }
}

?>