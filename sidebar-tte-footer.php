<?php
/**
 * The sidebar containing the footer widget areas.
 *
 * If no active widgets in either sidebar, they will be hidden completely.
 */

/*
 * If none of the sidebars have widgets, then let's bail early.
 */
if ( ! is_active_sidebar( 'sidebar-tte-footer-1' ) && ! is_active_sidebar( 'sidebar-tte-footer-2' ) && ! is_active_sidebar( 'sidebar-tte-footer-3' ) && ! is_active_sidebar( 'sidebar-tte-footer-4' ) )
	return;
	
$num_sidebars = 0;
if ( is_active_sidebar( 'sidebar-tte-footer-1' ) )
	$num_sidebars++;
if ( is_active_sidebar( 'sidebar-tte-footer-2' ) )
	$num_sidebars++;
if ( is_active_sidebar( 'sidebar-tte-footer-3' ) )
	$num_sidebars++;
if ( is_active_sidebar( 'sidebar-tte-footer-4' ) )
	$num_sidebars++;

switch($num_sidebars) {
	case 1: 
		$num_sidebars = "one";
		break;
	case 2: 
		$num_sidebars = "two";
		break;
	case 3: 
		$num_sidebars = "three";
		break;
	case 4: 
		$num_sidebars = "four";
		break;
}

// If we get this far, we have widgets. Let do this.
?>
<div id="footer-widgets" class="widget-area <?php echo $num_sidebars; ?>" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar-tte-footer-1' ) ) : ?>
	<div class="first footer-widgets">
		<?php dynamic_sidebar( 'sidebar-tte-footer-1' ); ?>
	</div><!-- .first -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-tte-footer-2' ) ) : ?>
	<div class="second footer-widgets">
		<?php dynamic_sidebar( 'sidebar-tte-footer-2' ); ?>
	</div><!-- .second -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-tte-footer-3' ) ) : ?>
	<div class="third footer-widgets">
		<?php dynamic_sidebar( 'sidebar-tte-footer-3' ); ?>
	</div><!-- .third -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-tte-footer-4' ) ) : ?>
	<div class="fourth footer-widgets">
		<?php dynamic_sidebar( 'sidebar-tte-footer-4' ); ?>
	</div><!-- .fourth -->
	<?php endif; ?>
	<div class="clear"></div>
</div><!-- #footer-widgets -->