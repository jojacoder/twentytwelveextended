<?php
/**
 * Template Name: TTE Child Pages Listing Page Template, No Sidebar
 *
 * Description: Built from the Twenty Twelve no-sidebar look. 
 * Use this page template to list all child pages on one page
 * and use javascript to dynamically show the text.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' );

				// list children
				$mypages = get_pages( array( 'child_of' => get_the_ID(), 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );

				$sublevel = 2;
				$parent = get_the_ID();
				$parent_arr = array(get_the_ID());
				?><div class="child-contents"><?php
				foreach( $mypages as $page ) :
					$indent = $outdent = false;
					if ($parent != $page->post_parent) {
						if (!in_array($page->post_parent, $parent_arr)) {
							$sublevel++;
							$parent_arr[] = $page->post_parent;
							$indent = true;
						}
						else {
							$sublevel--;
							$outdent = true;
						}
					}

					$content = $page->post_content;
					$content = apply_filters( 'the_content', $content );
					?>
					
					<?php if ($indent) : ?>
						<div class="sublevel-<?php echo $sublevel; ?>">
					<?php elseif ($outdent) : ?>
						</div>
					<?php endif; ?>
					<div class="child-content">
					<h<?php echo $sublevel; ?> class="entry-title"><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></h2>
					<div class="entry-content"><?php echo $content; ?></div>
					<div class="clear"></div>
					</div>
				<?php 
					$parent = $page->post_parent;
				endforeach;
				?></div>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>


		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>