<div id="footer-wrapper">
  <footer>
  <div id="footer-top">
      <div id="footer-dados">
        <a target="_blank" rel="noopener noreferrer" href="http://ufpb.br"><img id="footer-logo" src="<?php echo get_bloginfo("template_directory"); ?>/img/ufpb-brasao-pb.png"></a>
        <div>
          <div><?php echo get_bloginfo( 'name' ); ?></div>
          <?php
          $logradouro   = get_theme_mod('custom_logradouro');
          $numero       = get_theme_mod('custom_numero');
          $complemento  = get_theme_mod('custom_complemento');
          $bairro       = get_theme_mod('custom_bairro', 'Cidade Universitária');
          $cep          = get_theme_mod('custom_CEP', '58.051-900');
          $cidade       = get_theme_mod('custom_cidade', 'João Pessoa');
          $estado       = get_theme_mod('custom_estado', 'Paraíba');

          $telefone     = get_theme_mod('custom_telefone', '+55 (83) 3216-7200');
          $contato      = get_theme_mod('custom_url_contato');
          $horario      = get_theme_mod('custom_horario');

          $whatsapp     = get_theme_mod('custom_whatsapp');
          $instagram    = get_theme_mod('custom_instagram');
          $x            = get_theme_mod('custom_x');
          $facebook     = get_theme_mod('custom_facebook');
          $youtube      = get_theme_mod('custom_youtube');
          $linkedin     = get_theme_mod('custom_linkedin');
          $spotify      = get_theme_mod('custom_spotify');
          $flickr       = get_theme_mod('custom_flickr');
                             
          if (!empty($logradouro)) {
              echo '<address>' . wp_kses_post($logradouro);
          }
          if (!empty($numero)) {
            echo ', ' . wp_kses_post($numero);
          }
          if (!empty($complemento)) {
            echo ', ' . wp_kses_post($complemento);
          }
          if (!empty($bairro)) {
            echo '<br>' . wp_kses_post($bairro);
          }          
          if (!empty($cidade)) {
            echo ', ' . wp_kses_post($cidade);
          }
          if (!empty($estado)) {
            echo ' - ' . wp_kses_post($estado);
          }
          if (!empty($cep)) {
            echo '<br>CEP: ' . wp_kses_post($cep);
          }
          echo '</address>';

          echo '<div>';
          if (!empty($telefone)) {
            echo '<div class="f-link tel"><a href="tel: ' . esc_html($telefone) . '">Telefone: ' . esc_html($telefone) . '</a></div>';
          }
          if (!empty($horario)) {
            echo '<div>' , wp_kses_post($horario) , '</div>';
          }
          if (!empty($contato)) {
            echo '<div class="f-link"><a class="mais-link" href="' . esc_url($contato) . '">Contato</a></div>';
          }          
          echo '</div>';
          
          echo '<div class="redes-sociais">';
                  
          echo '<a href="' , bloginfo('atom_url') , '"><i class="fa-solid fa-rss"></i></a>';
          if (!empty($whatsapp)) {
            echo '<a target="_blank" rel="noopener noreferrer" href="https://wa.me/' . esc_html($whatsapp) . '"><i class="fa-brands fa-whatsapp"></i></a>';
          }
          if (!empty($instagram)) {
            echo '<a target="_blank" rel="noopener noreferrer" href="' . esc_html($instagram) . '"><i class="fa-brands fa-instagram"></i></a>';
          }
          if (!empty($x)) {
            echo '<a target="_blank" rel="noopener noreferrer" href="' . esc_html($x) . '"><i class="fa-brands fa-x-twitter"></i></a>';
          }
          if (!empty($facebook)) {
            echo '<a target="_blank" rel="noopener noreferrer" href="' . esc_url($facebook) . '"><i class="fa-brands fa-facebook"></i></a>';
          }
          if (!empty($youtube)) {
            echo '<a target="_blank" rel="noopener noreferrer" href="' . esc_url($youtube) . '"><i class="fa-brands fa-youtube"></i></a>';
          } 
          if (!empty($linkedin)) {
            echo '<a target="_blank" rel="noopener noreferrer" href="' . esc_url($linkedin) . '"><i class="fa-brands fa-linkedin-in"></i></a>';
          } 
          if (!empty($spotify)) {
            echo '<a target="_blank" rel="noopener noreferrer" href="' . esc_url($spotify) . '"><i class="fa-brands fa-spotify"></i></i></a>';
          } 
          if (!empty($flickr)) {
            echo '<a target="_blank" rel="noopener noreferrer" href="' . esc_url($flickr) . '"><i class="fa-brands fa-flickr"></i></i></a>';
          } 

          echo '</div>' //div fim redes sociais          
          ?>
        </div>     
      </div>

      <div class="footer-direita">
        <div id="footer-creditos">
          <!--<a href="https://github.com/interfaceslivres"><img class="img-creditos" src="<?php echo get_bloginfo("template_directory"); ?>/img/logo-interfaces2.png" alt="Logo do Projeto Interfaces Livres"></a>-->
          <a class="logo-acesso-footer" target="_blank" rel="noopener noreferrer" href="https://www.gov.br/acessoainformacao/pt-br" title="Acesse o portal sobre o acesso à informação">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 117 49" height="100%" width="auto" shape-rendering="geometricPrecision" text-rendering="geometricPrecision">
              <defs>
                <style type="text/css">.a {font: normal bold 11px Open Sans, sans-serif;}</style>
              </defs>
              <circle cx="22" cy="23" r="22" fill="#fff"></circle>
              <path style="stroke:var(--cor-tema);stroke-width:9;stroke-linecap:round;" d="m 22,23 v 13"></path>
              <path style="stroke:#fff;stroke-width:4;stroke-linejoin:round;" d="m 4,43 3,-6 4,3 z"></path>
              <circle r="4.5" cy="11" cx="22" fill="var(--cor-tema)"></circle>
              <g fill="#fff">
                <text x="47" y="22">
                  <tspan class="a" y="18">Acesso à</tspan>
                  <tspan class="a" x="47" y="31">Informação</tspan>
                </text>
              </g>
            </svg>
          </a>
          <a target="_blank" rel="noopener noreferrer" href="https://www.sti.ufpb.br/"><img class="img-creditos" src="<?php echo get_bloginfo("template_directory"); ?>/img/sti-logo-branco.png" alt="Marca da STI"></a>
          <a target="_blank" rel="noopener noreferrer" href="http://ufpb.br/"><img class="img-creditos" src="<?php echo get_bloginfo("template_directory"); ?>/img/fundo preto.svg" alt="Marca da UFPB"></a>
        </div>
      </div>
    </div>

    <div id="footer-linha"></div>

    <div id="footer-bottom">
      <div id="footer-ultima-linha">
        <div>© <?php echo wp_date('Y') ?> Universidade Federal da Paraíba.</div>
        <div id="footer-acesso-info">
          <a href="https://www.ufpb.br/ouvidoria">Ouvidoria</a>
          <a href="https://www.ufpb.br/acessoainformacao/">Acesso à Informação</a>
          <a href="https://www.ufpb.br/cia/">Acessibilidade</a>
          <a href="https://dados.gov.br/home">Dados Abertos UFPB</a>
          <a href="https://www.gov.br/mds/pt-br/pt-br/acesso-a-informacao/privacidade-e-protecao-de-dados">Privacidade e Proteção de Dados</a>
        </div>

      </div>
    </div>


  </div>
  </footer>
</div> <!-- fecha footer wrapper -->

</div>
	
	<?php wp_footer(); ?>
  


</body>
</html>