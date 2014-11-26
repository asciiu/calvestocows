<?php $image = premitheme_image( $post->ID, '', array(736, '')); ?>
<div id="sharing-btns" class="clearfix">
    <?php if ( of_get_option('sharing_facebook') ): ?>
        <a href="#" data-type="facebook" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>" data-description="<?php printf( __('Check this &hellip; &quot;%s&quot; - ', 'premitheme'), get_the_title() ); ?>" data-media="<?php echo $image[0] ?>" class="prettySocial icon-facebook"></a>
    <?php endif; ?>
    <?php if ( of_get_option('sharing_twitter') && of_get_option('twitter_name') ): ?>
        <a href="#" data-type="twitter" data-url="<?php the_permalink(); ?>" data-description="<?php printf( __('Check this &hellip; &quot;%s&quot; - ', 'premitheme'), get_the_title() ); ?>" data-via="<?php echo get_theme_mod('pt_twitter_name'); ?>" class="prettySocial icon-twitter"></a>
    <?php endif; ?>
    <?php if ( of_get_option('sharing_gplus') ): ?>
        <a href="#" data-type="googleplus" data-url="<?php the_permalink(); ?>" data-description="<?php printf( __('Check this &hellip; &quot;%s&quot; - ', 'premitheme'), get_the_title() ); ?>" class="prettySocial icon-gplus"></a>
    <?php endif; ?>
    <?php if ( of_get_option('sharing_pinterest') ): ?>
        <a href="#" data-type="pinterest" data-url="<?php the_permalink(); ?>" data-description="<?php printf( __('Check this &hellip; &quot;%s&quot;', 'premitheme'), get_the_title() ); ?>" data-media="<?php echo $image[0] ?>" class="prettySocial icon-pinterest"></a>
    <?php endif; ?>
    <?php if ( of_get_option('sharing_linkedin') && of_get_option('linkedin_name') ): ?>
        <a href="#" data-type="linkedin" data-url="<?php the_permalink(); ?>" data-title="<?php the_title(); ?>" data-description="<?php printf( __('Check this &hellip; &quot;%s&quot; - ', 'premitheme'), get_the_title() ); ?>" data-via="<?php echo get_theme_mod('pt_linkedin_name'); ?>" data-media="<?php echo $image[0] ?>" class="prettySocial icon-linkedin"></a>
    <?php endif; ?>
</div>