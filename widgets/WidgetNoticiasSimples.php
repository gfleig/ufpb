<?php

// Registrar Widget de Noticias novo
function registrar_widget_noticias_simples() {
    register_widget('WidgetNoticiasSimples');
}
add_action('widgets_init', 'registrar_widget_noticias_simples');

class WidgetNoticiasSimples extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Noticias_Simples',
            'Widget de Notícias Simples',
            array(
                'description' => 'Exibe as 4 últimas notícias em formato compacto'
            )
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        $posts_per_page = 4;
        
        $querry_args = array(
            'posts_per_page' => $posts_per_page,
            'no_found_rows' => true,
        );

        if (!empty($instance['tag'])) {
            $querry_args['category_name'] = $instance['tag'];
        }
        
        $the_query = new WP_Query($querry_args);

        if ( $the_query->have_posts() ) {
            echo '<div class="width-wrapper large-spacer">';
                echo '<div class="linha-header-longa">';
                    if (!empty($instance['tag'])) {
                        echo '<h2 class="linha-header"><a href="', esc_url(get_category_link(get_cat_ID($instance['tag'])))  ,  '" class="mais-link-header">' , esc_html($instance['tag']) , '</a></h2>';
                    } else {
                        echo '<h2 class="linha-header"><a href="', get_home_url(), '/noticias/" class="mais-link-header">Notícias</a></h2>';
                    }
                echo '</div>';
                echo '<div class="noticias-widget-linha large-spacer">';                
                $postCount = 0;
                while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                    $postCount++;
                    $the_query->the_post();

                    echo '<div class="noticia-card linha-abaixo">';
                        echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-card-imagem  small-spacer">';
                        echo    '<img src="', esc_url(the_post_thumbnail_url()), '">';
                        echo '</a>'; //noticia-imagem

                        $categories = get_the_category(); //categorias
                        if ($categories && empty($instance['tag'])) {
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

                        //echo '<div class="bigode small-spacer">' , esc_html(the_excerpt()) , '</div>'; //excerpt
                        echo '</div>';

                        echo '<div class="data">' . get_the_date( 'j \d\e F \d\e Y' ) . '</div>'; //data
                        
                    echo '</div>'; //noticia-card
                }           

                echo '</div>';
            echo '</div>'; //width-wrapper
        }

        echo $args['after_widget']; 
    }

    public function form($instance) {
        $tag = esc_html($instance['tag']);               
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('tag'); ?>">Categoria a ser exibida (deixar vazio para mostrar todas as categorias):</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('tag'); ?>" name="<?php echo $this->get_field_name('tag'); ?>" type="text" value="<?php echo $tag; ?>">
        </p>
        <?php        
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['tag'] = !empty($new_instance['tag']) ? esc_html($new_instance['tag']) : "";
            
        return $instance;
    }
}

?>