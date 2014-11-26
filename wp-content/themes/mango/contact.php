<?php 
/* Template name: Contact page */

global $pt_themename;

if( get_post_meta($post->ID, 'contact_address', TRUE) ||
    get_post_meta($post->ID, 'contact_phone', TRUE) ||
    get_post_meta($post->ID, 'contact_fax', TRUE)
){
    $grid_class = 'grid_9';
} else {
    $grid_class = 'grid_12';
}

if( get_post_meta($post->ID, 'use_contact_form', TRUE) != '0' ):
    if( get_post_meta($post->ID, 'security_question', TRUE) )
        $securityQuestion = get_post_meta($post->ID, 'security_question', TRUE);
    else
        $securityQuestion = __("What is 2+3?", "premitheme");

    if( get_post_meta($post->ID, 'security_answer', TRUE) )
        $securityAnswer = get_post_meta($post->ID, 'security_answer', TRUE);
    else
        $securityAnswer = __("5", "premitheme");

    if( get_post_meta($post->ID, 'contact_email', TRUE) )
        $contactEmail = get_post_meta($post->ID, 'contact_email', TRUE);
    else
        $contactEmail = get_option('admin_email');

    if( get_post_meta($post->ID, 'contact_subject', TRUE) )
        $contactSubject = get_post_meta($post->ID, 'contact_subject', TRUE);
    else
        $contactSubject = $pt_themename;

    if(isset($_POST['submitted'])):

        // NAME CHECKING
        if(trim($_POST['contactName']) === '') {
            $nameError = __('You forgot to enter your name.', 'premitheme');
            $hasError = true;
        } else {
            $name = trim($_POST['contactName']);
        }

        // EMAIL CHECKING
        if(trim($_POST['email']) === '')  {
            $emailError = __('You forgot to enter your email address.', 'premitheme');
            $hasError = true;
        } else if (!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+.[A-Z]{2,4}$/i", trim($_POST['email']))) {
            $emailError = __('You entered an invalid email address.', 'premitheme');
            $hasError = true;
        } else {
            $email = trim($_POST['email']);
        }
        
        // MESSAGE CHECKING
        if(trim($_POST['comments']) === '') {
            $commentError = __('You forgot to enter your comments.', 'premitheme');
            $hasError = true;
        } else {
            if(function_exists('stripslashes')) {
                $comments = stripslashes(trim($_POST['comments']));
            } else {
                $comments = trim($_POST['comments']);
            }
        }
        
        // SECURITY CHECKING
        if( get_post_meta($post->ID, "use_security", TRUE) != '0' ){
            if(trim($_POST['security']) === '')  {
                $securityError = __('You forgot to enter the security answer.', 'premitheme');
                $hasError = true;
            } else if (trim($_POST['security']) != $securityAnswer) {
                $securityError = __('You entered a wrong security answer.', 'premitheme');
                $hasError = true;
            }
        }

        // IF EVERYTHING IS OK
        if(!isset($hasError)){
            $emailTo = $contactEmail;
            $subject = '['.$contactSubject.'] from '.$name;
            $body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
            $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
            
            wp_mail($emailTo, utf8_decode($subject), utf8_decode($body), $headers);
            
            $emailSent = true;
        }
        
    endif;
endif;

get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>

        <div id="page-title" class="container alpha omega">
            <h1><?php the_title(); ?></h1>
        </div><!-- #page-title -->

        <div id="content-container" class="fullwidth-container">
            <div id="content" class="container padding-top">
                <?php /* SHOW GOOGLE MAP IF IS SET
                ===============================================*/
                if( get_post_meta($post->ID, 'google_lat', TRUE) && get_post_meta($post->ID, 'google_lng', TRUE) ): ?>
                    <div id="contact-map" class="container alpha omega"></div>
                <?php /* OTHERWISE SHOW FEATURED IMAGE IF IS SET
                ===============================================*/
                elseif ( has_post_thumbnail()): ?>
                    <div class="container alpha omega page-thumb">
                        <?php
                        $altAttr = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true);
                        $image = premitheme_image( $post->ID, '', premitheme_img_size('page-standard'));
                        ?>
                        <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" title="<?php the_title_attribute(); ?>" alt="<?php echo $altAttr; ?>"/>
                    </div>
                <?php endif; ?>
                
                <div id="main" class="<?php echo $grid_class; ?> columns padding-bottom">
                    <article id="post-<?php the_ID();?>" <?php post_class('entry-wrapper clearfix');?>>
                        <?php if( trim($post->post_content) != '' ): ?>
                            <!-- PAGE CONTENT
                            ====================================== -->
                            <div class="entry-content">
                                <?php the_content(); ?>
                                <?php wp_link_pages( array( 'before' => '<p><span><strong>' . __( 'Pages: ', 'premitheme' ) . '</strong></span>', 'after' => '</p>' ) ); ?>
                                <?php edit_post_link( __( 'Edit', 'premitheme'), '<div class="entry-meta edit-link">', '</div>' ); ?>
                            </div>
                        <?php endif; ?>

                        <?php if( get_post_meta($post->ID, 'use_contact_form', TRUE) != '0' ): ?>
                            <!-- CONTACT FORM
                            ====================================== -->
                            <div id="contact-form">
                                <h3><?php _e('Contact Form', 'premitheme');?></h3>

                                <?php if(isset($emailSent) && $emailSent == true): ?>
                                    <h2 class="thanks"><?php _e('Thanks! Your email has been sent successfully', 'premitheme') ?></h2>
                                <?php else: ?>
                                    <?php if(isset($hasError)): ?>
                                        <h2 class="error"><?php _e('Error submitting the form, Please check the required fields', 'premitheme') ?></h2>
                                    <?php endif; ?>

                                    <form action="<?php the_permalink(); ?>" id="contact-f" method="post">
                                        <p><em><?php _e('All fields are required', 'premitheme') ?></em></p>
                                        <p>
                                            <label for="contactName"><?php _e('Name', 'premitheme') ?></label>
                                            <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required" />
                                            <?php if(isset($nameError) && $nameError != ''): ?>
                                                <em class="error"><?php echo $nameError;?></em>
                                            <?php endif; ?>
                                        </p>
                                        <p>
                                            <label for="email"><?php _e('Email', 'premitheme') ?></label>
                                            <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required email"/>
                                            <?php if(isset($emailError) && $emailError != ''): ?>
                                                <em class="error"><?php echo $emailError;?></em>
                                            <?php endif; ?>
                                        </p>
                                        <p>
                                            <label for="comments"><?php _e('Message', 'premitheme') ?></label>
                                            <textarea name="comments" id="commentsText" rows="8" cols="45" class="required"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
                                            <span class="clear" style="clear: left;"></span>
                                            <?php if(isset($commentError) && $commentError != ''): ?>
                                                <em class="error"><?php echo $commentError;?></em>
                                            <?php endif; ?>
                                        </p>
                                        <?php if( get_post_meta($post->ID, "use_security", TRUE) != '0' ): ?>
                                            <p>
                                                <label for="security"><?php echo $securityQuestion; ?></label>
                                                <input style="width: 80px;" type="text" name="security" id="security" value="<?php if(isset($_POST['security']))  echo $_POST['security'];?>" class="required"/>
                                                <?php if(isset($securityError) && $securityError != ''): ?>
                                                    <em class="error"><?php echo $securityError;?></em>
                                                <?php endif; ?>
                                            </p>
                                        <?php endif; ?>
                                        <p>
                                            <input type="hidden" name="submitted" id="submitted" value="true" />
                                            <button type="submit"><?php _e('Send', 'premitheme') ?></button>
                                        </p>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>

                <?php /* SHOW CONTACT INFO IF SET
                =================================*/
                if( get_post_meta($post->ID, 'contact_address', TRUE) || get_post_meta($post->ID, 'contact_phone', TRUE) || get_post_meta($post->ID, 'contact_fax', TRUE) ): ?>
                    <div id="contact-info" class="grid_3 columns margin-bottom">
                        <aside class="widget">
                            <h3 class="widget-title"><span><?php _e('Contact Info', 'premitheme') ?></span></h3>
                            <ul>
                                <?php /* CONTACT ADDRESS
                                =================================*/
                                if( get_post_meta($post->ID, 'contact_address', TRUE) ): ?>
                                    <li>
                                        <span></span>
                                        <h6><span><?php _e('Address', 'premitheme') ?></span></h6>
                                        <p><?php echo nl2br(get_post_meta($post->ID, 'contact_address', TRUE)); ?></p>
                                    </li>
                                <?php endif; ?>

                                <?php /* PHONE NUMBER
                                =================================*/
                                if( get_post_meta($post->ID, 'contact_phone', TRUE) ): ?>
                                    <li>
                                        <span></span>
                                        <h6><span><?php _e('Phone', 'premitheme') ?></span></h6>
                                        <p><?php echo nl2br(get_post_meta($post->ID, 'contact_phone', TRUE)); ?></p>
                                    </li>
                                <?php endif; ?>

                                <?php /* FAX NUMBER
                                =================================*/
                                if( get_post_meta($post->ID, 'contact_fax', TRUE) ): ?>
                                    <li>
                                        <span></span>
                                        <h6><span><?php _e('Fax', 'premitheme') ?></span></h6>
                                        <p><?php echo nl2br(get_post_meta($post->ID, 'contact_fax', TRUE)); ?></p>
                                    </li>
                                <?php endif; ?>

                                <?php /* SOCIAL NETWORKS
                                =================================*/
                                if( premitheme_social_links("round") ): ?>
                                    <li>
                                        <span></span>
                                        <h6><span><?php _e('Social Networks', 'premitheme') ?></span></h6>
                                        <ul class="social-wrapper">
                                            <?php echo premitheme_social_links("round"); ?>
                                            <li class="clear"></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </aside>
                    </div>
                <?php endif; ?>
                <?php endwhile; ?>
            </div><!-- #content -->
        </div>
<?php get_footer(); ?>