<?php
/* The template for displaying normal FAQs style */

global $pt_faqs_group, $pt_faq_groups, $pt_faqs_orderby, $pt_faqs_order;

?>
<div class="faq-titles">
    <?php
    if ( $pt_faqs_group == 'all' ):
        if ( !empty($pt_faq_groups) ):
            foreach ( $pt_faq_groups as $faq_group ):
                // FAQs TITLES QUERY PARAMETERS
                $args = array(
                    'nopaging'       => TRUE,
                    'order'          => $pt_faqs_order,
                    'orderby'        => $pt_faqs_orderby,
                    'post_type'      => 'faqs',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'faq_groups',
                            'field'    => 'id',
                            'terms'    => array($faq_group->term_id),
                            'operator' => 'IN'
                        )
                    )
                );

                $original_query = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query( $args );
                ?>
                    <hgroup class="faq-group">
                        <h3 class="group-title"><?php echo $faq_group->cat_name; ?></h3>
                        <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                            <h2 class="faq-title"><span><?php _e('Q', 'premitheme'); ?></span><a href="#<?php echo $post->post_name; ?>"><?php the_title(); ?></a></h2>
                        <?php endwhile; ?>
                    </hgroup>
                <?php
                $wp_query = null;
                $wp_query = $original_query;
                wp_reset_postdata();
            endforeach;
        else:
            // FAQs TITLES QUERY PARAMETERS
            $args = array(
                    'nopaging'       => TRUE,
                    'order'          => $pt_faqs_order,
                    'orderby'        => $pt_faqs_orderby,
                    'post_type'      => 'faqs'
                );

            $original_query = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query( $args );
            while ($wp_query->have_posts()): $wp_query->the_post();
            ?>
                <h2 class="faq-title"><span><?php _e('Q', 'premitheme'); ?></span><a href="#<?php echo $post->post_name; ?>"><?php the_title(); ?></a></h2>
            <?php endwhile;
            $wp_query = null;
            $wp_query = $original_query;
            wp_reset_postdata();
        endif;
    else:
        if ( !empty($pt_faq_groups) ):
            foreach ( $pt_faq_groups as $faq_group ):
                // FAQs TITLES QUERY PARAMETERS
                $args = array(
                    'nopaging'       => TRUE,
                    'order'          => $pt_faqs_order,
                    'orderby'        => $pt_faqs_orderby,
                    'post_type'      => 'faqs',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'faq_groups',
                            'field'    => 'id',
                            'terms'    => array($faq_group->term_id),
                            'operator' => 'IN'
                        )
                    )
                );

                $original_query = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query( $args );
                ?>
                    <hgroup class="faq-group">
                        <h3 class="group-title"><?php echo $faq_group->cat_name; ?></h3>
                        <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
                            <h2 class="faq-title"><span><?php _e('Q', 'premitheme'); ?></span><a href="#<?php echo $post->post_name; ?>"><?php the_title(); ?></a></h2>
                        <?php endwhile; ?>
                    </hgroup>
                <?php
                $wp_query = null;
                $wp_query = $original_query;
                wp_reset_postdata();
            endforeach;
        else:
            // FAQs TITLES QUERY PARAMETERS
            $args = array(
                    'nopaging'       => TRUE,
                    'order'          => $pt_faqs_order,
                    'orderby'        => $pt_faqs_orderby,
                    'post_type'      => 'faqs',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'faq_groups',
                            'field'    => 'id',
                            'terms'    => array($pt_faqs_group),
                            'operator' => 'IN'
                        )
                    )
                );

            $original_query = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query( $args );
            while ($wp_query->have_posts()): $wp_query->the_post();
            ?>
                <h2 class="faq-title"><span><?php _e('Q', 'premitheme'); ?></span><a href="#<?php echo $post->post_name; ?>"><?php the_title(); ?></a></h2>
            <?php endwhile;
            $wp_query = null;
            $wp_query = $original_query;
            wp_reset_postdata();
        endif;
    endif;
    ?>
</div>

<div class="faq-answers">
    <?php
    if ( $pt_faqs_group == 'all' ):
        if ( !empty($pt_faq_groups) ):
            foreach ( $pt_faq_groups as $faq_group ):
                // FAQs ANSWERS QUERY PARAMETERS
                $args = array(
                    'nopaging'       => TRUE,
                    'order'          => $pt_faqs_order,
                    'orderby'        => $pt_faqs_orderby,
                    'post_type'      => 'faqs',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'faq_groups',
                            'field'    => 'id',
                            'terms'    => array($faq_group->term_id),
                            'operator' => 'IN'
                        )
                    )
                );

                $original_query = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query( $args );
                ?>
                    <div class="faq-group">
                        <h3 class="group-title"><?php echo $faq_group->cat_name; ?></h3>
                        <?php while ($wp_query->have_posts()): $wp_query->the_post();
                            $faq_answer = get_post_meta($post->ID, 'faqanswer', TRUE);
                        ?>
                            <div id="<?php echo $post->post_name; ?>" class="faq-answer">
                                <a class="top" href="#main-wrapper"><?php _e('Top', 'premitheme'); ?></a>
                                <h3><?php the_title(); ?></h3>
                                <div class="answer-content"><?php echo wpautop( htmlspecialchars_decode($faq_answer) ); ?></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php
                $wp_query = null;
                $wp_query = $original_query;
                wp_reset_postdata();
            endforeach;
        else:
            // FAQs ANSWERS QUERY PARAMETERS
            $args = array(
                    'nopaging'       => TRUE,
                    'order'          => $pt_faqs_order,
                    'orderby'        => $pt_faqs_orderby,
                    'post_type'      => 'faqs'
                );

            $original_query = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query( $args );
            while ($wp_query->have_posts()): $wp_query->the_post();
                $faq_answer = get_post_meta($post->ID, 'faqanswer', TRUE);
            ?>
                <div id="<?php echo $post->post_name; ?>" class="faq-answer">
                    <a class="top" href="#main-wrapper"><?php _e('Top', 'premitheme'); ?></a>
                    <h3><?php the_title(); ?></h3>
                    <div class="answer-content"><?php echo wpautop( htmlspecialchars_decode($faq_answer) ); ?></div>
                </div>
            <?php endwhile;
            $wp_query = null;
            $wp_query = $original_query;
            wp_reset_postdata();
        endif;
    else:
        if ( !empty($pt_faq_groups) ):
            foreach ( $pt_faq_groups as $faq_group ):
                // FAQs ANSWERS QUERY PARAMETERS
                $args = array(
                    'nopaging'       => TRUE,
                    'order'          => $pt_faqs_order,
                    'orderby'        => $pt_faqs_orderby,
                    'post_type'      => 'faqs',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'faq_groups',
                            'field'    => 'id',
                            'terms'    => array($faq_group->term_id),
                            'operator' => 'IN'
                        )
                    )
                );

                $original_query = $wp_query;
                $wp_query = null;
                $wp_query = new WP_Query( $args );
                ?>
                    <div class="faq-group">
                        <h3 class="group-title"><?php echo $faq_group->cat_name; ?></h3>
                        <?php while ($wp_query->have_posts()): $wp_query->the_post();
                            $faq_answer = get_post_meta($post->ID, 'faqanswer', TRUE);
                        ?>
                            <div id="<?php echo $post->post_name; ?>" class="faq-answer">
                                <a class="top" href="#main-wrapper"><?php _e('Top', 'premitheme'); ?></a>
                                <h3><?php the_title(); ?></h3>
                                <div class="answer-content"><?php echo wpautop( htmlspecialchars_decode($faq_answer) ); ?></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php
                $wp_query = null;
                $wp_query = $original_query;
                wp_reset_postdata();
            endforeach;
        else:
            // FAQs ANSWERS QUERY PARAMETERS
            $args = array(
                    'nopaging'       => TRUE,
                    'order'          => $pt_faqs_order,
                    'orderby'        => $pt_faqs_orderby,
                    'post_type'      => 'faqs',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'faq_groups',
                            'field'    => 'id',
                            'terms'    => array($pt_faqs_group),
                            'operator' => 'IN'
                        )
                    )
                );

            $original_query = $wp_query;
            $wp_query = null;
            $wp_query = new WP_Query( $args );
            while ($wp_query->have_posts()): $wp_query->the_post();
                $faq_answer = get_post_meta($post->ID, 'faqanswer', TRUE);
            ?>
                <div id="<?php echo $post->post_name; ?>" class="faq-answer">
                    <a class="top" href="#main-wrapper"><?php _e('Top', 'premitheme'); ?></a>
                    <h3><?php the_title(); ?></h3>
                    <div class="answer-content"><?php echo wpautop( htmlspecialchars_decode($faq_answer) ); ?></div>
                </div>
            <?php endwhile;
            $wp_query = null;
            $wp_query = $original_query;
            wp_reset_postdata();
        endif;
    endif;
    ?>
</div>