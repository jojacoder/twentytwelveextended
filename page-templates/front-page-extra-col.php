<?php
/**
 * Template Name: Front Page Extra Column Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns. This special
 * template also adds an extra column if the custom field firstpage-extra-col exist.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<?php $extra_col = get_post_custom_values("frontpage-extra-column"); 
	if (!empty($extra_col)) { $class="  two-columns"; }?>

	<div id="primary" class="site-content<?php echo $class;?>">
		<div id="content" class="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-page-image">
						<?php the_post_thumbnail(); ?>
					</div><!-- .entry-page-image -->
				<?php endif; ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
		<?php if (!empty($extra_col)): ?>
			<div id="content2" class="content content2" role="main">
				<?php foreach ($extra_col as $key => $value) :
						echo $value;
					endforeach; ?>
			</div>
		<?php endif; ?>
	</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>