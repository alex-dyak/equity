<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage EquityX-Theme
 * @since EquityX Theme 1.0
 */

get_header(); ?>

<?php
$image = get_option( 'w4p_background_img' );

if ( ! empty( $image ) ): ?>
	<div>
		<img src="<?php echo $image['url']; ?>" alt=""/>
	</div>
<?php endif; ?>

<div class="page-title">
	<h1><?php echo get_the_title( get_option( 'page_for_posts' ) ); ?></h1>
</div>

<div class="search-form">
	<h1><?php get_search_form(); ?></h1>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'template-article-blog-list' ); ?>

<?php endwhile; ?>

	<section class="row entityGrid-pagination">
		<section class="column">
			<?php if ( function_exists( 'wp_pagenavi' ) ) {
				wp_pagenavi( array(
					'before'        => '<nav class="navigation pagination" role="navigation">',
					'after'         => '</nav>',
					'wrapper_tag'   => 'div',
					'wrapper_class' => 'nav-links',
					'options'       => array(),
					'type'          => 'posts',
					'echo'          => true
				) );
			}
			?>
		</section>
	</section>

<?php else : ?>

	<h2><?php esc_html_e( 'Nothing Found', 'EquityX' ); ?></h2>

<?php endif; ?>

<?php get_sidebar(); ?>

<div class="join-us-footer">
	<?php if ( is_active_sidebar( 'join-us-footer' ) ) : ?>
		<?php dynamic_sidebar( 'join-us-footer' ); ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>


