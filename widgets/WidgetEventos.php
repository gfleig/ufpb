<?php

// Widget de eventos
function registrar_widget_eventos() {
    register_widget('WidgetEventos');
}
add_action('widgets_init', 'registrar_widget_eventos');

class WidgetEventos extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Eventos',
            'Widget de Eventos',
            array(
                'description' => 'Exibe até 3 dos próximos eventos mais próximos que acontecerão. Widget fica invisível se não existe nenhum evento vindo aí'
            )
        );
    }

    public function widget($args, $instance) {

        $posts_per_page = 4;
        $the_query = new WP_Query( array(
            'posts_per_page' => $posts_per_page,
            'post_type' => 'evento',
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
        
        if ($the_query->have_posts()){  
            echo '
            <div class="width-wrapper large-spacer">
                <h2 class="linha-header-longa">                
                    <a class="linha-header" href="', get_home_url(), '/eventos/">Eventos</a>
                </h2>';
                echo '<div class="eventos-grid">';
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        

                        if ($the_query->post_count == 1) {
                            echo'<a href="' , esc_url(the_permalink()) , '" class="evento-card solo">';
                        } else {
                            echo'<a href="' , esc_url(the_permalink()) , '" class="evento-card">';
                        }
                            echo '
                            <div class="evento-card-imagem" style="background-image: url(\'' , esc_url(the_post_thumbnail_url()) , '\')">';
                                the_post_thumbnail('large');
                            echo '</div>
                            <div>
                                <div class="evento-data small-spacer">';

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

                                echo '
                                <h2 class="evento-titulo small-spacer">' , esc_html(the_title()) , '</h2>
                                <div class="bigode">', esc_html(the_excerpt()) ,'</div>
                            </div>
                        </a>';
                    }

                echo '</div>'; //eventos-grid                         
            

            echo '<div class="large-spacer mais-noticias">';                
                echo '<div class=""><a href="', get_home_url(), '/eventos/" class="mais-link">Mais Eventos</a></div>';                
            echo '</div>';

            echo '</div>'; //width-wrapper
        
        }
        echo $args['after_widget']; 
    }
}

?>