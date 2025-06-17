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
        /* QUERY ANTIGA
        $the_query = new WP_Query( array(
            'posts_per_page' => $posts_per_page,
            'no_found_rows' => true
        ));*/

        $sticky_query_args = array(
            'fields' => 'ids',                      //pega só ids dos posts 
            'posts_per_page' => $posts_per_page,    //no máximo $posts_per_page posts
            'no_found_rows' => true,                //otimização
            'post__in' => get_option( 'sticky_posts' ), //postagens sticky
            'ignore_sticky_posts' => true           //otimização
        );

        $regular_query_args = array(
            'fields' => 'ids',                      //pega só ids dos posts
            'posts_per_page' => $posts_per_page,    //no máximo $posts_per_page posts  
            'no_found_rows' => true,                // otimização
            'post__not_in' => get_option( 'sticky_posts' ), //postagens não-sticky
            'ignore_sticky_posts' => true           //otimização
        );

        if (!empty($instance['tag'])) {             //se usuário selecionar uma categoria específica, só ela vai entrar na query
            $sticky_query_args['category__in'] = array(get_cat_ID($instance['tag']));
            $regular_query_args['category__in'] = array(get_cat_ID($instance['tag']));
        }

        if (!empty($instance['exclude'])) {         //se usuário selecionar uma categoria específica, ela será excluída da query
            $sticky_query_args['category__not_in'] = array(get_cat_ID($instance['exclude']));
            $regular_query_args['category__not_in'] = array(get_cat_ID($instance['exclude']));
        }

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
                    echo '<h2 class="linha-header"><a href="', get_home_url(), '/noticias/" class="mais-link-header">Notícias</a></h2>';
                echo '</div>';
                echo '<div class="noticias-widget">';                
                $postCount = 0;
                while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                    $postCount++;
                    $the_query->the_post();

                    echo '<div class="noticia-card linha-abaixo">';
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

                echo '</div>'; //noticias-widget
            echo '</div>'; //width-wrapper
        }

        echo $args['after_widget']; 
    }

    public function form($instance) {
        $tag = esc_html($instance['tag']); 
        $exclude = esc_html($instance['exclude']);              
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('tag'); ?>">Categoria a ser exibida (deixar vazio para mostrar todas as categorias):</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('tag'); ?>" name="<?php echo $this->get_field_name('tag'); ?>" type="text" value="<?php echo $tag; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('exclude'); ?>">Categoria a ser excluída (deixar vazio para não excluir nenhuma):</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('exclude'); ?>" name="<?php echo $this->get_field_name('exclude'); ?>" type="text" value="<?php echo $exclude; ?>">
        </p>
        <?php        
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['tag'] = !empty($new_instance['tag']) ? esc_html($new_instance['tag']) : "";
        $instance['exclude'] = !empty($new_instance['exclude']) ? esc_html($new_instance['exclude']) : "";
            
        return $instance;
    }
}

?>