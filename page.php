<?php get_header(); ?>
<div class="corpo width-wrapper" id="conteudo_pagina">
    <div class="corpo-grid">
        <div class="sidebar"> 
            <ul class="side-menu linha-header-longa linha-abaixo">
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

                if (has_children() OR $post->post_parent > 0) { ?>                

                    <div class="menu-navegacao linha-header-longa linha-abaixo">
                        <h2 class="parent-link">
                            <a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>">
                                <?php
                                echo get_the_title(get_top_ancestor_id());
                                ?>
                            </a>    
                        </h2>
                        <ul class="menu-lateral">
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
                        summon_side_menu();                        
                    ?>             
                            
        </div>
        <?php
        while ( have_posts() ) :
        the_post(); ?>
        <div class="content-grid">            
            <h1><?php the_title(); ?></h1>           

            <div class="the-content-container">
                <?php the_content(); ?>
            </div>
            
                                
        <?php endwhile; ?>           

                       
        </div>
    </div> 
    </div>
</div>

<?php get_footer(); ?>