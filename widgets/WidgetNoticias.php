<?php

// Registrar Widget de Noticias novo
function registrar_widget_noticias() {
    register_widget('WidgetNoticias');
}
add_action('widgets_init', 'registrar_widget_noticias');

class WidgetNoticias extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Noticias',
            'Widget de Notícias',
            array(
                'description' => 'Exibe as 7 últimas notícias, sendo 1 em formato grande e 6 pequenas'
            )
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        $posts_per_page = 7;
        $the_query = new WP_Query( array(
            'posts_per_page' => $posts_per_page
        ));

        if ( $the_query->have_posts() ) {
            echo '<div class="width-wrapper large-spacer">';
            echo '<div class="linha-header-longa">';
                echo '<h2 class="linha-header"><a href="', get_home_url(), '/noticias/" class="mais-link-header">Notícias</a></h2>';
            echo '</div>';
            echo '<div class="noticias-widget">';                
            $postCount = 0;
            while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                $postCount++;
                $the_query->the_post();

                echo '<div class="noticia-card linha-abaixo flex-grow-parent">';
                    echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-card-imagem  small-spacer">';
                    echo    '<img src="', esc_url(the_post_thumbnail_url()), '">';
                    echo '</a>'; //noticia-imagem

                    $categories = get_the_category(); //categorias
                    if ($categories) {
                        echo '<div class="categorias small-spacer">';
                        $categories = array_slice($categories, 0, 2);
                        foreach ($categories as $category) {                                                    
                            // Exibe o nome da categoria como um link
                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';

                            // Adiciona uma vírgula após a categoria, exceto pela última
                            if (next($categories)) {
                                //echo ',&nbsp';
                                echo ' ';
                            }
                        }
                        echo '</div>';
                    }
                    
                    echo '<div><a href="' , esc_url(the_permalink()) , '" class="titulo small-spacer">' , esc_html(the_title()) , '</a>'; //título

                    if ($postCount == 1) echo '<div class="bigode small-spacer">' , esc_html(the_excerpt()) , '</div>'; //excerpt
                    echo '</div>';

                    echo '<div class="data">' . get_the_date( 'j \d\e F \d\e Y' ) . '</div>'; //data
                    
                echo '</div>'; //noticia-card
            }           

            echo '</div>';
            echo '</div>';
        }

        echo $args['after_widget']; 
    }
}

?>