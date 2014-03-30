<?php
/**
 * Template Name: TTE Page With Columns Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns. This special
 * template also adds an extra column if the custom field firstpage-extra-col exist.
 *
 */

get_header(); ?>

	<div id="primary" class="site-content<?php echo $class;?>">
		<div id="content" class="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>


				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>

					<div class="entry-content tte-column-wrapper">
						<!-- tte columns -->
					
						<?php
						 
							// check if the flexible content field has rows of data
							if( have_rows('tte_columns') ):
						 
								 // loop through the rows of data
								while ( have_rows('tte_columns') ) : the_row();
							 
									if( get_row_layout() == 'tte_column' ):
										echo "<div class='tte-column tte-";
										the_sub_field('tte_cols_class');
										echo "'>";
										// add support for WP Lightbox 2 by Pankaj Jha
										if (function_exists("jqlb_apply_lightbox")) {
											echo jqlb_apply_lightbox(get_sub_field('tte_content'));
										}
										else {
											the_sub_field('tte_content');
										}
										echo "</div>";
										 
									endif;
							 
								endwhile;
							endif;
							?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

			<?php endwhile; // end of the loop. ?>

		</div>
	</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>