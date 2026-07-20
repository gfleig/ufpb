<?php

class Widget_Editora_Catalogo extends WP_Widget 
{
    public function __construct() 
    {
        parent::__construct(
            'widget_editora_catalogo',
            'Catálogo de Livros', 
            [ 'description' => __( 'Exibe os últimos 10 lançamentos da Editora UFPB através da API do OMP.' ) ] 
        );        
    }

    public function widget( $args, $instance ) 
    {    
        $api_url = 'https://www.editora.ufpb.br/press5/index.php/UFPB/api/v1/submissions?status=3&orderBy=datePublished&count=10&apiToken='; // Example API endpoint
        $api_token = $instance['api_token'];
        $response = wp_remote_get( $api_url . $api_token);

        if ( is_wp_error( $response ) ) {
            echo '<p>Error fetching data from API.</p>';
        } else {
           
            $body = wp_remote_retrieve_body( $response );
            $data = json_decode( $body );

            if ( $data ) {
                echo '<div class="editora-catalogo-widget width-wrapper large-spacer">';

                    echo '<div class="linha-header-longa">';                
                        echo '<h2 class="linha-header"><a href="https://www.editora.ufpb.br/press5/index.php/UFPB/catalog" target="_blank" class="">Últimos Lançamentos</a></h2>';                
                    echo '</div>';

                    echo '<div class="editora-catalogo">';
                    for($i = 0; $i < 10; $i++) {
                        echo '<a class="publicacao" href="' . esc_html( $data->items[$i]->urlPublished ) . '" target="_blank">';
                            echo '<img src="https://www.editora.ufpb.br/press5/public/presses/1/' . esc_html( $data->items[$i]->publications[0]->coverImage->pt_BR->uploadName ) . '" alt="">';
                            echo '<div class=titulo>' . esc_html( $data->items[$i]->publications[0]->fullTitle->pt_BR ) . '</div>';
                        echo '</a>';
                    }
                    echo '</div>';                    

                    echo '<div class="large-spacer mais-noticias">';
                            echo '<div class=""><a href="https://www.editora.ufpb.br/press5/index.php/UFPB/catalog" target="_blank" class="mais-link">Catálogo Completo</a></div>';                    
                    echo '</div>';

                echo '</div>';                
                
            } else {
                echo '<p>No data found.</p>';
            }
        }
        
    }

    public function update( $new_instance, $old_instance ) 
    {
        $instance = $old_instance;

        $instance['api_token'] = !empty($new_instance['api_token']) ? esc_html($new_instance['api_token']) : null;

        return $instance;
    }

    public function form( $instance ) 
    {        
        $api_token = $instance['api_token'];    

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('api_token'); ?>">Token da API para puxar dados dos livros:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('api_token'); ?>" name="<?php echo $this->get_field_name('api_token'); ?>" type="text" value="<?php echo $api_token; ?>">
        </p>
        <?php
    }

}

add_action( 'widgets_init', function () 
{
    register_widget( 'Widget_Editora_Catalogo' );
});