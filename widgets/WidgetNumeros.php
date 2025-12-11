<?php

// Registrar Widget de UFPB em números
function registrar_widget_numeros() {
    register_widget('WidgetNumeros');
}
add_action('widgets_init', 'registrar_widget_numeros');

class WidgetNumeros extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Numeros',
            'UFPB em Números',
            array(
                'description' => 'Estatísticas sobre a UFPB'
            )
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        ?>

        <div class="width-wrapper large-spacer">
        <div class="linha-header-longa">
            <h2 class="linha-header">UFPB em Números</h2>
            <div class="widget-numeros-comunidade linha-acima linha-abaixo">
                <div class="total">
                    <div><i class="fa-solid fa-people-group"></i><div>44.992</div></div>
                    <div>Pessoas formam a comunidade da UFPB</div>
                </div>
                <div class="discentes">
                    <div class="estatistica-single"><i class="fa-solid fa-user-graduate"></i><div>38.005</div></div>
                    <div class="titulo-single">Discentes</div>                    
                </div>
                <div class="servidores">
                    <div class="estatistica-single"><i class="fa-solid fa-user-tie"></i><div>6.033</div></div>
                    <div class="titulo-single">Servidores</div>
                </div>
                <div class="terceirizados">
                    <div class="estatistica-single"><i class="fa-solid fa-user-plus"></i><div>954</div></div>
                    <div class="titulo-single">Terceirizados</div>
                </div>
            </div>
            <div class="widget-numeros">
                
                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>4</div>
                    </div>                        
                    <div class="numero-titulo" style="font-style: italic;">Campi</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-building-columns"></i>
                        <div>17</div>
                    </div>                        
                    <div class="numero-titulo" >Centros de Ensino</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-school-flag"></i>
                        <div>1</div>
                    </div>                        
                    <div class="numero-titulo" >Escola de Ensino Médio e Profissionalizante</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <div>1</div>
                    </div>                        
                    <div class="numero-titulo" >Colégio de Aplicação</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-book"></i>
                        <div>24</div>
                    </div>                        
                    <div class="numero-titulo" >Bibliotecas</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-utensils"></i>
                        <div>5</div>
                    </div>                        
                    <div class="numero-titulo" >Restaurantes Universitários</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-house-user"></i>
                        <div>21</div>
                    </div>                        
                    <div class="numero-titulo" >Residências Estudantis</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-book-bookmark"></i>
                        <div>1</div>
                    </div>                        
                    <div class="numero-titulo" >Editora Universitária</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-shop"></i>
                        <div>1</div>
                    </div>                        
                    <div class="numero-titulo" >Livraria</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-hospital"></i>
                        <div>2</div>
                    </div>                        
                    <div class="numero-titulo" >Hospitais Universitários</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-landmark"></i>
                        <div>12</div>
                    </div>                        
                    <div class="numero-titulo" >Museus</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-masks-theater"></i>
                        <div>2</div>
                    </div>                        
                    <div class="numero-titulo" >Teatros</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-film"></i>
                        <div>1</div>
                    </div>                        
                    <div class="numero-titulo" >Sala de Cinema</div>
                </div>

                <div class="item linha-abaixo linha-acima">
                    <div class="destaque">
                        <i class="fa-solid fa-house-flag"></i>
                        <div>1</div>
                    </div>                        
                    <div class="numero-titulo" >Casa de Cultura</div>
                </div>

                <a href="https://sigov.ufpb.br/" target="_blank" rel="noopener noreferrer" class="item mais-dados">
                    <div class="destaque">
                        <i class="fa-solid fa-plus"></i>
                        <div>Dados</div>
                    </div>                        
                    <div class="numero-titulo" >Portal do SIGov</div>
                </a>
                           
                
                
            </div>
        </div>

        </div>


        <?php
        echo $args['after_widget']; 
    }

    public function form($instance) {           
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;            
        return $instance;
    }
}

?>