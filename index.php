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
 * @package developer-assignment
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php

			endif;

			while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<?php

						if ( is_singular() ) :

							the_title ( '<h1 class="entry-title">', '</h1>' );

						else :

							the_title ( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

						endif; ?>

					</header>

					<div class="entry-content">

						<?php

						the_content (

							sprintf (

								wp_kses (
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'developer-assignment' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),

								wp_kses_post( get_the_title() )

							)
						);
						?>

					</div>

				</article>

			<?php
			endwhile;

		endif; ?>

	</main>

<?php

get_footer();
