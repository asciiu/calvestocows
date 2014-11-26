<?php
/* The template for displaying flexslider content section */

global $pt_section_i;
$sliderSet =  get_post_meta($post->ID, 'slider_set', TRUE);
$sliderHeight = get_post_meta($post->ID, 'slider_height', TRUE);
$sliderOrderBy = get_post_meta($post->ID, 'slider_orderby', TRUE);
$sliderOrder = get_post_meta($post->ID, 'slider_order', TRUE);
$fullBgImage = premitheme_fullscreenBgImage();

if( !$sliderHeight[$pt_section_i] ) $sliderHeight[$pt_section_i] = '300';

if($sliderSet[$pt_section_i] != 'all'):
    $args = array(
       'posts_per_page' => -1,
       'order'          => $sliderOrder[$pt_section_i],
       'orderby'        => $sliderOrderBy[$pt_section_i],
       'post_type'      => 'slides',
       'tax_query'      => array(
            array(
                'taxonomy' => 'slider_sets',
                'field'    => 'id',
                'terms'    => array($sliderSet[$pt_section_i]),
                'operator' => 'IN'
            )
        )
    );
else:
    $args = array(
        'posts_per_page' => -1,
        'order' => $sliderOrder[$pt_section_i],
        'orderby' => $sliderOrderBy[$pt_section_i],
        'post_type' => 'slides'
    );
endif;

$original_query = $wp_query;
$wp_query = null;
$wp_query = new WP_Query( $args );
if ( $wp_query->have_posts() ):
    ?>
        <!-- FLEXSLIDER
        ====================================== -->
        <div class="entry-thumb flexslider home-flexslider flexslider-<?php echo $pt_section_i ?>" style="height: <?php echo $sliderHeight[$pt_section_i] ?>px;">
            <ul class="slides">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post();
                    $slideImg = get_post_meta($post->ID, 'slide_img', TRUE);
                    $slideLink = get_post_meta($post->ID, 'slide_link', TRUE);
                    $slideCapOne = get_post_meta($post->ID, 'slide_caption_one', TRUE);
                    $slideCapTwo = get_post_meta($post->ID, 'slide_caption_two', TRUE);
                    $slideCapColor = get_post_meta($post->ID, 'slide_caption_color', TRUE);

                    $imgID = premitheme_get_attachment_id_by_src($slideImg);
                    $altAttr = get_post_meta( $imgID, '_wp_attachment_image_alt', true);

                    $width = 960;
                    $height = $sliderHeight[$pt_section_i];

                    $image = premitheme_image('', $slideImg, array($width, $height));
                ?>
                    <li data-thumb="<?php echo $image[0]; ?>">
                        <?php if($slideLink) echo '<a href="'.$slideLink.'">'; ?>
                            <?php if ( isset($image[0]) ): ?>
                                <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $$altAttr; ?>"/>
                                <?php if( $slideCapOne || $slideCapTwo ): ?>
                                    <div class="slider-caption">
                                        <?php if( $slideCapOne ): ?>
                                            <h2 class="caption-one" style="color: <?php echo $slideCapColor; ?>;">
                                                <?php echo $slideCapOne; ?>
                                            </h2>
                                        <?php endif; ?>
                                        <?php if( $slideCapTwo ): ?>
                                            <h3 class="caption-two" style="color: <?php echo $slideCapColor; ?>;">
                                                <?php if( $slideCapOne ): ?>
                                                    <span style="border-top: 1px solid <?php echo $slideCapColor; ?>;"></span>
                                                <?php endif; ?>
                                                <?php echo $slideCapTwo; ?>
                                            </h3>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri();?>/images/no-image/960x300.jpg" alt="No Image"/>
                            <?php endif; ?>
                        <?php if($slideLink) echo '</a>'; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

        <script>
            jQuery(window).load(function() {
                jQuery('.flexslider-<?php echo $pt_section_i ?>').flexslider({
                    animation: 'slide',
                    easing: "easeInOutExpo",
                    smoothHeight: false,
                    slideshow: true,
                    slideshowSpeed: 3500,
                    animationSpeed: 700,
                    pauseOnAction: true,
                    pauseOnHover: true,
                    useCSS: false,
                    controlNav: true,
                    directionNav: false,
                    keyboard: false,
                    start: function() { jQuery('.flexslider-<?php echo $pt_section_i ?>').removeAttr("style"); }
                });
            });
        </script>
    <?php
endif;
$wp_query = null;
$wp_query = $original_query;
wp_reset_postdata();