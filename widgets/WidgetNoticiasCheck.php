<?php

class WidgetNoticiasCheck extends WP_Widget {

    function __construct(){
        parent::__construct(
            'Widget_Noticias_Check',
            'Widget de Notícias [NOVO]',
            array(
                'description' => 'Exibe as 7 últimas notícias em formato grande, com seleção de categorias a serem exibidas'
            )
        );
    }

    function widget( $args, $instance ) { 
        echo $args['before_widget'];

        $posts_per_page = 7;

        try {
            $categories_count = count($instance['widget_categories']);
        } catch (TypeError $ex) {
            echo '<pre>Nenhuma categoria selecionada: seleciona a(s) categoria(s) a serem exibidas no widget. Erro:</pre>';
            echo $ex->getMessage();
            return 0;
        }        

        $sticky_query_args = array(
            'category__in' => $instance['widget_categories'],
            'fields' => 'ids',                      //pega só ids dos posts 
            'posts_per_page' => $posts_per_page,    //no máximo $posts_per_page posts
            'no_found_rows' => true,                //otimização
            'post__in' => get_option( 'sticky_posts' ), //postagens sticky
            'ignore_sticky_posts' => true           //otimização
        );

        $regular_query_args = array(
            'category__in' => $instance['widget_categories'],
            'fields' => 'ids',                      //pega só ids dos posts
            'posts_per_page' => $posts_per_page,    //no máximo $posts_per_page posts  
            'no_found_rows' => true,                // otimização
            'post__not_in' => get_option( 'sticky_posts' ), //postagens não-sticky
            'ignore_sticky_posts' => true           //otimização
        );        

        $sticky_query = new WP_Query($sticky_query_args);   //gera query dos posts fixados
        $regular_query = new WP_Query($regular_query_args); //gera query dos posts não-fixados

        $merged_ids = array_merge($sticky_query->posts, $regular_query->posts); //junta os ids dos posts da queries na ordem sticky (por data de postagem) e depois não-sticky (por data de postagem)
        
        $the_query = new WP_Query(array(
            'post__in' => $merged_ids,          //gera query apenas com os posts dos ids dos posts das duas queries anteriores
            'orderby' => 'post__in',            //ordem do array dos ids
            'ignore_sticky_posts' => true));    //otimização

        if ( $the_query->have_posts() ) {
            $titulo = ($categories_count == 1) ? get_cat_name($instance['widget_categories'][0]) : 'Notícias';
            $titulo = !empty($instance['titulo']) ? $instance['titulo'] : $titulo;

            $mais_titulo = ($categories_count == 1) ? 'Mais ' . get_cat_name($instance['widget_categories'][0]) : 'Mais Notícias';
            $mais_titulo = !empty($instance['mais_titulo']) ? $instance['mais_titulo'] : $mais_titulo;

            echo '<div class="width-wrapper large-spacer">';
                echo '<div class="linha-header-longa">';
                    if ($categories_count == 1) {
                        echo '<h2 class="linha-header"><a href="', esc_url(get_category_link($instance['widget_categories'][0]))  ,  '" class="">' , esc_html($titulo) , '</a></h2>';
                    } else {
                        echo '<h2 class="linha-header"><a href="', get_home_url(), '/noticias/" class="">' , esc_html($titulo) , '</a></h2>';
                    }
                echo '</div>';
                echo '<div class="noticias-widget">';                
                $postCount = 0;
                while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                    $postCount++;
                    $the_query->the_post();

                    echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-card linha-abaixo">';
                        echo '<div href="' , esc_url(the_permalink()) , '" class="noticia-card-imagem  small-spacer">';
                        the_post_thumbnail('large');//echo    '<img src="', esc_url(the_post_thumbnail_url()), '">';
                        echo '</div>'; //noticia-imagem

                        $categories = get_the_category(); //categorias
                        if ($categories && ($categories_count > 1)) {
                            echo '<div class="categorias small-spacer">';
                            $categories = array_slice($categories, 0, 2);
                            foreach ($categories as $category) {                                                    
                                // Exibe o nome da categoria como um link
                                echo '<div>' . esc_html($category->name) . '</div>';

                                // Adiciona uma vírgula após a categoria, exceto pela última
                                if (next($categories)) {
                                    //echo ',&nbsp';
                                    echo ' ';
                                }
                            }
                            echo '</div>';
                        }
                        
                        echo '<div><div class="titulo small-spacer">' , esc_html(the_title()) , '</div>'; //título

                        if ($postCount == 1) echo '<div class="bigode small-spacer">' , esc_html(the_excerpt()) , '</div>'; //excerpt
                        echo '</div>';

                        echo '<div class="data">' . get_the_date( 'j \d\e F \d\e Y' ) . '</div>'; //data
                        
                    echo '</a>'; //noticia-card
                }           

                echo '</div>';

                echo '<div class="large-spacer mais-noticias">';

                    if ($categories_count == 1) {
                        echo '<div class=""><a href="', esc_url(get_category_link($instance['widget_categories'][0]))  ,  '" class="mais-link">' , esc_html($mais_titulo) , '</a></div>';
                    } else {
                        echo '<div class=""><a href="', get_home_url(), '/noticias/" class="mais-link">' , esc_html($mais_titulo) , '</a></div>';
                    }
                    
                echo '</div>';

            echo '</div>'; //width-wrapper
        }

        echo $args['after_widget']; 
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['widget_categories'] = $new_instance['widget_categories'];
        $instance['titulo'] = $new_instance['titulo'];
        $instance['mais_titulo'] = $new_instance['mais_titulo'];
        return $instance;
    }

    function form( $instance ) {
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : null;       
        $mais_titulo = !empty($instance['mais_titulo']) ? esc_html($instance['mais_titulo']) : null;            
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('mais_titulo'); ?>">Título do link para mais postagens:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('mais_titulo'); ?>" name="<?php echo $this->get_field_name('mais_titulo'); ?>" type="text" value="<?php echo $mais_titulo; ?>">
        </p>
        <?php
        $defaults = array( 'widget_categories' => array() );
        $instance = wp_parse_args( (array) $instance, $defaults );    
        // Instantiate the walker passing name and id as arguments to constructor
        $walker = new Walker_Category_Checklist_Widget(
            $this->get_field_name( 'widget_categories' ),
            $this->get_field_id( 'widget_categories' )
        );
        echo '<ul class="categorychecklist">';
        wp_category_checklist( 0, 0, $instance['widget_categories'], FALSE, $walker, FALSE );
        echo '</ul>';
    }

}

function WidgetNoticiasCheckInit() {
    register_widget( 'WidgetNoticiasCheck' );
}

add_action( 'widgets_init', 'WidgetNoticiasCheckInit' );

