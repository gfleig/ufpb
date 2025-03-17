<?php

//============================EDITAIS===================================//

class WidgetEditais extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_editais',
            'Widget de Editais',
            array(
                'description' => 'Widget para exibir os últimos editais cadastrados ou atualizados'
            )
        );
    }

    public function widget($args, $instance) {
        $titulo = $instance['titulo']; 
        $the_query = new WP_Query( array(
            'posts_per_page' => 4,
            'post_type' => 'edital',
            'orderby' => 'modified',
            'no_found_rows' => true
        ));

        echo $args['before_widget'];

        if ($the_query->have_posts()) {
            echo '<div class="width-wrapper large-spacer">';
                echo '<div class="linha-header-longa">';
                    echo '<h2 class="linha-header"><a href="', get_home_url(), '/editais/" class="mais-link-header">' , esc_html($titulo) , '</a></h2>';
                echo '</div>';
            
            echo '
            
            <div class="editais">';
            $postCount = 0;
            while ($the_query->have_posts() && $postCount < 4) {
                $postCount++;
                $the_query->the_post();
                echo '<div class="edital-card linha-acima linha-abaixo">';
                    $categories = get_the_terms( get_the_ID(), 'edital_type' );
                    //$categories = get_the_category(); //categorias
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
                    echo '<a href="' , esc_url(the_permalink()) , '" class="titulo small-spacer" href="#">' , esc_html(the_title()) , '</a>';  
                    echo '<div class="data small-spacer" href="#">Atualizado em ' , esc_html(the_modified_date('j/m/Y')) , '</div>';                                  
                echo '</div>';
            }

            echo '</div> </div>';
        }
        echo $args['after_widget'];            
    }

    public function form($instance) { 
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Editais';
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

function registrar_widget_editais() {
    register_widget('WidgetEditais');
}
add_action('widgets_init', 'registrar_widget_editais');

?>