<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @since WP Theme with React 1.0
 */

get_header();
?>
	<main id="site-content">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
		?>
			<article class="hentry">
				<h2>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>

				<div class="entry">
					<?php the_content(); ?>
				</div>
			</article>

		<?php endwhile; else : ?>
			<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

	</main><!-- #site-content -->
<?php
get_footer();
