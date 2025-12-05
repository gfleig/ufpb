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
        $api_url = 'https://www.editora.ufpb.br/press5/index.php/UFPB/api/v1/submissions?status=3&orderBy=datePublished&count=10&apiToken=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.IjkxODFmZmYyYzJkZWRjMWQ3YzkzYjM5N2E5OTZkMGE0ZjRkOTI2YTYi.a7JdYxo0SeJhnPyhtcnHBXfXo6LG-UbUBQ70z291KIU'; // Example API endpoint
        $response = wp_remote_get( $api_url );

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
        return $new_instance;
    }

    public function form( $instance ) 
    {        
    
    }

}

add_action( 'widgets_init', function () 
{
    register_widget( 'Widget_Editora_Catalogo' );
});