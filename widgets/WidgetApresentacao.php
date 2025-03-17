<?php

class Widget_Apresentacao extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_apresentacao',
            'Widget de Apresentação',
            array(
                'description' => 'Um widget personalizado para apresentar a instituição, com título, vídeo, links, fotos e localização.'
            )
        );
    }

    // Função para exibir o widget no frontend
    public function widget($args, $instance) {
        echo $args['before_widget'];

        echo '
        <div class="destaque-solo large-spacer width-wrapper">
            <div class="linha-header-longa flex-grow-parent">                 
                <h2 class="linha-header small-spacer">' . nl2br(esc_html($instance['titulo'])) . '</h2>
                <div class="flex-grow">
                <p>' . nl2br(esc_html($instance['texto-apresentacao'])) . '</p>
                    <div class="apresentacao-links">';

                    if (!empty($instance['link1']) && !empty($instance['link1_nome'])) {
                        echo '<a class="mais-link linha-acima" href="', $instance['link1'] ,'">', $instance['link1_nome'] ,'</a>';
                    }
                    if (!empty($instance['link2']) && !empty($instance['link2_nome'])) {
                        echo '<a class="mais-link linha-acima" href="', $instance['link2'] ,'">', $instance['link2_nome'] ,'</a>';
                    }
                    if (!empty($instance['link3']) && !empty($instance['link3_nome'])) {
                        echo '<a class="mais-link linha-acima" href="', $instance['link3'] ,'">', $instance['link3_nome'] ,'</a>';
                    }                

                    echo '</div>
                </div>                
            </div>';

            if (!empty($instance['video-institucional'])) {
                $url = esc_url($instance['video-institucional']);
                $embed_url = str_replace("watch?v=", "embed/", $url);
                echo '<div class="destaque-solo-img"><iframe src="' . $embed_url . '" title="Youtube Video Player" frameborder="0" allow="web-share" allowfullscreen></iframe></div>';
            } else if (!empty($instance['localizacao'])) {
                echo '<div class="destaque-solo-img">' , $instance['localizacao'] , '</div>';
            } else if (!empty($instance['img_url'])) {
                echo '<div class="destaque-solo-img"><img src="' , $instance['img_url'] , '"></div>';
            }
        echo '</div>';   

        echo $args['after_widget'];
    }

    // Função para exibir o formulário de configuração do widget no painel de controle
    public function form($instance) {
        // Campos do widget
        $campos = array(
            'titulo' => 'Título da Apresentação',
            'texto-apresentacao' => 'Texto sobre a instituição',
            'link1' => 'Link 1 de apresentação',
            'link1_nome' => 'Nome de exibição do Link 1',
            'link2' => 'Link 2 de apresentação',
            'link2_nome' => 'Nome de exibição do Link 2',
            'link3' => 'Link 3 de apresentação',
            'link3_nome' => 'Nome de exibição do Link 3',
            'video-institucional' => 'Vídeo Institucional',            
            'localizacao' => 'Localização (cole apenas a URL de Incorporação do Google Maps)',
            'img_url' => 'Imagem a ser exibida'
        );

        echo '<p> Apenas a opção não-vazia mais acima entre <strong>Vídeo, Localização e Imagem</strong> será considerada na configuração do Widget.
            <br><br>Por exemplo, se este Widget conter um vídeo e localização ao mesmo tempo, apenas a localização será considerada.</p>
            <br><br>Os links são <strong>opcionais</strong>, mas recomendados. Preencha-os com sabedoria.</p>';

		// Exibir campos do formulário
		$index = 0;
		foreach ($campos as $campo => $label) {
		    $valor = !empty($instance[$campo]) ? esc_attr($instance[$campo]) : '';
		    echo '<p>';
		    echo '<label for="' . $this->get_field_id($campo) . '">' . esc_html($label) . ':</label>';		    
		    echo '<input class="widefat" id="' . $this->get_field_id($campo) . '" name="' . $this->get_field_name($campo) . '" type="text" value="' . $valor . '">';
		    echo '</p>';
		    $index = $index + 2;
		}
    }

    // Função para atualizar os valores do widget no painel de controle
    public function update($new_instance, $old_instance) {
        $instance = array();
        foreach ($new_instance as $campo => $valor) {
            $instance[$campo] = (!empty($valor)) ? $valor : '';
        }
        return $instance;
    }
}

function registrar_widget_apresentacao() {
    register_widget('Widget_Apresentacao');
}
add_action('widgets_init', 'registrar_widget_apresentacao');

?>