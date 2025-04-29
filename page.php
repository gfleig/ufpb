<?php get_header(); ?>
<div class="corpo width-wrapper large-spacer" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar"> 
            <ul class="side-menu">
                <?php 
                    wp_nav_menu(   
                        array ( 
                            'theme_location' => 'main-menu',
                            'items_wrap' => '%3$s',
                            'container' => false,
                        ) 
                    ); 
                ?>
            </ul>             
            <?php          

                if (false && has_children() OR $post->post_parent > 0) { ?>                

                    <div class="menu-navegacao">
                        
                            <a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>">
                                <?php
                                echo get_the_title(get_top_ancestor_id());
                                ?>
                            </a>    
                        
                        <ul class="menu-lateral linha-acima linha-abaixo">
                            <?php 
                            $args = array(
                                'child_of' => get_top_ancestor_id(),
                                'title_li' => '',
                            )                    
                            ?>

                            <?php wp_list_pages($args); ?>
                        </ul>
                        
                    </div>
            <?php } ?>                
                    <?php 
                        //summon_side_menu();                        
                    ?>             
                            
        </div>
        <?php
        while ( have_posts() ) :
        the_post(); ?>
        <div class="content-grid">            
            <h1><?php the_title(); ?></h1>           

            <div class="the-content-container">
                <?php the_content(); ?>

                <p class="data-atualizado">Última atualização: <?php echo get_the_modified_time( 'l, j \d\e F \d\e Y' ); ?></p>
            </div>

            
            
                                
        <?php endwhile; ?>           

                       
        </div>
    </div> 
    </div>
</div>

<?php get_footer(); ?>