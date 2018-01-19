<?php
/*
* Template Name: Notify Me Template
*/

get_header(); ?>

<!-- LANDING PAGE TEMPLATE -->

<div class="parallaxHolder">
    <?php if ( get_the_post_thumbnail() ): ?>
        <div class="parallaxHolder-item" data-parallax="scroll"
             data-image-src="<?php the_post_thumbnail_url(); ?>"></div>
    <?php endif; ?>
</div> <!-- Parallax section -->


<?php if (have_posts()) :
while (have_posts()) : the_post();
$display_intro_section    = get_field( 'display_intro_section' );
$template_intro_title     = get_field( 'template_intro_title' );
$template_intro_descript  = get_field( 'template_intro_description' );
$template_intro_video_url = get_field( 'template_intro_video_url' );
$template_video_duration  = get_field( 'template_video_duration' );
$template_video_caption   = get_field( 'template_video_caption' );
$template_image           = get_field( 'template_intro_image' );
$button_text              = get_field( 'button_text' ) ? get_field( 'button_text' ) : 'Button';
$button_url               = get_field( 'button_url' ) ? get_field( 'button_url' ) : '#' ;
?>
<?php if ( ! empty( $display_intro_section ) ): ?>
<div class="main"> <!-- Start main container -->
    <div class="container">

        <article class="post" id="post-<?php the_ID(); ?>">
            <section class="row column">
                <div class="intro_section_widget introLanding introLanding--tiny">
                    <div class="introLanding-inner u-clearfix">
                        <div class="introLanding-inner-rightCol">
                            <?php if (! empty( $template_intro_video_url && $template_video_caption ) ) { ?>
                                <div class="introSection-video">
                                    <a class="js-videoBox introSection-video-trigger"
                                       href="#video-popup">
									<span
                                            class="introSection-video-trigger-icon"></span>
                                        <img src="<?php echo $template_video_caption; ?>" alt="">
                                    </a>
                                </div>
                            <?php } elseif( ! empty( $template_image ) && is_int( $template_image ) ) { ?>
                                <!-- Intro Section Image -->
                                <div class="introLanding-image">
                                    <?php
                                    echo wp_get_attachment_image( $template_image, 'full' );
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="introLanding-inner-leftCol">
                            <?php if ( ! empty( $template_intro_title ) ) : ?>
                                <h1 class="introLanding-title"><?php echo $template_intro_title; ?></h1>
                            <?php endif; ?>
                            <?php if ( ! empty( $template_intro_descript ) ) : ?>
                                <div
                                        class="introLanding-description"><?php echo $template_intro_descript; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="introSection-social">
                        </div>
                        <div id="video-popup" class="introSection-popup mfp-hide">
                            <div class="mfp-iframe-scaler">
                                <iframe
                                        src="<?php echo $template_intro_video_url ?>"
                                        frameborder="0" allowfullscreen
                                        class="js-video-iFrame"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="entry">
                <?php the_content(); ?>
            </div>
        </article>
        <?php else : ?>
        <div class="main defaultPage"> <!-- Start main container -->
            <div class="container">
                <article class="post" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                        <?php the_content(); ?>
                    </div>
                </article>
                <?php endif; ?>

			<?php endwhile;
		endif; ?>

		<?php get_footer(); ?>