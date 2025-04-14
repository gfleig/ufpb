<?php

include get_theme_file_path('/widgets/WidgetLinksMarcas.php');
include get_theme_file_path('/widgets/WidgetLinksRapidosOito.php');
include get_theme_file_path('/widgets/WidgetLinksImagens.php');
include get_theme_file_path('/widgets/WidgetApresentacao.php');
include get_theme_file_path('/widgets/WidgetEventos.php');
include get_theme_file_path('/widgets/WidgetNoticias.php');
include get_theme_file_path('/widgets/WidgetDestaqueSolo.php');
include get_theme_file_path('/widgets/WidgetDestaqueTriplo.php');
include get_theme_file_path('/widgets/WidgetDestaqueDuplo.php');
include get_theme_file_path('/widgets/WidgetDestaqueSoloInvertido.php');
include get_theme_file_path('/widgets/WidgetEditais.php');
include get_theme_file_path('/widgets/WidgetMapaEFoto.php');
include get_theme_file_path('/widgets/WidgetNoticiasSimples.php');

add_filter('render_block', function ($blockContent, $block) {

    if ($block['blockName'] !== 'core/heading') {
        return $blockContent;
    }           

    $pattern = '/(<h[^>]*>)(.*)(<\/h[2]{1}>)/i';
    $replacement = '$1<div class="linha-header">$2</div>$3';
    return preg_replace($pattern, $replacement, $blockContent);

}, 10, 2);

//date_default_timezone_set('America/Recife');

add_theme_support( 'post-thumbnails' );

add_theme_support('editor-styles');
add_editor_style( 'editor-style.css' );

// Adding excerpt for page
add_post_type_support( 'page', 'excerpt' );

function controle_linguas($wp_customize) {
    $wp_customize->add_section('secao_traducao', array(
        'title' => 'Tradução',
        'priority' => 30,
    ));

    $wp_customize->add_setting('secao_traducao', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_setting( 'traducao_geral', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'ufpb_sanitize_checkbox',
    ));
    $wp_customize->add_control( 'traducao_geral', array(
        'type' => 'checkbox',
        'section' => 'secao_traducao',
        'label' => __( 'Ativar Menu de Tradução' ),
        'description' => __( 'Se estiver marcado, o menu com as opções de línguas estará disponível no site.' ),
    ));
    function ufpb_sanitize_checkbox( $checked ) {
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }

    $wp_customize->add_setting( 'check_ingles', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'ufpb_sanitize_checkbox',
    ));
    $wp_customize->add_control( 'check_ingles', array(
        'type' => 'checkbox',
        'section' => 'secao_traducao',
        'label' => __( 'Ativar Tradução para Inglês' ),
    ));

    // Campo de URL personalizado
    $wp_customize->add_setting('url_ingles', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('url_ingles', array(
        'label' => 'URL do Site em Inglês',
        'section' => 'secao_traducao',
        'type' => 'url',
    ));
}
add_action('customize_register', 'controle_linguas');


// Hero Image
function adicionar_controle_heroimage($wp_customize) {
    $wp_customize->add_section('secao_heroimage', array(
        'title' => 'Hero Image',
        'priority' => 30,
    ));

    $wp_customize->add_setting('heroimage', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'heroimage', array(
        'label' => 'Escolha a imagem que servirá como Hero Image. Tamanho mínimo: 1920 x 550 (Use https://tinypng.com/ para otimizar o carregamento).',
        'section' => 'secao_heroimage',
        'settings' => 'heroimage',
    )));

    // Campo de Título
    $wp_customize->add_setting('heroimage_titulo', array(
        'default' => 'Título massa da Hero Image!',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('heroimage_titulo', array(
        'label' => 'Título da Hero Image',
        'section' => 'secao_heroimage',
        'type' => 'text',
    ));

    // Campo de Subtítulo
    $wp_customize->add_setting('heroimage_subtitulo', array(
        'default' => 'Subtítulo interessante, mantenha ele curto, por favor…',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('heroimage_subtitulo', array(
        'label' => 'Subtítulo da Hero Image',
        'section' => 'secao_heroimage',
        'type' => 'text',
    ));

    // Campo de Subtítulo
    $wp_customize->add_setting('heroimage_link_titulo', array(
        'default' => 'Descubra Mais',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('heroimage_link_titulo', array(
        'label' => 'Título do Link da Hero Image',
        'section' => 'secao_heroimage',
        'type' => 'text',
    ));

    // Campo de URL personalizado
    $wp_customize->add_setting('heroimage_link_url', array(
        'default' => 'http://ufpb.br',
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('heroimage_link_url', array(
        'label' => 'URL do link da Hero Image',
        'section' => 'secao_heroimage',
        'type' => 'url',
    ));
}
add_action('customize_register', 'adicionar_controle_heroimage');

//Cor personalizada
function meu_tema_personalizado($wp_customize) {   
    /**
    ------------------------------------------------------------
    SECTION: Header
    ------------------------------------------------------------
    **/
    $wp_customize->add_section('section_header', array(
        'title'          => esc_html__('Header do Site', 'meu-tema'),
        'description'    => esc_attr__( 'Escolha entre 2 estilo de header para o site:', 'meu-tema' ),
        'priority'       => 1,
    ));

        /**
        Header Styles
        **/
        $wp_customize->add_setting( 'header_styles', array(
            'default'    => 'headerPadrao',
        ));
        $wp_customize->add_control( 'header_styles', array(
            'label'      => esc_html__( 'Estilos de Header', 'meu-tema' ),
            'section'    => 'section_header',
            'type'       => 'select',
            'choices'    => array(
                'headerPadrao'    => esc_html__('Header Padrão', 'meu-tema'),
                'headerPortal'    => esc_html__('Header para Portal', 'meu-tema')            
            )
        ));

    // Adicionando a seção de cores personalizadas
    $wp_customize->add_section('cores_personalizadas', array(
      'title' => __('Cor do site', 'meu-tema'),
      'description' => __('Personalize a cor do site', 'meu-tema'),
      'priority' => 30
    ));
  
    // Adicionando a opção de cor padrão do tema
    $wp_customize->add_setting('cor_padrao', array(
      'default' => '#0b52b5',
      'transport' => 'refresh'
    ));
  
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cor_padrao', array(
      'label' => __('Cor Padrão do Tema', 'meu-tema'),
      'section' => 'cores_personalizadas',
      'settings' => 'cor_padrao'
    )));  
}
add_action('customize_register', 'meu_tema_personalizado');

//pega f text da imagem upada na biblioteca a partir da url
function image_alt_by_url($image_url) {
    $image_id = attachment_url_to_postid($image_url);
    $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
    return $alt; 
}

//LOGO
function themename_custom_logo_setup() {
    $defaults = array(
        'height'               => 150,
        'width'                => 150,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => false, 
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

// imagem banner
function adicionar_controle_imagem_banner($wp_customize) {
    $wp_customize->add_section('secao_imagem_banner', array(
        'title' => 'Imagem de banner',
        'priority' => 30,
    ));

    $wp_customize->add_setting('imagem_banner', array(
        'default' => '',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'imagem_banner', array(
        'label' => 'Escolha a imagem de decoração: 1920 x 300. (Use https://tinypng.com/ para otimizar o carregamento.)',
        'section' => 'secao_imagem_banner',
        'settings' => 'imagem_banner',
    )));
}
add_action('customize_register', 'adicionar_controle_imagem_banner');

function summon_banner_top(){
    // Obtém a URL da imagem do Customizer
    $imagem_banner_url = get_theme_mod('imagem_banner');

    echo '<div class="imagem banner-topo">';

    if (!empty($imagem_banner_url)) {
        echo '<img src="' . esc_url($imagem_banner_url) . '" alt="Imagem decorativa do site">';
    } else {
        echo '<img src="' , get_bloginfo("template_directory") , '/decoration.jpg" alt="Imagem decorativa do site">';
    }        
    echo '</div>'; 
}

function get_heroimage_url(){
    // Obtém a URL da imagem do Customizer
    $imagem_url = get_theme_mod('heroimage');

    if (!empty($imagem_url)) {
        return esc_url($imagem_url);
    } else {
        return esc_url(get_bloginfo("template_directory") , '/decoration.jpg');
    }        
}

function summon_banner_bottom(){
    // Obtém a URL da imagem do Customizer
    $imagem_banner_url = get_theme_mod('imagem_banner');

    echo '<div class="imagem">';

    if (!empty($imagem_banner_url)) {
        echo '<img src="' . esc_url($imagem_banner_url) . '" alt="Imagem decorativa do site">';
    } else {
        echo '<img src="' , get_bloginfo("template_directory") , '/decoration.jpg" alt="Imagem decorativa do site">';
    }        
    echo '</div>'; 
}

//registrar menus
function register_menus() { 
    register_nav_menus(
        array(
            'main-menu' => 'Menu Principal',          
        )
    ); 
}
add_action( 'init', 'register_menus' );

// adicionar opcao de classes pros menus
function add_menu_link_class( $atts, $item, $args ) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

function cats_related_post() {
    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && !is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);

    $query_args = array( 
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => '4',
     );

    $related_cats_post = new WP_Query( $query_args );

    if($related_cats_post->have_posts()){
        $first_post = true; // usado para adicionar linha acima no primeiro post apenas
        echo '<div class="sidebar-noticias">
            <h2 class="menu-lateral-h2">Notícias Relacionadas</h2>
            <div class="noticias-relacionadas">';
            while($related_cats_post->have_posts()){
                $related_cats_post->the_post();
                    if ($first_post) {
                        echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper linha-abaixo linha-acima">';
                        $first_post = false;
                    } else {
                        echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper linha-abaixo">';
                    }               
                    
                    echo '<div class="noticia-relacionada-imagem">
                        <img src="', esc_url(the_post_thumbnail_url()), '">
                    </div>';        
                                
                    echo '<div class="noticia-relacionada-titulo">' , esc_html(the_title()) , '</div>';
                echo '</a>'; //noticia-wrapper 
            }
            ?> 
            </div> <!-- fecha div noticias-relacionadas -->
        </div> <?php
    }
            
            
        
    
    // Restore original Post Data
    wp_reset_postdata();
}

// Registrar widgets
function registrar_widgets_personalizados() {   
    register_sidebar(array(
        'name'          => 'Widgets da Home',
        'id'            => 'widgets-da-home',
        'description'   => 'Insira os widgets que aparecerão na página inicial.',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ));    
}
// Hook para registrar os widgets
add_action('widgets_init', 'registrar_widgets_personalizados');

// CENTRO DE ENSINO
// Adiciona seção ao Customizer
function customizer_centro($wp_customize) {
    // Seção para configurações personalizadas
    $wp_customize->add_section('customizer_centro', array(
        'title' => 'Centro de Ensino',
        'priority' => 30,
    ));
    // Campo de texto personalizado
    $wp_customize->add_setting('custom_centro', array(
        'default' => 'Universidade Federal da Paraíba',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_centro', array(
        'label' => 'Nome do Centro',
        'section' => 'customizer_centro',
        'type' => 'text',
    ));
    // Campo de URL personalizado
    $wp_customize->add_setting('custom_urlcentro', array(
        'default' => 'http://ufpb.br',
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_urlcentro', array(
        'label' => 'URL do Site do Centro',
        'section' => 'customizer_centro',
        'type' => 'url',
    ));
}
add_action('customize_register', 'customizer_centro');

// Redes Sociais
// Adiciona seção ao Customizer
function customizer_contato($wp_customize) {
    // Seção para configurações personalizadas
    $wp_customize->add_section('customizer_contato', array(
        'title' => 'Contato, endereço e redes sociais',
        'priority' => 31,
    ));

    // Campos de texto personalizado

    // ======= ENDEREÇO ========

    $wp_customize->add_setting('custom_logradouro', array(
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_logradouro', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: Rua dos Bobos'),
        ),
        'label' => 'Logradouro',
        'section' => 'customizer_contato',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('custom_numero', array(        
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_numero', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: 157'),
        ),
        'label' => 'Número',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_complemento', array(
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_complemento', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: Sala 68'),
        ),
        'label' => 'Complemento',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_bairro', array( 
        'default' => 'Cidade Universitária',       
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_bairro', array(        
        'label' => 'Bairro',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_CEP', array(
        'default' => '58.051-900',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_CEP', array(
        'label' => 'CEP',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_cidade', array(
        'default' => 'João Pessoa',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_cidade', array(
        'label' => 'Cidade/local',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_estado', array(
        'default' => 'Paraíba',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_estado', array(
        'label' => 'Estado',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));
   
    // ======= CONTATO ========

    $wp_customize->add_setting('custom_telefone', array(
        'default' => '+55 (83) 3216-7200',
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_telefone', array(
        'label' => 'Telefone (com DDD)',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_url_contato', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_url_contato', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: http://ufpb.br/contato'),
        ),
        'label' => 'URL de contato',
        'section' => 'customizer_contato',
        'type' => 'url',
    ));

    $wp_customize->add_setting('custom_horario', array(
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário
    ));
    $wp_customize->add_control('custom_horario', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: De Segunda à Sexta, das 8h às 18h'),
        ),
        'label' => 'Horário de Atendimento',
        'section' => 'customizer_contato',
        'type' => 'text'
        
    ));

    // ======= REDES SOCIAIS ========

    $wp_customize->add_setting('custom_whatsapp', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('custom_whatsapp', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: +558399991-0105'),
        ),
        'label' => 'Número do Whatsapp, em formato +5583XXXXX-XXXX',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_instagram', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('custom_instagram', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: https://instagram.com/ufpb.oficial'),
        ),
        'label' => 'Link da página do Instagram',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_x', array(   
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_x', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: https://x.com/ufpboficial'),
        ),
        'label' => 'Link da página do X',
        'section' => 'customizer_contato',
        'type' => 'text',
    ));

    $wp_customize->add_setting('custom_facebook', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_facebook', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: https://www.facebook.com/UFPBoficial'),
        ),
        'label' => 'URL da página do Facebook',
        'section' => 'customizer_contato',
        'type' => 'url',
    ));

    $wp_customize->add_setting('custom_youtube', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_youtube', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: https://www.youtube.com/user/TVUFPB'),
        ),
        'label' => 'URL do canal do YouTube',
        'section' => 'customizer_contato',
        'type' => 'url',
    ));
    $wp_customize->add_setting('custom_linkedin', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_linkedin', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: https://br.linkedin.com/school/ufpb/'),
        ),
        'label' => 'URL da página do Linkedin',
        'section' => 'customizer_contato',
        'type' => 'url',
    ));
    $wp_customize->add_setting('custom_spotify', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_spotify', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: https://open.spotify.com/intl-pt/artist/1DFr97A9HnbV3SKTJFu62M'),
        ),
        'label' => 'URL da página do Spotify',
        'section' => 'customizer_contato',
        'type' => 'url',
    ));
    $wp_customize->add_setting('custom_flickr', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_flickr', array(
        'input_attrs' => array(
            'placeholder' => __('Insira a URL da página do Flickr'),
        ),
        'label' => 'URL da página do Flickr',
        'section' => 'customizer_contato',
        'type' => 'url',
    ));
}
add_action('customize_register', 'customizer_contato');


class WidgetLinksRapidos extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_links_rapidos',
            'Widget de Links Rápidos',
            array(
                'description' => 'Widget para adicionar 6 links rápidos'
            )
        );
    }

    public function widget($args, $instance) {
        $titulo = $instance['titulo'];

        $text = [        
            $instance['text_primeiro'],
            $instance['text_segundo'],
            $instance['text_terceiro'],
            $instance['text_quarto'],
            $instance['text_quinto'],
            $instance['text_sexto']
        ];

        $icon = [
            $instance['icon_primeiro'],
            $instance['icon_segundo'],
            $instance['icon_terceiro'],
            $instance['icon_quarto'],
            $instance['icon_quinto'],
            $instance['icon_sexto']
        ];
        
        $link = [
            $instance['primeiro'],
            $instance['segundo'],
            $instance['terceiro'],
            $instance['quarto'],
            $instance['quinto'],
            $instance['sexto']
        ];

        echo $args['before_widget'];
        echo '
        <div class="width-wrapper large-spacer">
            <div class="linha-header-longa">
                <h2 class="linha-header"> ' , esc_html($titulo) , ' </h2>
                <div class="links">';

        for ($i = 0; $i < 6; $i++) {
            echo '
            <a href="' . esc_url($link[$i]) . '" class="link-full linha-abaixo">
                <div class="link-image-wrapper">              
                    <i class="' . esc_attr($icon[$i]) . '"></i>              
                </div>          
                <div class="link-text texto-escuro" href="#">' . esc_html($text[$i]) . '</div>
            </a>';
        }        
        
        echo '
                </div>
            </div>
        </div>';

        echo $args['after_widget'];            
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Acesso Rápido';

        // nomes dos links, para exibição
        $text_primeiro = !empty($instance['text_primeiro']) ? esc_html($instance['text_primeiro']) : 'Pri';
        $text_segundo = !empty($instance['text_segundo']) ? esc_html($instance['text_segundo']) : 'Seg';
        $text_terceiro = !empty($instance['text_terceiro']) ? esc_html($instance['text_terceiro']) : 'Ter';
        $text_quarto = !empty($instance['text_quarto']) ? esc_html($instance['text_quarto']) : 'Qua';
        $text_quinto = !empty($instance['text_quinto']) ? esc_html($instance['text_quinto']) : 'Qui';
        $text_sexto = !empty($instance['text_sexto']) ? esc_html($instance['text_sexto']) : 'Sex';

        //icones do fontawesome
        $icon_primeiro = !empty($instance['icon_primeiro']) ? esc_attr($instance['icon_primeiro']) : 'fa-solid fa-pen-fancy';
        $icon_segundo = !empty($instance['icon_segundo']) ? esc_attr($instance['icon_segundo']) : 'fa-solid fa-pen-fancy';
        $icon_terceiro = !empty($instance['icon_terceiro']) ? esc_attr($instance['icon_terceiro']) : 'fa-solid fa-pen-fancy';
        $icon_quarto = !empty($instance['icon_quarto']) ? esc_attr($instance['icon_quarto']) : 'fa-solid fa-pen-fancy';
        $icon_quinto = !empty($instance['icon_quinto']) ? esc_attr($instance['icon_quinto']) : 'fa-solid fa-pen-fancy';
        $icon_sexto = !empty($instance['icon_sexto']) ? esc_attr($instance['icon_sexto']) : 'fa-solid fa-pen-fancy';

        //links dos... bem, links
        $primeiro = !empty($instance['primeiro']) ? esc_url($instance['primeiro']) : '#';
        $segundo = !empty($instance['segundo']) ? esc_url($instance['segundo']) : '#';
        $terceiro = !empty($instance['terceiro']) ? esc_url($instance['terceiro']) : '#';
        $quarto = !empty($instance['quarto']) ? esc_url($instance['quarto']) : '#';
        $quinto = !empty($instance['quinto']) ? esc_url($instance['quinto']) : '#';
        $sexto = !empty($instance['sexto']) ? esc_url($instance['sexto']) : '#';        

        // Formulário de configuração do widget
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text_primeiro'); ?>">Título do primeiro link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_primero'); ?>" name="<?php echo $this->get_field_name('text_primeiro'); ?>" type="text" value="<?php echo $text_primeiro; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_primeiro'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_primero'); ?>" name="<?php echo $this->get_field_name('icon_primeiro'); ?>" type="text" value="<?php echo $icon_primeiro; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('primeiro'); ?>">Endereço do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('primero'); ?>" name="<?php echo $this->get_field_name('primeiro'); ?>" type="url" value="<?php echo $primeiro; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_segundo'); ?>">Título do segundo link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_segundo'); ?>" name="<?php echo $this->get_field_name('text_segundo'); ?>" type="text" value="<?php echo $text_segundo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_segundo'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_segundo'); ?>" name="<?php echo $this->get_field_name('icon_segundo'); ?>" type="text" value="<?php echo $icon_segundo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('segundo'); ?>">Endereço do segundo link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('segundo'); ?>" name="<?php echo $this->get_field_name('segundo'); ?>" type="url" value="<?php echo $segundo; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_terceiro'); ?>">Título do terceiro link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_terceiro'); ?>" name="<?php echo $this->get_field_name('text_terceiro'); ?>" type="text" value="<?php echo $text_terceiro; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_terceiro'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_terceiro'); ?>" name="<?php echo $this->get_field_name('icon_terceiro'); ?>" type="text" value="<?php echo $icon_terceiro; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('terceiro'); ?>">Endereço do terceiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('terceiro'); ?>" name="<?php echo $this->get_field_name('terceiro'); ?>" type="url" value="<?php echo $terceiro; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_quarto'); ?>">Título do quarto link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_quarto'); ?>" name="<?php echo $this->get_field_name('text_quarto'); ?>" type="text" value="<?php echo $text_quarto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_quarto'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_quarto'); ?>" name="<?php echo $this->get_field_name('icon_quarto'); ?>" type="text" value="<?php echo $icon_quarto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('quarto'); ?>">Endereço do quarto link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('quarto'); ?>" name="<?php echo $this->get_field_name('quarto'); ?>" type="url" value="<?php echo $quarto; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_quinto'); ?>">Título do quinto link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_quinto'); ?>" name="<?php echo $this->get_field_name('text_quinto'); ?>" type="text" value="<?php echo $text_quinto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_quinto'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_quinto'); ?>" name="<?php echo $this->get_field_name('icon_quinto'); ?>" type="text" value="<?php echo $icon_quinto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('quinto'); ?>">Endereço do quinto link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('quinto'); ?>" name="<?php echo $this->get_field_name('quinto'); ?>" type="url" value="<?php echo $quinto; ?>">
        </p><br>

        <p>
            <label for="<?php echo $this->get_field_id('text_sexto'); ?>">Título do sexto link:</label>
            <input class="widefat" maxlength="50" id="<?php echo $this->get_field_id('text_sexto'); ?>" name="<?php echo $this->get_field_name('text_sexto'); ?>" type="text" value="<?php echo $text_sexto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('icon_sexto'); ?>">Ícone do primeiro link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon_sexto'); ?>" name="<?php echo $this->get_field_name('icon_sexto'); ?>" type="text" value="<?php echo $icon_sexto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('sexto'); ?>">Endereço do sexto link rápido:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('sexto'); ?>" name="<?php echo $this->get_field_name('sexto'); ?>" type="url" value="<?php echo $sexto; ?>">
        </p>        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : 'erro';

        $instance['text_primeiro'] = !empty($new_instance['text_primeiro']) ? esc_html($new_instance['text_primeiro']) : 'erro';
        $instance['icon_primeiro'] = !empty($new_instance['icon_primeiro']) ? esc_attr($new_instance['icon_primeiro']) : 'fa-solid fa-pen-fancy';
        $instance['primeiro'] = !empty($new_instance['primeiro']) ? esc_url($new_instance['primeiro']) : '#';

        $instance['text_segundo'] = !empty($new_instance['text_segundo']) ? esc_html($new_instance['text_segundo']) : 'erro';
        $instance['icon_segundo'] = !empty($new_instance['icon_segundo']) ? esc_attr($new_instance['icon_segundo']) : 'fa-solid fa-pen-fancy';
        $instance['segundo'] = !empty($new_instance['segundo']) ? esc_url($new_instance['segundo']) : '#';

        $instance['text_terceiro'] = !empty($new_instance['text_terceiro']) ? esc_html($new_instance['text_terceiro']) : 'erro';
        $instance['icon_terceiro'] = !empty($new_instance['icon_terceiro']) ? esc_attr($new_instance['icon_terceiro']) : 'fa-solid fa-pen-fancy';
        $instance['terceiro'] = !empty($new_instance['terceiro']) ? esc_url($new_instance['terceiro']) : '#';

        $instance['text_quarto'] = !empty($new_instance['text_quarto']) ? esc_html($new_instance['text_quarto']) : 'erro';
        $instance['icon_quarto'] = !empty($new_instance['icon_quarto']) ? esc_attr($new_instance['icon_quarto']) : 'fa-solid fa-pen-fancy';
        $instance['quarto'] = !empty($new_instance['quarto']) ? esc_url($new_instance['quarto']) : '#';

        $instance['text_quinto'] = !empty($new_instance['text_quinto']) ? esc_html($new_instance['text_quinto']) : 'erro';
        $instance['icon_quinto'] = !empty($new_instance['icon_quinto']) ? esc_attr($new_instance['icon_quinto']) : 'fa-solid fa-pen-fancy';
        $instance['quinto'] = !empty($new_instance['quinto']) ? esc_url($new_instance['quinto']) : '#';

        $instance['text_sexto'] = !empty($new_instance['text_sexto']) ? esc_html($new_instance['text_sexto']) : 'erro';
        $instance['icon_sexto'] = !empty($new_instance['icon_sexto']) ? esc_attr($new_instance['icon_sexto']) : 'fa-solid fa-pen-fancy';
        $instance['sexto'] = !empty($new_instance['sexto']) ? esc_url($new_instance['sexto']) : '#';

        return $instance;
    }

}

function registrar_widget_links_rapidos() {
    register_widget('WidgetLinksRapidos');
}
add_action('widgets_init', 'registrar_widget_links_rapidos');

// get top ancestor
// from https://www.youtube.com/watch?v=GHTZn3atTcM
function get_top_ancestor_id() {
    global $post;

    if ($post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    return $post->ID;
}

// pagina tem filho?
function has_children() {
    global $post;

    $pages = get_pages('child_of=' . $post->ID);
    return count($pages);
}

//######################################################################################
//################################# META BOX STUFF #####################################
//######################################################################################

abstract class DatePicker_Meta_Box {

	public static function add() {
        add_meta_box(
            'datepicker_inicio',       // Unique ID
            'Informações do evento',         // Box title
            [ self::class, 'html' ],   // Content callback, must be of type callable
            'evento',                    // Post type
            'side'                     // local onde fica
        );        
	}

	public static function save( int $post_id ) {
		if ( array_key_exists( 'data_inicio', $_POST ) ) {
            $data_inicio_formatted = strtotime($_POST['data_inicio']);
			update_post_meta(
				$post_id,
				'__data_inicio',
				$data_inicio_formatted
			);
            update_post_meta(
				$post_id,
				'__data_inicio_original',
				$_POST['data_inicio'],
			);
            update_post_meta(
				$post_id,
				'__data_fim',
				$data_inicio_formatted,
			);            
        }		
        if ( array_key_exists( 'data_fim', $_POST) && !empty($_POST['data_fim'])) {
            $data_fim_formatted = strtotime($_POST['data_fim']);
            $data_inicio_formatted = strtotime($_POST['data_inicio']);
            if ($data_fim_formatted >= $data_inicio_formatted) {
                update_post_meta(
                    $post_id,
                    '__data_fim',
                    $data_fim_formatted
                );
                update_post_meta(
                    $post_id,
                    '__data_fim_original',
                    $_POST['data_fim'],
                );
            } else {
                update_post_meta(
                    $post_id,
                    '__data_fim',
                    $data_inicio_formatted
                );
                update_post_meta(
                    $post_id,
                    '__data_fim_original',
                    $_POST['data_inicio'],
                );
            }
		}        
        if ( array_key_exists( 'local', $_POST ) ) {
			update_post_meta(
				$post_id,
				'__local',
				$_POST['local']
			);            
		}    
        if ( array_key_exists( 'local_end', $_POST ) ) {
			update_post_meta(
				$post_id,
				'__local_end',
				$_POST['local_end']
			);            
		}    
        if ( array_key_exists( 'horario', $_POST ) ) {
			update_post_meta(
				$post_id,
				'__horario',
				$_POST['horario']
			);            
		}
        if ( array_key_exists( 'custo', $_POST ) ) {
			update_post_meta(
				$post_id,
				'__custo',
				$_POST['custo']
			);            
		} 
        if ( array_key_exists( 'inscricoes', $_POST ) ) {
			update_post_meta(
				$post_id,
				'__inscricoes',
				$_POST['inscricoes']
			);            
		}
        if ( array_key_exists( 'inscricoes_link', $_POST ) ) {
			update_post_meta(
				$post_id,
				'__inscricoes_link',
				$_POST['inscricoes_link']
			);            
		}   
        if ( array_key_exists( 'informacoes', $_POST ) ) {
			update_post_meta(
				$post_id,
				'__informacoes',
				$_POST['informacoes']
			);            
		}
        if ( array_key_exists( 'informacoes_link', $_POST ) ) {
			update_post_meta(
				$post_id,
				'__informacoes_link',
				$_POST['informacoes_link']
			);            
		}  
	}

	public static function html( $post ) {
        $data_inicio        = get_post_meta( $post->ID, '__data_inicio_original', true );       
        $data_fim           = get_post_meta( $post->ID, '__data_fim_original', true ); 
        $local              = get_post_meta( $post->ID, '__local', true );  
        $local_end          = get_post_meta( $post->ID, '__local_end', true );  
        $horario            = get_post_meta( $post->ID, '__horario', true );  
        $custo              = get_post_meta( $post->ID, '__custo', true ); 
        $informacoes        = get_post_meta( $post->ID, '__informacoes', true ); 
        $informacoes_link   = get_post_meta( $post->ID, '__informacoes_link', true ); 
        $inscricoes         = get_post_meta( $post->ID, '__inscricoes', true ); 
        $inscricoes_link    = get_post_meta( $post->ID, '__inscricoes_link', true ); 

        ?>
        <div style="display: flex; flex-direction: column; gap: .5rem">
            <label for="data_inicio">Data de início do evento:</label>
            <input name="data_inicio" type="date" value="<?php echo esc_attr($data_inicio); ?>">

            <p>Se o evento acontecer <strong>em apenas um dia</strong>, deixar a data de fim vazia ou com o mesma data do início do evento.</p>
            
            <label for="data_fim">Data de término do evento:</label>
            <input name="data_fim" type="date" value="<?php echo esc_attr($data_fim); ?>">

            <label for="local">Local do evento:</label>
            <input name="local" type="text" value="<?php echo esc_attr($local); ?>">

            <label for="local_end">Endereço:</label>
            <input name="local_end" type="text" value="<?php echo esc_attr($local_end); ?>">

            <label for="horario">Horário do evento:</label>
            <input name="horario" type="text" value="<?php echo esc_attr($horario); ?>">

            <label for="custo">Custo:</label>
            <input name="custo" type="text" value="<?php echo esc_attr($custo); ?>">

            <label for="inscricoes">Inscrições:</label>
            <input name="inscricoes" type="text" value="<?php echo esc_attr($inscricoes); ?>">

            <label for="inscricoes_link">Link para inscrições:</label>
            <input name="inscricoes_link" type="text" value="<?php echo esc_attr($inscricoes_link); ?>">

            <label for="informacoes">Mais informações:</label>
            <input name="informacoes" type="text" value="<?php echo esc_attr($informacoes); ?>">

            <label for="informacoes_link">Link para mais informações:</label>
            <input name="informacoes_link" type="text" value="<?php echo esc_attr($informacoes_link); ?>">
		<?php  
	}
}
add_action( 'add_meta_boxes', [ 'DatePicker_Meta_Box', 'add' ] );
add_action( 'save_post', [ 'DatePicker_Meta_Box', 'save' ] );


add_action( 'init', 'create_eventos');

function create_eventos() {
	register_post_type('evento',
		array(
			'labels'      => array(
				'name'              => __('Eventos', 'textdomain'),
				'singular_name'     => __('Evento', 'textdomain'),
                'add_new'           => _x('Adicionar novo', 'Evento'),
                'add_new_item'      => __('Adicionar novo evento'),
                'edit_item'         => __('Editar evento'),
                'new_item'          => __('Novo evento'),
                'view_item'         => __('Ver evento'),
                'search_items'      => __('Buscar eventos'),
                'not_found'         => __('Nenhum evento encontrado'),
                'not_found_in_trash'=> __('Nenhum evento encontrado na lixeira'),
                'parent_item_colon' => ''
			),
			'public'      => true,
			'has_archive' => false,
            'rewrite'     => array( 'slug' => 'eventos' ), // my custom slug
            'menu_icon'   => 'dashicons-calendar-alt',
            'supports'    => array(
                'title',
                'editor',
                'custom-fields',
                'revisions',
                'excerpt',
                'thumbnail'
            ),
            'show_in_rest' => true, //permite editor gutenberg
            'hierarchical' => false,
            
		)
	);
}

add_action( 'init', 'create_editais');

function create_editais() {
	register_post_type('edital',
		array(
			'labels'      => array(
				'name'              => __('Editais', 'textdomain'),
				'singular_name'     => __('Edital', 'textdomain'),
                'add_new'           => _x('Adicionar novo', 'Edital'),
                'add_new_item'      => __('Adicionar novo edital'),
                'edit_item'         => __('Editar edital'),
                'new_item'          => __('Novo edital'),
                'view_item'         => __('Ver edital'),
                'search_items'      => __('Buscar editais'),
                'not_found'         => __('Nenhum edital encontrado'),
                'not_found_in_trash'=> __('Nenhum edital encontrado na lixeira'),
                'parent_item_colon' => ''
			),
			'public'      => true,
			'has_archive' => false,
            'rewrite'     => array( 'slug' => 'editais' ), // my custom slug
            'menu_icon'   => 'dashicons-media-document',
            'supports'    => array(
                'title',
                'editor',
                'custom-fields',
                'revisions',
                'excerpt',
                'thumbnail'
            ),
            'show_in_rest' => true, //permite editor gutenberg
            //'taxonomies' => array('edital_type', 'edital')
            
		)
	);
    
    register_taxonomy(  
        'edital_type',  
        'edital',  // this is the custom post type(s) I want to use this taxonomy for
            array(  
                'hierarchical' => true,  
                'label' => 'Categoria do Edital',  
                'query_var' => true,  
                'rewrite' => true,
                'meta_box_cb' => true,
                'show_in_rest' =>true, 
            )  
        );  
    
}


// invoca wp_nav_menu e css deixa só com o submenu atual, se tiver
function summon_side_menu() {
    wp_nav_menu(   
        array ( 
            'theme_location' => 'side-menu',
            'items_wrap' => '%3$s',
            'container' => false,
            //'link_class'   => 'linha-abaixo',
            'fallback_cb' => '__return_false',
            'items_wrap' => '<div class="linha-header-longa linha-abaixo"><h2 class="menu-lateral-h2">Acesso Rápido</h2><ul class="menu-lateral">%3$s</ul></div>'
        ) 
    ); 
}

function summon_categorias_menu() {
    $categorias = get_categories(array(
        "type"      => "post",      
        "orderby"   => "name",
        "order"     => "ASC"
    )); 
    if (!empty($categorias)) {
        echo '<div class="side-menu-categorias">';
            echo '<h2 class="menu-lateral-h2">Categorias</h2>';
            echo '<ul class="menu-lateral linha-abaixo linha-header-longa">';
            foreach ($categorias as $categoria){
                echo '<li><a class="side-menu-button" href="' , esc_url(get_category_link($categoria->term_id)) , '">', esc_html($categoria->name) ,'</a></li>';
            }
            echo '</ul>';
        echo '</div>';
    }
}

function summon_categorias_edital_menu() {
    $categorias = get_terms(array(
        "taxonomy" => "edital_type",    
        "orderby"   => "name",
        "order"     => "ASC"
    )); 
    if (!empty($categorias)) {
        echo '<div class="side-menu-categorias">';
            echo '<h2 class="menu-lateral-h2">Categorias</h2>';
            echo '<ul class="menu-lateral linha-abaixo linha-header-longa">';
            foreach ($categorias as $categoria){
                echo '<li><a class="side-menu-button" href="' , esc_url(get_category_link($categoria->term_id)) , '">', esc_html($categoria->name) ,'</a></li>';
            }
            echo '</ul>';
        echo '</div>';
    }
}


/**
Busca Custom https://inspirationalpixels.com/search-results-filter-wordpress/
**/
function ufpb_search_filter_item_class($passed_string = false) {
    $post_type = (isset($_GET['post_type']) ? $_GET['post_type'] : false);

    if($passed_string == $post_type) {
        echo 'current';
    }
}

function ufpb_search_filter($query) {
	// Check we're not in admin area
	if(!is_admin()) {
		// Check if this is the main search query
		if($query->is_main_query() && $query->is_search()) {
			// Check if $_GET['post_type'] is set
			if(isset($_GET['post_type']) && $_GET['post_type'] != '') {
				// Filter it just to be safe
				$post_type = sanitize_text_field($_GET['post_type']);

				// Set the post type
				$query->set('post_type', $post_type);
			}
		}
	}

	// Return query
	return $query;
}

add_filter('pre_get_posts', 'ufpb_search_filter');

?>