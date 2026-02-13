<?php

// Registrar Widget de UFPB em números
function registrar_widget_numeros_mulheres() {
    register_widget('WidgetNumerosMulheres');
}
add_action('widgets_init', 'registrar_widget_numeros_mulheres');

class WidgetNumerosMulheres extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Widget_Numeros_Mulheres',
            'Mulheres UFPB em Números',
            array(
                'description' => 'Estatísticas sobre a distribuição da comunidade universitária em gênero'
            )
        );
    }

    public function widget($args, $instance) {
        $str = file_get_contents('https://metabase.ufpb.br/public/question/9d819f7d-6b62-4af8-affd-d9b66cee7f17.json');
        $json = json_decode($str, true);
        //echo '<pre>' . print_r($json, true) . '</pre>';

        $graduacao_m = $json[0]['discentes'];
        $graduacao_h = $json[1]['discentes'];
        $graduacao_nd = $json[2]['discentes'];
        $graduacao_total = $graduacao_m + $graduacao_h + $graduacao_nd;
        $graduacao_m_percent = round(($graduacao_m / $graduacao_total) * 100) . '%';
        $graduacao_h_percent = round(($graduacao_h / $graduacao_total) * 100) . '%';

        $pos_m = $json[3]['discentes'] + $json[6]['discentes'];
        $pos_h = $json[4]['discentes'] + $json[7]['discentes'];
        $pos_nd = $json[5]['discentes'] + $json[8]['discentes'];
        $pos_total = $pos_m + $pos_h + $pos_nd;
        $pos_m_percent = round(($pos_m / $pos_total) * 100) . '%';
        $pos_h_percent = round(($pos_h / $pos_total) * 100) . '%';

        $residencia_m = $json[9]['discentes'];
        $residencia_h = $json[10]['discentes'];
        $residencia_nd = 0;
        $residencia_total = $residencia_m + $residencia_h + $residencia_nd;
        $residencia_m_percent = round(($residencia_m / $residencia_total) * 100) . '%';
        $residencia_h_percent = round(($residencia_h / $residencia_total) * 100) . '%';

        $tecnico_m = $json[11]['discentes'];
        $tecnico_h = $json[12]['discentes'];
        $tecnico_nd = $json[13]['discentes'];;
        $tecnico_total = $tecnico_m + $tecnico_h + $tecnico_nd;
        $tecnico_m_percent = round(($tecnico_m / $tecnico_total) * 100) . '%';
        $tecnico_h_percent = round(($tecnico_h / $tecnico_total) * 100) . '%';

        //echo '<pre>' . print_r($graduacao_total, true) . '</pre>';

        echo $args['before_widget'];
        ?>

        <div class="width-wrapper large-spacer">
        <div class="linha-header-longa">
            <h2 class="linha-header"><a href="#">Mulheres UFPB em Números</a></h2>

            <h3 class="secao">Discentes</h3>
            <div class="grafico-grid">
                <div class="grafico-cat">Nível</div>
                <div class="grafico-legendas">
                    <div class="">Mulheres</div>
                    <div class="">Homens</div>
                </div>
                <div class="grafico-cat">N/D</div>
                <div class="grafico-cat totais">Total</div>
                <div class="linha-rotulo">Graduação</div>
                <div class="linha-barras" style="--qtd-total: <?php echo $graduacao_total; ?>;">
                    <div class="mulheres" style="--qtd-m: <?php echo $graduacao_m; ?>;">
                        <div class="porcento"><?php echo $graduacao_m_percent; ?></div><div class="absoluto"><?php echo $graduacao_m; ?></div>
                    </div>
                    <div class="homens" style="--qtd-h: <?php echo $graduacao_h; ?>;">
                        <div class="porcento"><?php echo $graduacao_h_percent; ?></div><div class="absoluto"><?php echo $graduacao_h; ?></div>
                    </div>
                </div>
                <div class="totais nd"><?php echo $graduacao_nd; ?></div>
                <div class="totais"><?php echo $graduacao_total; ?></div>
                
                <div class="linha-rotulo">Pós-Graduação</div>
                <div class="linha-barras" style="--qtd-total: <?php echo $pos_total; ?>;">
                    <div class="mulheres" style="--qtd-m: <?php echo $pos_m; ?>;">
                        <div class="porcento"><?php echo $pos_m_percent; ?></div><div class="absoluto"><?php echo $pos_m; ?></div>
                    </div>
                    <div class="homens" style="--qtd-h: <?php echo $pos_h; ?>;">
                        <div class="porcento"><?php echo $pos_h_percent; ?></div><div class="absoluto"><?php echo $pos_h; ?></div>
                    </div>
                </div>
                <div class="totais nd"><?php echo $pos_nd; ?></div>
                <div class="totais"><?php echo $pos_total; ?></div>
                
                <div class="linha-rotulo">Residência</div>
                <div class="linha-barras" style="--qtd-total: <?php echo $residencia_total; ?>;">
                    <div class="mulheres" style="--qtd-m: <?php echo $residencia_m; ?>;">
                        <div class="porcento"><?php echo $residencia_m_percent; ?></div><div class="absoluto"><?php echo $residencia_m; ?></div>
                    </div>
                    <div class="homens" style="--qtd-h: <?php echo $residencia_h; ?>;">
                        <div class="porcento"><?php echo $residencia_h_percent; ?></div><div class="absoluto"><?php echo $residencia_h; ?></div>
                    </div>
                </div>
                <div class="totais nd"><?php echo $residencia_nd; ?></div>
                <div class="totais"><?php echo $residencia_total; ?></div>

                <div class="linha-rotulo">Ensino Técnico</div>
                <div class="linha-barras" style="--qtd-total: <?php echo $tecnico_total; ?>;">
                    <div class="mulheres" style="--qtd-m: <?php echo $tecnico_m; ?>;">
                        <div class="porcento"><?php echo $tecnico_m_percent; ?></div><div class="absoluto"><?php echo $tecnico_m; ?></div>
                    </div>
                    <div class="homens" style="--qtd-h: <?php echo $tecnico_h; ?>;">
                        <div class="porcento"><?php echo $tecnico_h_percent; ?></div><div class="absoluto"><?php echo $tecnico_h; ?></div>
                    </div>
                </div>
                <div class="totais nd"><?php echo $tecnico_nd; ?></div>
                <div class="totais"><?php echo $tecnico_total; ?></div>
            </div>
        <?php

        $str_docente = file_get_contents('https://metabase.ufpb.br/public/question/651bd01d-8e43-4ec3-aaa2-d4e14828ecee.json');
        $json_docente = json_decode($str_docente, true);

        $items_count = count($json_docente); //usa o tamanho do array para pegar os últimos 10 elementos

        $docente_mestrado_h = $json_docente[$items_count - 2]["docentes"];
        $docente_mestrado_m = $json_docente[$items_count - 3]["docentes"];
        $docente_mestrado_nd = 0;
        $docente_mestrado_total = $docente_mestrado_m + $docente_mestrado_h + $docente_mestrado_nd;
        $docente_mestrado_m_percent = round(($docente_mestrado_m / $docente_mestrado_total) * 100) . '%';
        $docente_mestrado_h_percent = round(($docente_mestrado_h / $docente_mestrado_total) * 100) . '%';


        $docente_espec_h = $json_docente[$items_count - 4]["docentes"];
        $docente_espec_m = $json_docente[$items_count - 5]["docentes"];
        $docente_espec_nd = 0;
        $docente_espec_total = $docente_espec_m + $docente_espec_h + $docente_espec_nd;
        $docente_espec_m_percent = round(($docente_espec_m / $docente_espec_total) * 100) . '%';
        $docente_espec_h_percent = round(($docente_espec_h / $docente_espec_total) * 100) . '%';
        
        $docente_doutorado_h = $json_docente[$items_count - 7]["docentes"];
        $docente_doutorado_m = $json_docente[$items_count - 8]["docentes"];
        $docente_doutorado_nd = $json_docente[$items_count - 6]["docentes"];
        $docente_doutorado_total = $docente_doutorado_m + $docente_doutorado_h + $docente_doutorado_nd;
        $docente_doutorado_m_percent = round(($docente_doutorado_m / $docente_doutorado_total) * 100) . '%';
        $docente_doutorado_h_percent = round(($docente_doutorado_h / $docente_doutorado_total) * 100) . '%';

        //echo '<pre>' . print_r($docente_doutorado_m, true) . '</pre>';

        ?>


            <h3 class="secao">Docentes</h3>
            <div class="grafico-grid">
                <div class="grafico-cat">Formação</div>
                <div class="grafico-legendas">
                    <div class="">Mulheres</div>
                    <div class="">Homens</div>
                </div>
                <div class="grafico-cat">N/D</div>
                <div class="grafico-cat totais">Total</div>

                <div class="linha-rotulo">Doutorado</div>
                <div class="linha-barras" style="--qtd-total: <?php echo $docente_doutorado_total; ?>;">
                    <div class="mulheres" style="--qtd-m: <?php echo $docente_doutorado_m; ?>;">
                        <div class="porcento"><?php echo $docente_doutorado_m_percent; ?></div><div class="absoluto"><?php echo $docente_doutorado_m; ?></div>
                    </div>
                    <div class="homens" style="--qtd-h: <?php echo $docente_doutorado_h; ?>;">
                        <div class="porcento"><?php echo $docente_doutorado_h_percent; ?></div><div class="absoluto"><?php echo $docente_doutorado_h; ?></div>
                    </div>
                </div>
                <div class="totais nd"><?php echo $docente_doutorado_nd; ?></div>
                <div class="totais"><?php echo $docente_doutorado_total; ?></div>

                <div class="linha-rotulo">Mestrado</div>
                <div class="linha-barras" style="--qtd-total: <?php echo $docente_mestrado_total; ?>;">
                    <div class="mulheres" style="--qtd-m: <?php echo $docente_mestrado_m; ?>;">
                        <div class="porcento"><?php echo $docente_mestrado_m_percent; ?></div><div class="absoluto"><?php echo $docente_mestrado_m; ?></div>
                    </div>
                    <div class="homens" style="--qtd-h: <?php echo $docente_mestrado_h; ?>;">
                        <div class="porcento"><?php echo $docente_mestrado_h_percent; ?></div><div class="absoluto"><?php echo $docente_mestrado_h; ?></div>
                    </div>
                </div>
                <div class="totais nd"><?php echo $docente_mestrado_nd; ?></div>
                <div class="totais"><?php echo $docente_mestrado_total; ?></div>   

                <div class="linha-rotulo">Especialização</div>
                <div class="linha-barras" style="--qtd-total: <?php echo $docente_espec_total; ?>;">
                    <div class="mulheres" style="--qtd-m: <?php echo $docente_espec_m; ?>;">
                        <div class="porcento"><?php echo $docente_espec_m_percent; ?></div><div class="absoluto"><?php echo $docente_espec_m; ?></div>
                    </div>
                    <div class="homens" style="--qtd-h: <?php echo $docente_espec_h; ?>;">
                        <div class="porcento"><?php echo $docente_espec_h_percent; ?></div><div class="absoluto"><?php echo $docente_espec_h; ?></div>
                    </div>
                </div>
                <div class="totais nd"><?php echo $docente_espec_nd; ?></div>
                <div class="totais"><?php echo $docente_espec_total; ?></div>
            </div>

            <?php 
            $mes = date('n') - 1; //pega sempre o mês anterior para garatir que os dados já foram atualizados
            $ano = date('Y');

            if ($mes == 0) { //se for janeiro, pegar os dados do mês de dezembro do ano ano anterior
                $mes = 12;
                $ano = --$ano;
            }

            $str_tecnico = file_get_contents('https://metabase.ufpb.br/public/question/a1b1c6a9-086d-46e9-a60a-42da820cdc53.json');
            $resources = json_decode($str_tecnico, 1);

            $items_count = count($resources); //usa o tamanho do array para contar a partir do fim

            $tecadm_m = 0;
            $tecadm_h = 0;
            $tecadm_nd = 0;

            $ja_passou = false; //usado para verificar se o loop a seguir já passou por todos os itens do mês/ano requisitado

            for($i = $items_count - 1; $i > 0; --$i /*$resources as $rkey => $resource*/){

                if ($resources[$i]["ano"] == $ano && $resources[$i]["mes"] == $mes) {
                    
                    $ja_passou = true;
                    if ($resources[$i]["genero"] == "Feminino") {
                        $tecadm_m = $tecadm_m + $resources[$i]['tecnicos'];
                    }
                    else if ($resources[$i]["genero"] == "Masculino") {
                        $tecadm_h = $tecadm_h + $resources[$i]['tecnicos'];
                    }
                    else if ($resources[$i]["genero"] == "Não Informado") {
                        $tecadm_nd = $tecadm_nd + $resources[$i]['tecnicos'];
                    }
                } else if ($ja_passou) {
                    break;
                } else {
                    continue;
                }
            }

            $tecadm_total = $tecadm_h + $tecadm_m + $tecadm_nd;
            $tecadm_m_percent = round(($tecadm_m / $tecadm_total) * 100) . '%';
            $tecadm_h_percent = round(($tecadm_h / $tecadm_total) * 100) . '%';

            ?>

            <h3 class="secao">Técnicos-Administrativos</h3>
            <div class="grafico-grid">
                <div class="grafico-cat">Categoria</div>
                <div class="grafico-legendas">
                    <div class="">Mulheres</div>
                    <div class="">Homens</div>
                </div>
                <div class="grafico-cat">N/D</div>
                <div class="grafico-cat totais">Total</div>
                <div class="linha-rotulo">Todas</div>
                <div class="linha-barras" style="--qtd-total: <?php echo $tecadm_total; ?>;">
                    <div class="mulheres" style="--qtd-m: <?php echo $tecadm_m; ?>;">
                        <div class="porcento"><?php echo $tecadm_m_percent; ?></div><div class="absoluto"><?php echo $tecadm_m; ?></div>
                    </div>
                    <div class="homens" style="--qtd-h: <?php echo $tecadm_h; ?>;">
                        <div class="porcento"><?php echo $tecadm_h_percent; ?></div><div class="absoluto"><?php echo $tecadm_h; ?></div>
                    </div>
                </div>
                <div class="totais nd"><?php echo $tecadm_nd; ?></div>
                <div class="totais"><?php echo $tecadm_total; ?></div>
            </div>
            
            <!--div class="mais-dados-mulheres">
                <div class="total-observacao">*Os somatórios totais incluem os números para gênero desconhecido ou não informado</div>
                <div class=""><a href="', get_home_url(), '/noticias/" class="mais-link">Mais Dados</a></div>
            </div-->
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