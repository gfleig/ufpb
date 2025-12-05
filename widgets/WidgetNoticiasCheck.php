<?php

// This is required to be sure Walker_Category_Checklist class is available
//require_once ABSPATH . 'wp-admin/includes/template.php';
/*
 * Custom walker to print category checkboxes for widget forms
 *
class Walker_Category_Checklist_Widget extends Walker_Category_Checklist {

    private $name;
    private $id;

    function __construct( $name = '', $id = '' ) {
        $this->name = $name;
        $this->id = $id;
    }

    function start_el( &$output, $cat, $depth = 0, $args = array(), $id = 0 ) {
        extract( $args );

        if ( empty( $taxonomy ) ) $taxonomy = 'category';

        $id = $this->id . '-' . $cat->term_id;

        $checked = checked( in_array( $cat->term_id, $selected_cats ), true, false );
        
        $output .= "\n<li id='{$taxonomy}-{$cat->term_id}'>" 
            . '<label class="selectit"><input value="' 
            . $cat->term_id . '" type="checkbox" name="' . $this->name 
            . '[]" id="in-'. $id . '"' . $checked 
            . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' 
            . esc_html( apply_filters( 'the_category', $cat->name ) ) 
            . '</label>';
      }
}*/


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
        $categories_count = count($instance['widget_categories']);

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
            echo '<div class="width-wrapper large-spacer">';
                echo '<div class="linha-header-longa">';
                    if ($categories_count == 1) {
                        echo '<h2 class="linha-header"><a href="', esc_url(get_category_link($instance['widget_categories'][0]))  ,  '" class="">' , esc_html(get_cat_name($instance['widget_categories'][0])) , '</a></h2>';
                    } else {
                        echo '<h2 class="linha-header"><a href="', get_home_url(), '/noticias/" class="">Notícias</a></h2>';
                    }
                echo '</div>';
                echo '<div class="noticias-widget">';                
                $postCount = 0;
                while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                    $postCount++;
                    $the_query->the_post();

                    echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-card linha-abaixo">';
                        echo '<div href="' , esc_url(the_permalink()) , '" class="noticia-card-imagem  small-spacer">';
                        echo    '<img src="', esc_url(the_post_thumbnail_url()), '">';
                        echo '</div>'; //noticia-imagem

                        $categories = get_the_category(); //categorias
                        if ($categories) {
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
                        echo '<div class=""><a href="', esc_url(get_category_link($instance['widget_categories'][0]))  ,  '" class="mais-link">Mais ' , esc_html(get_cat_name($instance['widget_categories'][0])) , '</a></div>';
                    } else {
                        echo '<div class=""><a href="', get_home_url(), '/noticias/" class="mais-link">Notícias</a></div>';
                    }
                    
                echo '</div>';

            echo '</div>'; //width-wrapper
        }

        echo $args['after_widget']; 
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['widget_categories'] = $new_instance['widget_categories'];
        return $instance;
    }

    function form( $instance ) {
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

