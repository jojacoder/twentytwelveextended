<?php

/*
 * create custom plugin settings menu
 */
add_action('admin_menu', 'tte_create_menu');

function tte_create_menu() {

	//create new top-level menu
	add_submenu_page('themes.php', 'Extended Settings', 'Extended Theme Settings', 'administrator', 'tte-settings-page', 'tte_settings_page');

}


function tte_settings_page() {
?>
<div class="wrap">
<h2>Extended settings</h2>
  <div class="wrap">  
        <form method="post" action="options.php">  
            <?php wp_nonce_field('update-options') ?>
			<div style="float:left; margin-right: 20px;">
				<h3>Social networks</h3>  
				<p><strong>Twitter ID:</strong><br />  
					<input type="text" name="tte_twitterid" size="45" value="<?php echo get_option('tte_twitterid'); ?>" />  
				</p>  
				<p><strong>Facebook Page Links:</strong><br />  
					<input type="text" name="tte_fb_link" size="45" value="<?php echo get_option('tte_fb_link'); ?>" />  
				</p>
				<h3>Visual</h3>  
				<p><strong>Logo:</strong><br />  
					<input id="tte_logo" class="upload_image" type="text" size="36" name="tte_logo" value="<?php echo get_option('tte_logo'); ?>" />
					<input id="tte_logo_button" class="upload_image_button" type="button" value="Upload Image" />		
				</p>
				<p><strong>Favicon:</strong><br />  
					<input id="tte_favicon" class="upload_image" type="text" size="36" name="tte_favicon" value="<?php echo get_option('tte_favicon'); ?>" />
					<input id="tte_favicon_button" class="upload_image_button" type="button" value="Upload Image" />		
				</p>
				<p><input type="submit" name="Submit" value="Save options" /></p>  
            </div>
			<div style="float:left">
				<h3>CSS</h3><p>  
					<textarea name="tte_css_text" rows="45" cols="100"><?php echo get_option('tte_css_text'); ?></textarea>
				</p>
			</div>
            <input type="hidden" name="action" value="update" />  
			<input type="hidden" name="page_options" value="tte_twitterid,tte_fb_link,tte_css_text,tte_logo,tte_favicon" />
		</form>  
    </div> 
</div>
<?php } 





/*
 * STYLE AND SCRIPTS
 */
/* enable media upload */
function tte_admin_styles() {
	wp_enqueue_style('thickbox');
}
function tte_admin_scripts() {
	wp_enqueue_script('tte-admin-scripts', get_stylesheet_directory_uri() . '/js/tte-admin.js', array('jquery','media-upload','thickbox'), '1.0', true );
	//wp_enqueue_script( 'jquery-maps', 'http://maps.google.com/maps/api/js?sensor=true', array(), '1.0', true );
	//wp_enqueue_script( 'jquery-map-ui', get_stylesheet_directory_uri() . '/js/jquery.ui.map.js', array('jquery'), '1.0', true );
}
function tte_scripts() {
	wp_enqueue_script('tte-scripts', get_stylesheet_directory_uri() . '/js/tte.js', array('jquery'), '1.0', true );
	//wp_enqueue_script( 'jquery-maps', 'http://maps.google.com/maps/api/js?sensor=true', array(), '1.0', true );
	//wp_enqueue_script( 'jquery-map-ui', get_stylesheet_directory_uri() . '/js/jquery.ui.map.js', array('jquery'), '1.0', true );
}

if (isset($_GET['page']) && $_GET["page"] == "tte-settings-page") {
	add_action('admin_print_styles', 'tte_admin_styles');
	add_action('admin_init', 'tte_admin_scripts' );
}

add_action('wp_enqueue_scripts', 'tte_scripts' );


/*
 * BODY CLASS
 */
function tte_body_class( $classes ) {

	if ( is_page_template( 'child-pages-listing.php' ) ) {
		$classes[] = 'full-width';
	}

	return $classes;
}
add_filter( 'body_class', 'tte_body_class' );

/*
 * FOOTER WIDGETS INIT
 */
function tte_widgets_init() {
 	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'tte' ),
		'id' => 'sidebar-tte-footer-1',
		'description' => __( 'Appears in footer if not empty', 'tte' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
 	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'tte' ),
		'id' => 'sidebar-tte-footer-2',
		'description' => __( 'Appears in footer if not empty', 'tte' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
 	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'tte' ),
		'id' => 'sidebar-tte-footer-3',
		'description' => __( 'Appears in footer if not empty', 'tte' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
 	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'tte' ),
		'id' => 'sidebar-tte-footer-4',
		'description' => __( 'Appears in footer if not empty', 'tte' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'tte_widgets_init' );

?>