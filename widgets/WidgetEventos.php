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

        $posts_per_page = 3;
        $the_query = new WP_Query( array(
            'posts_per_page' => $posts_per_page,
            'post_type' => 'evento',
            'meta_key' => '__data_inicio',  // Pega a metakey de data
            'orderby' => 'meta_value',      // e organiza a query
            'order' => 'ASC',               // em ordem do mais velho pro mais novo
            'meta_query' => array(
                array(
                    'key' => '__data_fim',  // usa a data de fim do evento
                    'value' => current_time('timestamp') - 86400 - 3 * 3600,
                    'compare' => '>='       // pra comprar com a data atual. 
                )                           // (eventos que já acabaram não são exibidos)
            )
        ));

        echo $args['before_widget'];
        
        if ($the_query->have_posts()){  
            echo '
            <div class="width-wrapper large-spacer">
                    <h2 class="linha-header-longa">                
                        <a class="mais-link-header linha-header" href="', get_home_url(), '/eventos/">Eventos</a>
                    </h2>';
                                       
                    if ($the_query->post_count == 1) {
                        // classe com 1 coluna especial
                        // data, nome, excerpt
                        echo '<div class="conteudo2-eventos-solo">';
                        $postCount = 0;
                        while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                            $postCount++;
                            $the_query->the_post();
                                   
                                echo '<a href="' , esc_url(the_permalink()) , '" class="evento-wrapper-solo camada-1">';
                                if (has_post_thumbnail()) {
                                    echo '<div class="evento-img2-wrapper"><img class="noticia-img2" src="', esc_url(the_post_thumbnail_url()), '"></div>';
                                }
                                                            
                            $data_inicio = get_post_meta( get_the_ID(), '__data_inicio', true );
                            $data_fim = get_post_meta( get_the_ID(), '__data_fim', true );     

                            echo '<div class="evento-sem-img">'; 
                                echo '<div class="rotulo-evento">';                                                               
                                echo '<div>';
                                
                                if (empty($data_fim) || $data_inicio == $data_fim) {
                                    echo wp_date('j \d\e F \d\e Y', $data_inicio), '</div>';
                                } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                                    echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                                } else {
                                    echo wp_date('j \d\e F', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                                }
                                
                                echo '
                                
                                </div><!-- fecha div rotulo -->';
                                echo '<h2>' , esc_html(the_title()) , '</h2>';
                                echo  esc_html(the_excerpt());                                     
                                
                                echo '</div>'; //noticia-com/sem-img
                            echo '</a>'; //noticia-wrapper                            
                        }
                    } else {
                    if ($the_query->post_count == 2) {
                        // classe com 3 colunas
                        echo '<div class="conteudo2-eventos-dupla">';
                    } else if ($the_query->post_count == 3) {
                        // classe com 2 colunas
                        echo '<div class="conteudo2-eventos-trio">';
                    } 
                        
                        $postCount = 0;
                        while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                            $postCount++;
                            $the_query->the_post();

                            if ($postCount < 4) {                                    
                                echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper camada-1">';
                                if (has_post_thumbnail()) {
                                    echo '<div class="evento-img2-wrapper"><img class="noticia-img2" src="', esc_url(the_post_thumbnail_url()), '"></div>';
                                }
                                                            
                            $data_inicio = get_post_meta( get_the_ID(), '__data_inicio', true );
                            $data_fim = get_post_meta( get_the_ID(), '__data_fim', true );     

                            echo '<div class="evento-sem-img">'; 
                                echo '<div class="rotulo-evento">';                                                               
                                echo '<div>';
                                
                                if (empty($data_fim) || $data_inicio == $data_fim) {
                                    echo wp_date('j \d\e F \d\e Y', $data_inicio), '</div>';
                                } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                                    echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                                } else {
                                    echo wp_date('j \d\e F', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                                }
                                
                                echo '
                                
                                </div><!-- fecha div rotulo -->';
                                echo '<div class="noticia-titulo">' , esc_html(the_title()) , '</div>';                                    
                                
                                echo '</div>'; //noticia-com/sem-img
                            echo '</a>'; //noticia-wrapper
                            }
                        }  
                    }          
            echo
            '   
            </div>
            </div>';
        
        }
        echo $args['after_widget']; 
    }
}

?>