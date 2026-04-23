<?php

//============================EDITAIS===================================//

class WidgetAgenda extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_agenda',
            'Widget de Agenda',
            array(
                'description' => 'Widget para exibir os próximos itens cadastrados na Agenda do site, em ordem cronológica'
            )
        );
    }

    public function widget($args, $instance) {
        $titulo = $instance['titulo']; 
        $posts_per_page = 8;
        $the_query = new WP_Query( array(
            'posts_per_page' => $posts_per_page,
            'post_type' => 'agenda',
            'meta_key' => '__data_inicio',  // Pega a metakey de data
            'orderby' => 'meta_value',      // e organiza a query
            'order' => 'ASC',               // em ordem do mais velho pro mais novo
            'meta_query' => array(
                array(
                    'key' => '__data_fim',  // usa a data de fim do evento
                    'value' => current_time('timestamp') - 86400, //- 3 * 3600,
                    'compare' => '>='       // pra comprar com a data atual. 
                )                           // (eventos que já acabaram não são exibidos)
            ),
            'no_found_rows' => true
        ));

        echo $args['before_widget'];

        if ($the_query->have_posts()) {
            //echo '<div class="full-width-wrapper">';
            echo '<div class="width-wrapper large-spacer">';
                echo '<div class="linha-header-longa">';
                    echo '<h2 class="linha-header"><a href="', get_home_url(), '/editais/" class="">' , esc_html($titulo) , '</a></h2>';
                echo '</div>';
            
            echo '
            
            <div class="editais">';
            $postCount = 0;
            while ($the_query->have_posts() && $postCount < 8) {
                $postCount++;
                $the_query->the_post();
                $item_link = get_post_meta( get_the_ID(), '__link', true ); // link externo do item da agenda. Opcional
                $icon_class = 'fa-external-link';
                $vazio = false;                                 // variável que diz se o conteúdo do post é vazio
                if ( empty($item_link) ) {                      // se não tiver link, vai usar o permalink da postagem
                    $item_link = get_permalink();                    
                    $icon_class = 'fa-arrow-right';

                    $content = get_the_content();               // se não tiver nada na postagem, o card não é clicável
                    $trimmed_content = trim( str_replace( '&nbsp;', '', strip_tags( $content ) ) );
                    if ( empty( $trimmed_content ) ) {
                        $vazio = true;
                    }
                }                
                
                if (!$vazio) {
                    echo '<a href="' , esc_url($item_link) , '" class="agenda-card /*linha-acima linha-abaixo*/">';
                } else {
                    echo '<div class="agenda-card /*linha-acima linha-abaixo*/">';
                }     
                    echo '<div class="evento-data small-spacer">';

                        $data_inicio = get_post_meta( get_the_ID(), '__data_inicio', true );
                        $data_fim = get_post_meta( get_the_ID(), '__data_fim', true );   

                        if (empty($data_fim) || $data_inicio == $data_fim) {
                            echo wp_date('j \d\e F', $data_inicio);
                        } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                            echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F', $data_fim);
                        } else {
                            echo wp_date('j \d\e F', $data_inicio), ' a ', wp_date('j \d\e F', $data_fim);    
                        }         
                        
                    echo '</div>'; //data                             
                    echo '<h2 class="evento-titulo small-spacer" href="#">' , esc_html(the_title()) , '</h2>';

                    if (!$vazio) echo '<div class="icone"><i class="fa-solid ' . esc_attr($icon_class) . '"></i></div>';
                
                if (!$vazio) {
                    echo '</a>';
                } else {
                    echo '</div>';
                }
            }

            echo '</div>'; 

            echo '<div class="large-spacer mais-noticias">';                
                echo '<div class=""><a href="', get_home_url(), '/agenda/" class="mais-link">Agenda Completa</a></div>';                
            echo '</div>';

        //echo '</div>';
        echo '</div>';
        }
        echo $args['after_widget'];            
    }

    public function form($instance) { 
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Agenda';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : 'erro';
        return $instance;
    }    
}

function registrar_widget_agenda() {
    register_widget('WidgetAgenda');
}
add_action('widgets_init', 'registrar_widget_agenda');

?>