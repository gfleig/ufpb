<?php

include get_theme_file_path('/widgets/WidgetLinksMarcas.php');
include get_theme_file_path('/widgets/WidgetLinksRapidosOito.php');
include get_theme_file_path('/widgets/WidgetLinksImagens.php');
include get_theme_file_path('/widgets/WidgetApresentacao.php');
include get_theme_file_path('/widgets/WidgetEventos.php');
include get_theme_file_path('/widgets/WidgetNoticias.php');
include get_theme_file_path('/widgets/WidgetDestaqueSolo.php');
include get_theme_file_path('/widgets/WidgetDestaqueTriplo.php');
include get_theme_file_path('/widgets/WidgetDestaqueSoloInvertido.php');
include get_theme_file_path('/widgets/WidgetEditais.php');
include get_theme_file_path('/widgets/WidgetMapaEFoto.php');
include get_theme_file_path('/widgets/WidgetNoticiasSimples.php');
include get_theme_file_path('/widgets/WidgetLinksRapidos.php');
include get_theme_file_path('/widgets/WidgetPatentes.php');
include get_theme_file_path('/widgets/WidgetNumeros.php');
include get_theme_file_path('/widgets/WidgetEditoraCatalogo.php');
include get_theme_file_path('/widgets/WidgetPostsCheck.php');
include get_theme_file_path('/widgets/WidgetNoticiasCheck.php');

function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );


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

    $wp_customize->add_setting( 'check_portugues', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'ufpb_sanitize_checkbox',
    ));
    $wp_customize->add_control( 'check_portugues', array(
        'type' => 'checkbox',
        'section' => 'secao_traducao',
        'label' => __( 'Ativar Link para site original em português' ),
    ));

    // Campo de URL personalizado
    $wp_customize->add_setting('url_portugues', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('url_portugues', array(
        'label' => 'URL do Site original em português',
        'section' => 'secao_traducao',
        'type' => 'url',
    ));

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

    $wp_customize->add_setting( 'check_espanhol', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'ufpb_sanitize_checkbox',
    ));
    $wp_customize->add_control( 'check_espanhol', array(
        'type' => 'checkbox',
        'section' => 'secao_traducao',
        'label' => __( 'Ativar Tradução para Espanhol' ),
    ));

    // Campo de URL personalizado
    $wp_customize->add_setting('url_espanhol', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('url_espanhol', array(
        'label' => 'URL do Site em Espanhol',
        'section' => 'secao_traducao',
        'type' => 'url',
    ));

    $wp_customize->add_setting( 'check_frances', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'ufpb_sanitize_checkbox',
    ));
    $wp_customize->add_control( 'check_frances', array(
        'type' => 'checkbox',
        'section' => 'secao_traducao',
        'label' => __( 'Ativar Tradução para Francês' ),
    ));

    // Campo de URL personalizado
    $wp_customize->add_setting('url_frances', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('url_frances', array(
        'label' => 'URL do Site em Francês',
        'section' => 'secao_traducao',
        'type' => 'url',
    ));

    $wp_customize->add_setting( 'check_alemao', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'ufpb_sanitize_checkbox',
    ));
    $wp_customize->add_control( 'check_alemao', array(
        'type' => 'checkbox',
        'section' => 'secao_traducao',
        'label' => __( 'Ativar Tradução para Alemão' ),
    ));

    // Campo de URL personalizado
    $wp_customize->add_setting('url_alemao', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('url_alemao', array(
        'label' => 'URL do Site em Alemão',
        'section' => 'secao_traducao',
        'type' => 'url',
    ));

    $wp_customize->add_setting( 'check_italiano', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'ufpb_sanitize_checkbox',
    ));
    $wp_customize->add_control( 'check_italiano', array(
        'type' => 'checkbox',
        'section' => 'secao_traducao',
        'label' => __( 'Ativar Tradução para Italiano' ),
    ));

    // Campo de URL personalizado
    $wp_customize->add_setting('url_italiano', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('url_italiano', array(
        'label' => 'URL do Site em Italiano',
        'section' => 'secao_traducao',
        'type' => 'url',
    ));

    $wp_customize->add_setting( 'check_mandarim', array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'ufpb_sanitize_checkbox',
    ));
    $wp_customize->add_control( 'check_mandarim', array(
        'type' => 'checkbox',
        'section' => 'secao_traducao',
        'label' => __( 'Ativar Tradução para Mandarim' ),
    ));

    // Campo de URL personalizado
    $wp_customize->add_setting('url_mandarim', array(
        'sanitize_callback' => 'esc_url_raw', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('url_mandarim', array(
        'label' => 'URL do Site em Mandarim',
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
    if(!is_single() || is_singular(array('evento', 'edital', 'patente'))){
        // Obtém a URL da imagem do Customizer
        $imagem_banner_url_original = get_theme_mod('imagem_banner');
        $imagem_banner_url = str_replace('http://', 'https://', $imagem_banner_url_original);  //solução imbecil, ajeitar o SSL e forçar https de verdade é melhor

        echo '<div class="imagem banner-topo">';
    
        if (!empty($imagem_banner_url)) {
        echo '<img src="' . esc_attr(esc_url($imagem_banner_url)) . '" alt="Imagem decorativa do site">';
        } else {
            echo '<img src="' , get_bloginfo("template_directory") , '/decoration.jpg" alt="Imagem decorativa do site">';
        }   
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
    register_nav_menus(
        array(
            'footer-menu' => 'Mapa do Site',          
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
            <h2 class="menu-lateral-h2">Postagens Relacionadas</h2>
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

    $wp_customize->add_setting('custom_tiktok', array(   
        'sanitize_callback' => 'sanitize_text_field', // Limpa a entrada do usuário como uma URL
    ));
    $wp_customize->add_control('custom_tiktok', array(
        'input_attrs' => array(
            'placeholder' => __('Ex.: https://tiktok.com/@ufpboficial'),
        ),
        'label' => 'Link da página do TikTok',
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




// get top ancestor
// from https://www.youtube.com/watch?v=GHTZn3atTcM
function get_top_ancestor_id() {
    global $post;

    if ($post->post_parent) {
        $ancestors = get_post_ancestors($post->ID);
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
            $data_inicio_formatted = strtotime($_POST['data_inicio'] . ' 00:00-03:00');
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
            $data_fim_formatted = strtotime($_POST['data_fim'] . ' 00:00-03:00');
            $data_inicio_formatted = strtotime($_POST['data_inicio'] . ' 00:00-03:00');
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
			'has_archive' => 'eventos',
            'rewrite'     => array( 'slug' => 'evento' ), // my custom slug
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

//hook to add a meta box
add_action( 'add_meta_boxes', 'c3m_video_meta' );

function c3m_video_meta() {
    //create a custom meta box
    add_meta_box( 'c3m-meta', 'Destacar Edital', 'c3m_mbe_function', 'edital', 'side', 'high' );
}

function c3m_mbe_function( $post ) {

    //retrieve the meta data values if they exist
    $c3m_mbe_featured = get_post_meta( $post->ID, '_c3m_mbe_featured', true );

    ?>
    <p> 
    <select name="c3m_mbe_featured">
        <option value="no" <?php selected( $c3m_mbe_featured, 'no' ); ?>>Não Destacar</option>
        <option value="yes" <?php selected( $c3m_mbe_featured, 'yes' ); ?>>Destacar</option>
    </select>
    </p>
    <?php
}

//hook to save the meta box data
add_action( 'save_post', 'c3m_mbe_save_meta' );
function c3m_mbe_save_meta( $post_ID ) {
    global $post;
    if( $post->post_type == "edital" ) {
        if ( isset( $_POST ) ) {
            update_post_meta( $post_ID, '_c3m_mbe_featured', strip_tags( $_POST['c3m_mbe_featured'] ) );
        }
    }
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
			'has_archive' => 'editais',
            'rewrite'     => array( 'slug' => 'edital' ), // my custom slug
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
            //'taxonomies' => array('edital_type', 'edital'),
            'register_meta_box_cb' => 'c3m_video_meta', //This is for our custom meta box
            
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
                'rewrite' => array( 'slug' => 'editais' ), // my custom slug
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
            echo '<ul class="menu-lateral">';
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
            echo '<h2 class="menu-lateral-h2">Editais</h2>';
            echo '<ul class="menu-lateral">';
            foreach ($categorias as $categoria){
                echo '<li><a class="side-menu-button" href="' , esc_url(get_category_link($categoria->term_id)) , '">', esc_html($categoria->name) ,'</a></li>';
            }
            echo '</ul>';
        echo '</div>';
    }
}

function summon_categorias_patente_menu() {
    $categorias = get_terms(array(
        "taxonomy" => "patente_type",    
        "orderby"   => "name",
        "order"     => "ASC"
    )); 
    if (!empty($categorias)) {
        echo '<div class="side-menu-categorias">';
            echo '<h2 class="menu-lateral-h2">Categorias</h2>';
            echo '<ul class="menu-lateral">';
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

/**
 * Filter the excerpt length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
add_filter( 'excerpt_length', function( $length ) { return 15; }, 999 );

add_action( 'init', 'create_patentes');

function create_patentes() {
	register_post_type('patente',
		array(
			'labels'      => array(
				'name'              => __('Patentes', 'textdomain'),
				'singular_name'     => __('Patente', 'textdomain'),
                'add_new'           => _x('Adicionar nova', 'Patente'),
                'add_new_item'      => __('Adicionar nova patente'),
                'edit_item'         => __('Editar patente'),
                'new_item'          => __('Nova patente'),
                'view_item'         => __('Ver patente'),
                'search_items'      => __('Buscar patentes'),
                'not_found'         => __('Nenhuma patente encontrado'),
                'not_found_in_trash'=> __('Nenhuma patente encontrado na lixeira'),
                'parent_item_colon' => ''
			),
			'public'      => true,
			'has_archive' => 'patentes',
            'rewrite'     => array( 'slug' => 'patente' ), // my custom slug
            'menu_icon'   => 'dashicons-awards',
            'supports'    => array(
                'title',
                'editor',
                'custom-fields',
                'revisions',
                'excerpt',
                'thumbnail'
            ),
            'show_in_rest' => true, //permite editor gutenberg
            //'taxonomies' => array('edital_type', 'edital') //resquício do código de editais
            
		)
	);
    
    register_taxonomy(  
        'patente_type',  
        'patente',  // this is the custom post type(s) I want to use this taxonomy for
            array(  
                'hierarchical' => true,  
                'label' => 'Categoria da Patente',  
                'query_var' => true,  
                'rewrite' => true,
                'meta_box_cb' => true,
                'show_in_rest' =>true, 
                'rewrite' => array( 'slug' => 'patentes' ), // my custom slug
            ),
        
        );  
    
}

function edital_fixados( \WP_Query $query ) {
    if ( is_admin() ) {
        return; // we want the frontend! exit if it's WP Admin
    }
    if ( !$query->is_main_query() ) {
        return; // we want the main query!
    }
    if ( ! is_post_type_archive( 'edital' ) ) {
        return; // we only want the movie archives
    }

    /*$meta_query = array(
            array(
                'key' => '_c3m_mbe_featured',
                'value' => 'yes',
                'compare' => 'NOT LIKE'
                ));*/
    
    //$query->set( 'meta_query', $meta_query);
    $query->set( 'meta_key', '_c3m_mbe_featured');
    //$query->set( 'value', 'yes');
    //$query->set( 'compare', 'NOT LIKE');   
    
    $query->set( 'orderby', [         
        'meta_value' => 'DESC',
        'date'  => 'DESC' 
    ] );

}

add_action( 'pre_get_posts', 'edital_fixados', 1 );


/*
*Pega apenas eventos passados ou futuros
*Fonte: https://wordpress.stackexchange.com/questions/121352/help-splitting-a-custom-post-type-archive-into-past-and-upcoming
*/
function evento_post_order( $query ){
    // if this is not an admin screen,
    // and is the event post type archive
    // and is the main query
    if( ! is_admin()
        && $query->is_post_type_archive( 'evento' )
        && $query->is_main_query() ){

        // if this is a past events view
        // set compare to before today,
        // otherwise set to today or later
        $compare = isset( $query->query_vars['is_past'] ) ? '<' : '>=';
        $order = isset( $query->query_vars['is_past'] ) ? 'DESC' : 'ASC';

        // add the meta query and use the $compare var
        //$today = date( 'Y-m-d' );
        $meta_query = array(
            array(
                'key' => '__data_fim',  // usa a data de fim do evento
                'value' => current_time('timestamp') - 86400, //- 3 * 3600,
                'compare' => $compare,       // pra comprar com a data atual.                 
            ) 
        ); 
        $query->set( 'meta_query', $meta_query );
        $query->set( 'meta_key', '__data_inicio' );
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'order', $order );
    }
}
add_action( 'pre_get_posts', 'evento_post_order' );

function evento_archive_rewrites(){
    add_rewrite_tag( '%is_past%','([^&]+)' );
    add_rewrite_rule(
        'eventos/passados/([0-9]+)/?$',
        'index.php?post_type=evento&paged=$matches[1]&is_past=true',
        'top'
    );
    add_rewrite_rule(
        'eventos/passados/?$',
        'index.php?post_type=evento&is_past=true',
        'top'
    );
}
add_action( 'init', 'evento_archive_rewrites' );


?>