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
				<h3>Settings</h3>
				<p><strong>Header thumbnail size (default 'single-post-thumbnail'):</strong><br />
					<input type="text" name="tte_header_thumbnail_size" size="45" value="<?php echo get_option('tte_header_thumbnail_size'); ?>" />
				</p>  
				<p><strong>Use header image as background:</strong>
					<input type="checkbox" name="tte_header_image_as_background" value="1" <?php echo (get_option('tte_header_image_as_background') == "1")?"checked":""; ?> />
				</p>  
				<p><strong>Disable feed in head:</strong>
					<input type="checkbox" name="tte_disable_feed" value="1" <?php echo (get_option('tte_disable_feed') == "1")?"checked":""; ?> />
				</p>  
				<p><strong>Disable twentytwelve google fonts:</strong>
					<input type="checkbox" name="tte_disable_twentytwelve_fonts" value="1" <?php echo (get_option('tte_disable_twentytwelve_fonts') == "1")?"checked":""; ?> />
				</p>  
				<p><strong>Remove loading of comment-reply js:</strong>
					<input type="checkbox" name="tte_disable_comment_reply" value="1" <?php echo (get_option('tte_disable_comment_reply') == "1")?"checked":""; ?> />
				</p>  
				<p><strong>Google Analytics ID (adds async code):</strong><br />  
					<input type="text" name="tte_google_analytics" size="45" value="<?php echo get_option('tte_google_analytics'); ?>" />  
				</p>  
				<p><strong>Google Analytics Domain (yourdomain.com):</strong><br />  
					<input type="text" name="tte_google_analytics_domain" size="45" value="<?php echo get_option('tte_google_analytics_domain'); ?>" />  
				</p>  
				
				
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
			<input type="hidden" name="page_options" value="tte_twitterid,tte_fb_link,tte_css_text,tte_logo,tte_favicon,tte_header_thumbnail_size,tte_disable_feed,tte_header_image_as_background,tte_disable_twentytwelve_fonts,tte_disable_comment_reply,tte_google_analytics,tte_google_analytics_domain" />
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
	if (get_option("tte_disable_twentytwelve_fonts") == "1") {
		wp_dequeue_style( 'twentytwelve-fonts' );
	}
	if (get_option("tte_disable_comment_reply") == "1") {
		wp_dequeue_script( 'comment-reply' );
	}

	wp_enqueue_script('tte-scripts', get_stylesheet_directory_uri() . '/js/tte.js', array('jquery'), '1.0', true );
	//wp_enqueue_script( 'jquery-maps', 'http://maps.google.com/maps/api/js?sensor=true', array(), '1.0', true );
	//wp_enqueue_script( 'jquery-map-ui', get_stylesheet_directory_uri() . '/js/jquery.ui.map.js', array('jquery'), '1.0', true );
}

if (isset($_GET['page']) && $_GET["page"] == "tte-settings-page") {
	add_action('admin_print_styles', 'tte_admin_styles');
	add_action('admin_init', 'tte_admin_scripts' );
}

add_action('wp_enqueue_scripts', 'tte_scripts', 11 );


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


/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve Extended supports.
 */
function tte_after_setup() {
	if (get_option('tte_disable_feed') == "1") {
		remove_theme_support( 'automatic-feed-links' );
	}
}
add_action( 'after_setup_theme', 'tte_after_setup', 11 );


/* REPLACE THE ORIGINAL GALLERY SHORTCODE */
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'tte_gallery_shortcode');

/**
 * The Gallery shortcode.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @since 2.5.0
 *
 * @param array $attr Attributes of the shortcode.
 * @return string HTML content to display gallery.
 */

 function tte_filter_content($content) {
	$num_columns = get_post_meta( get_the_ID(), "tte_num_columns", true );
	if ($num_columns == "") $num_columns = 1;
	
	if ($num_columns > 1) :
		$words = explode(" ", $content);
		$num_chars = strlen($content);
		$num_chars_per_column = ceil($num_chars / $num_columns) +10;
		return "<div class='tte-$num_columns-wrapper'><div class='tte-$num_columns-cols'>" . wordwrap($content, $num_chars_per_column, "</div><div class='tte-$num_columns-cols'>", true) . "</div></div>";
	else :
		return $content;
	endif;
 }
 add_filter( 'the_content', tte_filter_content );
 
 function tte_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'		 => ''
	), $attr, 'gallery'));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see tte_gallery_shortcode() in twentytwelveextended/functions.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
		/* override gallery item link */
//		if (get_option("tte_gallery_size") != "") {
//			$link = get_the_post_thumbnail($id,"large");
//		}
		
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output . "<span style='display:none'>test</span>";
}


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_column-based-page-template',
		'title' => 'Column Based Page Template',
		'fields' => array (
			array (
				'key' => 'field_53164d3daf154',
				'label' => 'Kolumner',
				'name' => 'tte_columns',
				'type' => 'flexible_content',
				'layouts' => array (
					array (
						'label' => 'Column',
						'name' => 'tte_column',
						'display' => 'row',
						'sub_fields' => array (
							array (
								'key' => 'field_53164d8faf155',
								'label' => 'Innehåll',
								'name' => 'tte_content',
								'type' => 'wysiwyg',
								'column_width' => '',
								'default_value' => '',
								'toolbar' => 'full',
								'media_upload' => 'yes',
							),
							array (
								'key' => 'field_53164db2af156',
								'label' => 'Bredd',
								'name' => 'tte_cols_class',
								'type' => 'select',
								'column_width' => '',
								'choices' => array (
									'one-whole' => 'En hel',
									'one-whole-hidden-palm' => 'En hel - (hidden--palm)',
									'one-half' => 'En halv',
									'one-third' => 'En tredjedel',
									'two-thirds' => 'Två tredjedelar',
									'one-quarter' => 'En fjärdedel',
									'three-quarters' => 'Tre fjärdedelar',
									'one-fifth' => 'En femtedel',
									'two-fifths' => 'Två femtedelar',
									'three-fifths' => 'Tre femtedelar',
									'four-fifths' => 'Fyra femtedelar',
								),
								'default_value' => '',
								'allow_null' => 0,
								'multiple' => 0,
							),
						),
					),
				),
				'button_label' => 'Add column',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-templates/page-with-columns.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
}
