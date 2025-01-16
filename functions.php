<?php
date_default_timezone_set('America/Recife');

add_theme_support( 'post-thumbnails' );

add_theme_support('editor-styles');
add_editor_style( 'editor-style.css' );

// Adding excerpt for page
add_post_type_support( 'page', 'excerpt' );

//Cor personalizada
function meu_tema_personalizado($wp_customize) {

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

//registrar menus
function register_menus() { 
    register_nav_menus(
        array(
            'main-menu' => 'Menu Principal',
            'side-menu' => 'Menu lateral presente em todas as subpágias',            
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
        'posts_per_page'  => '2',
     );

    $related_cats_post = new WP_Query( $query_args );

    if($related_cats_post->have_posts()){
        echo '<h2 id="outras-n">Notícias Relacionadas</h2>
        <div class="noticias-relacionadas">';
        while($related_cats_post->have_posts()){
            $related_cats_post->the_post();
            echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper camada-1">';
            if (has_post_thumbnail()) {
                echo '<div class="noticia-img2-wrapper"><img class="noticia-img2" src="', esc_url(the_post_thumbnail_url()), '"></div>';
            }
            echo '<div class="noticia-sem-img">'; 
                echo '<div class="rotulo-escuro">';                                                               
                echo '
                <div>' . get_the_date( 'j \d\e F \d\e Y' ) . '</div>';
                /*echo '<div class="categorias">';
                    $categories = get_the_category();
                    
                    if ($categories) {
                        $categories = array_slice($categories, 0, 2);
                        foreach ($categories as $category) {                                                    
                            echo '<div>' , esc_html($category->name) , '</div>';
                            if (next($categories)) {
                                echo ', ';
                            }
                        }
                    }
                echo '    
                    </div>';<!-- fecha div categorias -->*/
                echo '</div><!-- fecha div rotulo -->';
                echo '<div class="noticia-titulo">' , esc_html(the_title()) , '</div>';                                    
        
                echo '</div>'; //noticia-com/sem-img
            echo '</a>'; //noticia-wrapper 
        }
    }
        // Restore original Post Data
        wp_reset_postdata();
        ?> 
        </div> <!-- fecha div noticias-relacionadas -->
        <?php

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

// Registrar Widget de Destaque solo
function registrar_widget_noticias_antiga() {
    register_widget('WidgetNoticiasAntiga');
}
add_action('widgets_init', 'registrar_widget_noticias_antiga');

class WidgetNoticiasAntiga extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Noticias_Antiga',
            '[Antigo] Widget de Notícias',
            array(
                'description' => 'Exibe as 3 últimas notícias (estilo antigo, não usar)'
            )
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo '
        <div class="noticias-wrapper">
            <div class="noticias">
                <h2>Notícias</h2>
                <div class="conteudo">';
                    $posts_per_page = 3;
                    $the_query = new WP_Query( array(
                        'posts_per_page' => $posts_per_page
                    ));
                    if ( $the_query->have_posts() ) {
                        $postCount = 0;
                        while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                            $postCount++;
                            $the_query->the_post();

                            if ($postCount == 1) {
                                echo '<div class="noticia-wrapper camada-1 noticia-primeira">';
                            } else {
                                echo '<div class="noticia-wrapper camada-1">';                                 
                            }
                                if (has_post_thumbnail()) {
                                    echo '<div class="rotulo-claro">';
                                } else {
                                    echo '<div class="rotulo-escuro">';
                                }                                
                                    echo '
                                    <div>' . get_the_date( 'j \d\e F Y' ) . '</div>
                                    <div class="categorias">';
                                        $categories = get_the_category();
                                        
                                        if ($categories) {
                                            $categories = array_slice($categories, 0, 2);
                                            foreach ($categories as $category) {                                                    
                                                echo '<a href="' , esc_url(get_category_link($category->term_id)) , '">' , esc_html($category->name) , '</a>';
                                                if (next($categories)) {
                                                    echo ', ';
                                                }
                                            }
                                        }
                                echo '    
                                    </div><!-- fecha div categorias -->
                                </div><!-- fecha div rotulo -->';
                            
                                if ( has_post_thumbnail()) {                                    
                                    echo '<img class="noticia-img" src="', esc_url(the_post_thumbnail_url()), '">';
                                    echo '<a class="noticia-com-img" href="' , esc_url(the_permalink()) , '">';
                                } else {
                                    echo '<a class="noticia-sem-img" href="' , esc_url(the_permalink()) , '">'; 
                                }                                    

                                    echo '<div class="noticia-titulo">' , esc_html(the_title()) , '</div>';
                                    
                                
                                echo '</a>'; //noticia-com/sem-img
                            echo '</div>'; //noticia-wrapper
                        }
                    } 
        //wrapper do que é dinâmico
        echo
        '       </div>
                <div class="link-wrapper justify-end">
                <a class="mais-link" href="', get_home_url(), '/noticias/">Mais Notícias</a>           
                </div>
            </div>
        </div>';
        echo $args['after_widget']; 
    }
}
// Widget de eventos
function registrar_widget_eventos() {
    register_widget('WidgetEventos');
}
add_action('widgets_init', 'registrar_widget_eventos');

class WidgetEventos extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Eventos',
            'Widget de Eventos',
            array(
                'description' => 'Exibe até 3 dos próximos eventos mais próximos que acontecerão. Widget fica invisível se não existe nenhum evento vindo aí'
            )
        );
    }

    public function widget($args, $instance) {

        $posts_per_page = 3;
        $the_query = new WP_Query( array(
            'posts_per_page' => $posts_per_page,
            'post_type' => 'evento',
            'meta_key' => '__data_inicio',  // Pega a metakey de data
            'orderby' => 'meta_value',      // e organiza a query
            'order' => 'ASC',               // em ordem do mais velho pro mais novo
            'meta_query' => array(
                array(
                    'key' => '__data_fim',  // usa a data de fim do evento
                    'value' => current_time('timestamp') - 86400, // - 3 * 3600,
                    'compare' => '>='       // pra comprar com a data atual. 
                )                           // (eventos que já acabaram não são exibidos)
            )
        ));

        echo $args['before_widget'];
        
        if ($the_query->have_posts()){  
            echo '
            <div class="noticias-wrapper">
                <div class="eventos">
                    <h2>Eventos</h2>';
                    if ($the_query->post_count == 1) {
                        // classe com 1 coluna especial
                        // data, nome, excerpt
                        echo '<div class="conteudo2-eventos-solo">';
                        $postCount = 0;
                        while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                            $postCount++;
                            $the_query->the_post();
                                   
                                echo '<a href="' , esc_url(the_permalink()) , '" class="evento-wrapper-solo camada-1">';
                                if (has_post_thumbnail()) {
                                    echo '<div class="evento-img2-wrapper"><img class="noticia-img2" src="', esc_url(the_post_thumbnail_url()), '"></div>';
                                }
                                                            
                            $data_inicio = get_post_meta( get_the_ID(), '__data_inicio', true );
                            $data_fim = get_post_meta( get_the_ID(), '__data_fim', true );     

                            echo '<div class="evento-sem-img">'; 
                                echo '<div class="rotulo-evento">';                                                               
                                echo '<div>';
                                
                                if (empty($data_fim) || $data_inicio == $data_fim) {
                                    echo wp_date('j \d\e F \d\e Y', $data_inicio), '</div>';
                                } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                                    echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                                } else {
                                    echo wp_date('j \d\e F', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                                }
                                
                                echo '
                                
                                </div><!-- fecha div rotulo -->';
                                echo '<h2>' , esc_html(the_title()) , '</h2>';
                                echo  esc_html(the_excerpt());                                     
                                
                                echo '</div>'; //noticia-com/sem-img
                            echo '</a>'; //noticia-wrapper                            
                        }
                    } else {
                    if ($the_query->post_count == 2) {
                        // classe com 3 colunas
                        echo '<div class="conteudo2-eventos-dupla">';
                    } else if ($the_query->post_count == 3) {
                        // classe com 2 colunas
                        echo '<div class="conteudo2-eventos-trio">';
                    } 
                        
                        $postCount = 0;
                        while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                            $postCount++;
                            $the_query->the_post();

                            if ($postCount < 4) {                                    
                                echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper camada-1">';
                                if (has_post_thumbnail()) {
                                    echo '<div class="evento-img2-wrapper"><img class="noticia-img2" src="', esc_url(the_post_thumbnail_url()), '"></div>';
                                }
                                                            
                            $data_inicio = get_post_meta( get_the_ID(), '__data_inicio', true );
                            $data_fim = get_post_meta( get_the_ID(), '__data_fim', true );     

                            echo '<div class="evento-sem-img">'; 
                                echo '<div class="rotulo-evento">';                                                               
                                echo '<div>';
                                
                                if (empty($data_fim) || $data_inicio == $data_fim) {
                                    echo wp_date('j \d\e F \d\e Y', $data_inicio), '</div>';
                                } else if (wp_date('F', $data_inicio) == wp_date('F', $data_fim)) {
                                    echo wp_date('j', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                                } else {
                                    echo wp_date('j \d\e F', $data_inicio), '–', wp_date('j \d\e F \d\e Y', $data_fim), '</div>';
                                }
                                
                                echo '
                                
                                </div><!-- fecha div rotulo -->';
                                echo '<div class="noticia-titulo">' , esc_html(the_title()) , '</div>';                                    
                                
                                echo '</div>'; //noticia-com/sem-img
                            echo '</a>'; //noticia-wrapper
                            }
                        }  
                    }          
            echo
            '       
                    
            </div>
            <div class="link-wrapper justify-end">
            <a class="mais-link" href="', get_home_url(), '/eventos/">Todos os Eventos</a>           
            </div>
            </div>
            </div>';
        
        }
        echo $args['after_widget']; 
    }
}

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
                'description' => 'Exibe as 5 últimas notícias, sendo 2 em formato grande e 3 pequenas (apenas manchete)'
            )
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo '
        <div class="noticias-wrapper">
            <div class="noticias">
                <h2>Notícias</h2>
                <div class="conteudo2">';
                    $posts_per_page = 5;
                    $the_query = new WP_Query( array(
                        'posts_per_page' => $posts_per_page
                    ));
                    if ( $the_query->have_posts() ) {
                        $postCount = 0;
                        while ( $the_query->have_posts() && $postCount < $posts_per_page ){
                            $postCount++;
                            $the_query->the_post();

                            if ($postCount < 3) {
                                if ($postCount == 1){
                                    echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper camada-1 noticia-primeira">';
                                } else {
                                    echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper camada-1 noticia-segunda">';
                                }
                                if (has_post_thumbnail()) {
                                    echo '<div class="noticia-img2-wrapper"><img class="noticia-img2" src="', esc_url(the_post_thumbnail_url()), '"></div>';
                                }
                            } else {
                                echo '<a href="' , esc_url(the_permalink()) , '" class="noticia-wrapper camada-1">';                                 
                            } 
                                                                    
                                    echo '<div class="noticia-sem-img">'; 
                                        echo '<div class="rotulo-escuro">';                                                               
                                        echo '
                                        <div>' . get_the_date( 'j \d\e F \d\e Y' ) . '</div>';
                                        /*echo '<div class="categorias">';
                                            $categories = get_the_category();
                                            
                                            if ($categories) {
                                                $categories = array_slice($categories, 0, 2);
                                                foreach ($categories as $category) {                                                    
                                                    echo '<div>' , esc_html($category->name) , '</div>';
                                                    if (next($categories)) {
                                                        echo ', ';
                                                    }
                                                }
                                            }
                                        echo '    
                                            </div>';<!-- fecha div categorias -->*/
                                        echo '</div><!-- fecha div rotulo -->';
                                        echo '<div class="noticia-titulo">' , esc_html(the_title()) , '</div>';                                    
                                
                                echo '</div>'; //noticia-com/sem-img
                            echo '</a>'; //noticia-wrapper
                        }
                    }

        
        echo
        '       
                <div class="link-wrapper justify-end">
                <a class="mais-link" href="', get_home_url(), '/noticias/">Mais Notícias</a>           
                </div>
                </div>
            </div>
        </div>';
        echo $args['after_widget']; 
    }
}


// Registrar Widget de Destaque solo
function registrar_widget_destaque_solo_invertido() {
    register_widget('WidgetDestaqueSoloInvertido');
}
add_action('widgets_init', 'registrar_widget_destaque_solo_invertido');

class WidgetDestaqueSoloInvertido extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Destaque_Solo_Invertido',
            'Widget de Destaque Único Invertido',
            array(
                'description' => 'Destaca uma página do site de forma belíssima, só que a imagem vem primeiro.'
            )
        );
    }

    public function widget($args, $instance) {
        // Extrair os valores dos campos do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link));    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';
        $img_link = !empty($instance['img_link']) ? $instance['img_link'] : get_the_post_thumbnail_url(url_to_postid($pagina_link));

        echo $args['before_widget'];
        echo '
        <div class="destaque-wrapper destaque-solo invertido">  
            <div class="camada-1">
                <h2>' . $titulo . '</h2>
                <p>' . $resumo . '</p>
                <div class="link-wrapper">
                    <a class="mais-link" href=' . $pagina_link . '>' . $link_texto . '</a>           
                </div>
            </div>
            <div class="destaque-solo-img invertido">
                <img src="' . $img_link . '" alt="Imagem da página">
            </div>                
        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link) );    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';   
        $img_link = !empty($instance['img_link']) ? $instance['img_link'] : get_the_post_thumbnail_url(url_to_postid($pagina_link));     

        // Formulário de configuração do widget
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Link da página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link'); ?>" name="<?php echo $this->get_field_name('pagina_link'); ?>" type="text" value="<?php echo $pagina_link; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Texto do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo'); ?>" name="<?php echo $this->get_field_name('resumo'); ?>" type="text" value="<?php echo $resumo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto'); ?>" name="<?php echo $this->get_field_name('link_texto'); ?>" type="text" value="<?php echo $link_texto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('img_link'); ?>">Link da imagem personalizada do destaque:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_link'); ?>" name="<?php echo $this->get_field_name('img_link'); ?>" type="text" value="<?php echo $img_link; ?>">
        </p>
        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['pagina_link'] = !empty($new_instance['pagina_link']) ? esc_html($new_instance['pagina_link']) : ''; 
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : ''; 
        $instance['resumo'] = !empty($new_instance['resumo']) ? esc_html($new_instance['resumo']) : ''; 
        $instance['link_texto'] = !empty($new_instance['link_texto']) ? esc_html($new_instance['link_texto']) : ''; 
        $instance['img_link'] = !empty($new_instance['img_link']) ? esc_html($new_instance['img_link']) : '';
        return $instance;
    }
}

// Registrar Widget de Destaque solo
function registrar_widget_destaque_solo() {
    register_widget('WidgetDestaqueSolo');
}
add_action('widgets_init', 'registrar_widget_destaque_solo');

class WidgetDestaqueSolo extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Destaque_Solo',
            'Widget de Destaque Único',
            array(
                'description' => 'Destaca uma página do site de forma belíssima.'
            )
        );
    }

    public function widget($args, $instance) {
        // Extrair os valores dos campos do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link));    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';
        $img_link = !empty($instance['img_link']) ? $instance['img_link'] : get_the_post_thumbnail_url(url_to_postid($pagina_link));

        echo $args['before_widget'];

        echo '
        <div class="destaque-wrapper destaque-solo">  
            <div class="camada-1">
                <h2>' . $titulo . '</h2>
                <p>' . $resumo . '</p>
                <div class="link-wrapper">
                    <a class="mais-link" href=' . $pagina_link . '>' . $link_texto . '</a>           
                </div>
            </div>
            <div class="destaque-solo-img">
                <img src="' . $img_link . '" alt="Imagem da página">
            </div>                
        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link) );    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';   
        $img_link = !empty($instance['img_link']) ? $instance['img_link'] : '';     

        // Formulário de configuração do widget
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Link da página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link'); ?>" name="<?php echo $this->get_field_name('pagina_link'); ?>" type="text" value="<?php echo $pagina_link; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Texto do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo'); ?>" name="<?php echo $this->get_field_name('resumo'); ?>" type="text" value="<?php echo $resumo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto'); ?>" name="<?php echo $this->get_field_name('link_texto'); ?>" type="text" value="<?php echo $link_texto; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('img_link'); ?>">Link da imagem personalizada do destaque:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('img_link'); ?>" name="<?php echo $this->get_field_name('img_link'); ?>" type="text" value="<?php echo $img_link; ?>">
        </p>
        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['pagina_link'] = !empty($new_instance['pagina_link']) ? esc_html($new_instance['pagina_link']) : ''; 
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : ''; 
        $instance['resumo'] = !empty($new_instance['resumo']) ? esc_html($new_instance['resumo']) : ''; 
        $instance['link_texto'] = !empty($new_instance['link_texto']) ? esc_html($new_instance['link_texto']) : ''; 
        $instance['img_link'] = !empty($new_instance['img_link']) ? esc_html($new_instance['img_link']) : '';
        return $instance;
    }
}

// Registrar Widget de Destaque Duplo
function registrar_widget_destaque_duplo() {
    register_widget('WidgetDestaqueDuplo');
}
add_action('widgets_init', 'registrar_widget_destaque_duplo');

class WidgetDestaqueDuplo extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Destaque_Duplo',
            'Widget de destaque de duas páginas',
            array(
                'description' => 'Destaca duas páginas do site de forma belíssima.'
            )
        );
    }

    public function widget($args, $instance) {
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link));    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';

        $pagina_link_2 = $instance['pagina_link_2'];
        $titulo_2 = !empty($instance['titulo_2']) ? $instance['titulo_2'] : get_the_title(url_to_postid($pagina_link_2));
        $resumo_2 = !empty($instance['resumo_2']) ? $instance['resumo_2'] : get_the_excerpt(url_to_postid($pagina_link_2));    
        $link_texto_2 = !empty($instance['link_texto_2']) ? $instance['link_texto_2'] : 'Saiba mais';

        echo $args['before_widget'];

        echo '
        <div class="destaque-wrapper destaque-dupla">  

            <div class="destaque">
                <div><img src="' . get_the_post_thumbnail_url(url_to_postid($pagina_link)) . '" alt="Imagem da página"></div>
                <div class="camada-1">
                    <h2>' . $titulo . '</h2>
                    <p>' . $resumo . '</p>
                    <div class="link-wrapper">
                        <a class="mais-link" href=' . $pagina_link . '>' . $link_texto . '</a>           
                    </div>
                </div>
            </div>

            <div class="destaque">
                <div><img src="' . get_the_post_thumbnail_url(url_to_postid($pagina_link_2)) . '" alt="Imagem da página"></div>
                <div class="camada-1">
                    <h2>' . $titulo_2 . '</h2>
                    <p>' . $resumo_2 . '</p>
                    <div class="link-wrapper">
                        <a class="mais-link" href=' . $pagina_link_2 . '>' . $link_texto_2 . '</a>           
                    </div>
                </div>
            </div>   

        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link) );    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';  
        
        $pagina_link_2 = $instance['pagina_link_2'];
        $titulo_2 = !empty($instance['titulo_2']) ? $instance['titulo_2'] : get_the_title(url_to_postid($pagina_link_2));
        $resumo_2 = !empty($instance['resumo_2']) ? $instance['resumo_2'] : get_the_excerpt(url_to_postid($pagina_link_2));    
        $link_texto_2 = !empty($instance['link_texto_2']) ? $instance['link_texto_2'] : 'Saiba mais';

        // Formulário de configuração do widget
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Link da primeira página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link'); ?>" name="<?php echo $this->get_field_name('pagina_link'); ?>" type="text" value="<?php echo $pagina_link; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Texto do primeiro bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo'); ?>" name="<?php echo $this->get_field_name('resumo'); ?>" type="text" value="<?php echo $resumo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto'); ?>">Texto do primeiro link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto'); ?>" name="<?php echo $this->get_field_name('link_texto'); ?>" type="text" value="<?php echo $link_texto; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link_2'); ?>">Link da segunda página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link_2'); ?>" name="<?php echo $this->get_field_name('pagina_link_2'); ?>" type="text" value="<?php echo $pagina_link_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo_2'); ?>">Título do segundo bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo_2'); ?>" name="<?php echo $this->get_field_name('titulo_2'); ?>" type="text" value="<?php echo $titulo_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('resumo_2'); ?>">Texto do segundo bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo_2'); ?>" name="<?php echo $this->get_field_name('resumo_2'); ?>" type="text" value="<?php echo $resumo_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto_2'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto_2'); ?>" name="<?php echo $this->get_field_name('link_texto_2'); ?>" type="text" value="<?php echo $link_texto_2; ?>">
        </p>
        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['pagina_link'] = !empty($new_instance['pagina_link']) ? esc_html($new_instance['pagina_link']) : ''; 
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : ''; 
        $instance['resumo'] = !empty($new_instance['resumo']) ? esc_html($new_instance['resumo']) : ''; 
        $instance['link_texto'] = !empty($new_instance['link_texto']) ? esc_html($new_instance['link_texto']) : ''; 
        $instance['pagina_link_2'] = !empty($new_instance['pagina_link_2']) ? esc_html($new_instance['pagina_link_2']) : ''; 
        $instance['titulo_2'] = !empty($new_instance['titulo_2']) ? esc_html($new_instance['titulo_2']) : ''; 
        $instance['resumo_2'] = !empty($new_instance['resumo_2']) ? esc_html($new_instance['resumo_2']) : ''; 
        $instance['link_texto_2'] = !empty($new_instance['link_texto_2']) ? esc_html($new_instance['link_texto_2']) : ''; 
        return $instance;
    }
}

// Registrar Widget de Destaque Triplo
function registrar_widget_destaque_triplo() {
    register_widget('WidgetDestaqueTriplo');
}
add_action('widgets_init', 'registrar_widget_destaque_triplo');

class WidgetDestaqueTriplo extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Destaque_Triplo',
            'Widget de destaque de três páginas',
            array(
                'description' => 'Destaca três páginas do site de forma belíssima.'
            )
        );
    }

    public function widget($args, $instance) {
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link));    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';

        $pagina_link_2 = $instance['pagina_link_2'];
        $titulo_2 = !empty($instance['titulo_2']) ? $instance['titulo_2'] : get_the_title(url_to_postid($pagina_link_2));
        $resumo_2 = !empty($instance['resumo_2']) ? $instance['resumo_2'] : get_the_excerpt(url_to_postid($pagina_link_2));    
        $link_texto_2 = !empty($instance['link_texto_2']) ? $instance['link_texto_2'] : 'Saiba mais';

        $pagina_link_3 = $instance['pagina_link_3'];
        $titulo_3 = !empty($instance['titulo_3']) ? $instance['titulo_3'] : get_the_title(url_to_postid($pagina_link_3));
        $resumo_3 = !empty($instance['resumo_3']) ? $instance['resumo_3'] : get_the_excerpt(url_to_postid($pagina_link_3));    
        $link_texto_3 = !empty($instance['link_texto_3']) ? $instance['link_texto_3'] : 'Saiba mais';

        echo $args['before_widget'];

        echo '
        <div class="destaque-wrapper destaque-trio">  

            <div class="destaque">
                <div><img src="' . get_the_post_thumbnail_url(url_to_postid($pagina_link)) . '" alt="Imagem da página"></div>
                <div class="camada-1">
                    <h2>' . $titulo . '</h2>
                    <p>' . $resumo . '</p>
                    <div class="link-wrapper">
                        <a class="mais-link" href=' . $pagina_link . '>' . $link_texto . '</a>           
                    </div>
                </div>
            </div>

            <div class="destaque">
                <div><img src="' . get_the_post_thumbnail_url(url_to_postid($pagina_link_2)) . '" alt="Imagem da página"></div>
                <div class="camada-1">
                    <h2>' . $titulo_2 . '</h2>
                    <p>' . $resumo_2 . '</p>
                    <div class="link-wrapper">
                        <a class="mais-link" href=' . $pagina_link_2 . '>' . $link_texto_2 . '</a>           
                    </div>
                </div>
            </div>   

            <div class="destaque">
                <div><img src="' . get_the_post_thumbnail_url(url_to_postid($pagina_link_3)) . '" alt="Imagem da página"></div>
                <div class="camada-1">
                    <h2>' . $titulo_3 . '</h2>
                    <p>' . $resumo_3 . '</p>
                    <div class="link-wrapper">
                        <a class="mais-link" href=' . $pagina_link_3 . '>' . $link_texto_3 . '</a>           
                    </div>
                </div>
            </div>

        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $pagina_link = $instance['pagina_link'];
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : get_the_title(url_to_postid($pagina_link));
        $resumo = !empty($instance['resumo']) ? $instance['resumo'] : get_the_excerpt(url_to_postid($pagina_link) );    
        $link_texto = !empty($instance['link_texto']) ? $instance['link_texto'] : 'Saiba mais';  
        
        $pagina_link_2 = $instance['pagina_link_2'];
        $titulo_2 = !empty($instance['titulo_2']) ? $instance['titulo_2'] : get_the_title(url_to_postid($pagina_link_2));
        $resumo_2 = !empty($instance['resumo_2']) ? $instance['resumo_2'] : get_the_excerpt(url_to_postid($pagina_link_2));    
        $link_texto_2 = !empty($instance['link_texto_2']) ? $instance['link_texto_2'] : 'Saiba mais';

        $pagina_link_3 = $instance['pagina_link_3'];
        $titulo_3 = !empty($instance['titulo_3']) ? $instance['titulo_3'] : get_the_title(url_to_postid($pagina_link_3));
        $resumo_3 = !empty($instance['resumo_3']) ? $instance['resumo_3'] : get_the_excerpt(url_to_postid($pagina_link_3));    
        $link_texto_3 = !empty($instance['link_texto_3']) ? $instance['link_texto_3'] : 'Saiba mais';

        // Formulário de configuração do widget
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link'); ?>">Link da primeira página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link'); ?>" name="<?php echo $this->get_field_name('pagina_link'); ?>" type="text" value="<?php echo $pagina_link; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título do bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('resumo'); ?>">Texto do primeiro bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo'); ?>" name="<?php echo $this->get_field_name('resumo'); ?>" type="text" value="<?php echo $resumo; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto'); ?>">Texto do primeiro link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto'); ?>" name="<?php echo $this->get_field_name('link_texto'); ?>" type="text" value="<?php echo $link_texto; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link_2'); ?>">Link da segunda página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link_2'); ?>" name="<?php echo $this->get_field_name('pagina_link_2'); ?>" type="text" value="<?php echo $pagina_link_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo_2'); ?>">Título do segundo bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo_2'); ?>" name="<?php echo $this->get_field_name('titulo_2'); ?>" type="text" value="<?php echo $titulo_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('resumo_2'); ?>">Texto do segundo bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo_2'); ?>" name="<?php echo $this->get_field_name('resumo_2'); ?>" type="text" value="<?php echo $resumo_2; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto_2'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto_2'); ?>" name="<?php echo $this->get_field_name('link_texto_2'); ?>" type="text" value="<?php echo $link_texto_2; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pagina_link_3'); ?>">Link da terceira página a ser destacada:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('pagina_link_3'); ?>" name="<?php echo $this->get_field_name('pagina_link_3'); ?>" type="text" value="<?php echo $pagina_link_3; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('titulo_3'); ?>">Título do terceiro bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo_3'); ?>" name="<?php echo $this->get_field_name('titulo_3'); ?>" type="text" value="<?php echo $titulo_3; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('resumo_3'); ?>">Texto do terceiro bloco de destaque (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('resumo_3'); ?>" name="<?php echo $this->get_field_name('resumo_3'); ?>" type="text" value="<?php echo $resumo_3; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('link_texto_3'); ?>">Texto do link (opcional):</label>
            <input class="widefat" id="<?php echo $this->get_field_id('link_texto_3'); ?>" name="<?php echo $this->get_field_name('link_texto_3'); ?>" type="text" value="<?php echo $link_texto_3; ?>">
        </p>
        
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['pagina_link'] = !empty($new_instance['pagina_link']) ? esc_html($new_instance['pagina_link']) : ''; 
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : ''; 
        $instance['resumo'] = !empty($new_instance['resumo']) ? esc_html($new_instance['resumo']) : ''; 
        $instance['link_texto'] = !empty($new_instance['link_texto']) ? esc_html($new_instance['link_texto']) : ''; 
        $instance['pagina_link_2'] = !empty($new_instance['pagina_link_2']) ? esc_html($new_instance['pagina_link_2']) : ''; 
        $instance['titulo_2'] = !empty($new_instance['titulo_2']) ? esc_html($new_instance['titulo_2']) : ''; 
        $instance['resumo_2'] = !empty($new_instance['resumo_2']) ? esc_html($new_instance['resumo_2']) : ''; 
        $instance['link_texto_2'] = !empty($new_instance['link_texto_2']) ? esc_html($new_instance['link_texto_2']) : ''; 
        $instance['pagina_link_3'] = !empty($new_instance['pagina_link_3']) ? esc_html($new_instance['pagina_link_3']) : ''; 
        $instance['titulo_3'] = !empty($new_instance['titulo_3']) ? esc_html($new_instance['titulo_3']) : ''; 
        $instance['resumo_3'] = !empty($new_instance['resumo_3']) ? esc_html($new_instance['resumo_3']) : ''; 
        $instance['link_texto_3'] = !empty($new_instance['link_texto_3']) ? esc_html($new_instance['link_texto_3']) : ''; 
        return $instance;
    }
}

// Registrar o widget personalizado p/ home
function registrar_widget_apresentacao() {
    register_widget('Widget_Apresentacao');
}
add_action('widgets_init', 'registrar_widget_apresentacao');

// Criar a classe do widget personalizado
class Widget_Apresentacao extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'widget_apresentacao',
            'Widget de Apresentação com Vídeo',
            array(
                'description' => 'Um widget personalizado para apresentar a instituição, com título, vídeo, links, fotos e localização.'
            )
        );
    }

    // Função para exibir o widget no frontend
    public function widget($args, $instance) {
        echo $args['before_widget'];

        echo '
        <div class="apresentacao">
            <div class="camada-1">                 
                <h2>' . nl2br(esc_html($instance['titulo'])) . '</h2>
                <p>' . nl2br(esc_html($instance['texto-apresentacao'])) . '</p>
                <div class="apresentacao-links">';

                if (!empty($instance['link1']) && !empty($instance['link1_nome'])) {
                    echo
                    '<div class="link-wrapper">
                        <a class="mais-link" href="', $instance['link1'] ,'">', $instance['link1_nome'] ,'</a>           
                    </div>';
                }
                 if (!empty($instance['link2']) && !empty($instance['link2_nome'])) {
                    echo
                    '<div class="link-wrapper">
                        <a class="mais-link" href="', $instance['link2'] ,'">', $instance['link2_nome'] ,'</a>           
                    </div>';
                }
                 if (!empty($instance['link3']) && !empty($instance['link3_nome'])) {
                    echo
                    '<div class="link-wrapper">
                        <a class="mais-link" href="', $instance['link3'] ,'">', $instance['link3_nome'] ,'</a>           
                    </div>';
                }                

                echo '</div>
            </div>';

            if (!empty($instance['video-institucional'])) {
                $url = esc_url($instance['video-institucional']);
                $embed_url = str_replace("watch?v=", "embed/", $url);
                echo '<div class="youtube"><iframe width="100%" height="100%" src="' . $embed_url . '" title="Youtube Video Player" frameborder="0" allow="web-share" allowfullscreen></iframe></div>';
            } else if (!empty($instance['localizacao'])) {
                echo '<div class="youtube">' , $instance['localizacao'] , '</div>';
            } else if (!empty($instance['img_url'])) {
                echo '<div class="youtube"><img src="' , $instance['img_url'] , '"></div>';
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
        // Extrair os valores dos campos do widget
        $titulo = $instance['titulo'];
        
        $text_primeiro = $instance['text_primeiro'];
        $text_segundo = $instance['text_segundo'];
        $text_terceiro = $instance['text_terceiro'];
        $text_quarto = $instance['text_quarto'];
        $text_quinto = $instance['text_quinto'];
        $text_sexto = $instance['text_sexto'];

        $icon_primeiro = $instance['icon_primeiro'];
        $icon_segundo = $instance['icon_segundo'];
        $icon_terceiro = $instance['icon_terceiro'];
        $icon_quarto = $instance['icon_quarto'];
        $icon_quinto = $instance['icon_quinto'];
        $icon_sexto = $instance['icon_sexto'];
        
        $primeiro = $instance['primeiro'];
        $segundo = $instance['segundo'];
        $terceiro = $instance['terceiro'];
        $quarto = $instance['quarto'];
        $quinto = $instance['quinto'];
        $sexto = $instance['sexto'];

        echo $args['before_widget'];
        echo '
        <div class="links-wrapper">
            <h2> ' , esc_html($titulo) , ' </h2>
            <div class="links">

            <a href="' . esc_url($primeiro) . '" class="link-full camada-1">
                <div class="link-image-wrapper">              
                    <i class="' . esc_attr($icon_primeiro) . '"></i>              
                </div>          
                <div class="link-text" href="#">' . esc_html($text_primeiro) . '</div>
            </a>
            <a href="' . esc_url($segundo) . '" class="link-full camada-1">
                <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_segundo) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_segundo) . '</div>
            </a>
            <a href="' . esc_url($terceiro) . '" class="link-full camada-1">
                <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_terceiro) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_terceiro) . '</div>
            </a>
            <a href="' . esc_url($quarto) . '" class="link-full camada-1">
                <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_quarto) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_quarto) . '</div>
            </a>
            <a href="' . esc_url($quinto) . '" class="link-full camada-1">
                <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_quinto) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_quinto) . '</div>
            </a>
            <a href="' . esc_url($sexto) . '" class="link-full camada-1">
            <div class="link-image-wrapper">
                    <i class="' . esc_attr($icon_sexto) . '"></i>
                </div>          
                <div class="link-text" href="#">' . esc_html($text_sexto) . '</div>
            </a>';
        
        echo '
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


class WidgetMapaEFotos extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'widget_mapa',
            'Widget de Mapa e Foto',
            array(
                'description' => 'Widget com a localização e foto ilustrativa.'
            )
        );
    }

    public function widget($args, $instance) {
        // Extrair os valores dos campos do widget
        $titulo = !empty($instance['titulo']) ? $instance['titulo'] : 'Encontre-nos!';
        $mapa_iframe = !empty($instance['mapa_iframe']) ? $instance['mapa_iframe'] : '';
        $image_2 = !empty($instance['img_url']) ? $instance['img_url'] : '';         

        echo $args['before_widget'];
        echo '
        <div class="mapa">
        <div>
            <h2>' . esc_html($titulo) . '</h2>
            <div class="mapa-grid">                
                <div id="mapa-inlay">
                    ' . $mapa_iframe . '         
                </div>                
                
                <div id="foto2" class="foto">
                    <img src="' . esc_url($image_2) . '" alt="Imagem decorativa do site">
                    <!--img src="<?php echo get_bloginfo("template_directory"); ?>/img/foto2.png" alt=""-->
                </div>
            </div>
        </div>
        </div>';
        
        echo $args['after_widget']; 
    }

    public function form($instance) {
        // Exibir o formulário de configuração do widget
        $titulo = !empty($instance['titulo']) ? esc_html($instance['titulo']) : 'Encontre-nos!';
        $mapa_iframe = !empty($instance['mapa_iframe']) ? $instance['mapa_iframe'] : 'iframe_do_mapa';         
        $img_url = !empty($instance['img_url']) ? $instance['img_url'] : 'else_img_url';

        // Formulário de configuração do widget
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('titulo'); ?>">Título da seção:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo $titulo; ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('mapa_iframe'); ?>">Código de embed (iframe) do google maps, obtido através do compartilhar do maps:</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('mapa_iframe'); ?>" name="<?php echo $this->get_field_name('mapa_iframe'); ?>" type="html" value="<?php echo $mapa_iframe; ?>"></textarea>
        </p> 

        <p>
            <label for="<?php echo $this->get_field_id('img_url'); ?>">URL da imagem a ser exibida junto com o mapa:</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('img_url'); ?>" name="<?php echo $this->get_field_name('img_url'); ?>" type="text" value="<?php echo $img_url; ?>"></textarea>
        </p> 
        <?php
    }

    public function update($new_instance, $old_instance) {
        // Atualizar os valores do widget
        $instance = $old_instance;
        $instance['titulo'] = !empty($new_instance['titulo']) ? esc_html($new_instance['titulo']) : '';
        $instance['mapa_iframe'] = !empty($new_instance['mapa_iframe']) ? $new_instance['mapa_iframe'] : 'cagou-se';
        $instance['img_url'] = !empty($new_instance['img_url']) ? $new_instance['img_url'] : 'link da imagem';  
        return $instance;
    }
}

function registrar_widget_mapa() {
    register_widget('WidgetMapaEFotos');
}
add_action('widgets_init', 'registrar_widget_mapa');

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
            
		)
	);
}

function summon_side_menu() {
    wp_nav_menu(   
        array ( 
            'theme_location' => 'side-menu',
            'items_wrap' => '%3$s',
            'container' => false,
            'link_class'   => 'mais-link',
            'fallback_cb' => '__return_false',
            'items_wrap' => '<div><h2 class="menu-lateral-h2">Acesso Rápido</h2><ul class="menu-lateral">%3$s</ul></div>'
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
        echo '<div>';
        echo '<h2 class="menu-lateral-h2">Categorias</h2>';
        echo '<ul class="menu-lateral">';
        foreach ($categorias as $categoria){
            echo '<li><a class="mais-link" href="' , esc_url(get_category_link($categoria->term_id)) , '">', esc_html($categoria->name) ,'</a></li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}

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
        ));

        echo $args['before_widget'];

        if ($the_query->have_posts()) {
            echo '
            <div class="links-wrapper">
            <h2> ' , esc_html($titulo) , ' </h2>
            <div class="editais">';
            $postCount = 0;
            while ($the_query->have_posts() && $postCount < 4) {
                $postCount++;
                $the_query->the_post();
                echo '
                <a href="' , esc_url(the_permalink()) , '" class="edital-full camada-1">
                    <div class="link-image-wrapper">';    
                    if ($postCount == 1){
                        echo '<i class="fa-solid fa-file-circle-exclamation"></i>';
                    } else {
                        echo '<i class="fa-solid fa-file"></i>';
                    }         
                                      
                echo '</div>     
                    <div>
                        <div class="edital-data" href="#">' , esc_html(the_modified_date('j \d\e F \d\e Y')) , '</div>
                        <div class="edital-text" href="#">' , esc_html(the_title()) , '</div>
                    </div>                      
                </a>';
            }

            echo
        '       </div>
                <div class="link-wrapper justify-end">
                <a class="mais-link" href="', get_home_url(), '/editais/">Mais Editais</a>           
                </div>                
            </div>';
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